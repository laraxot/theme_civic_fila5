#!/usr/bin/env python3
"""Applica una mappa di migrazione ai documenti di `docs/`: ritira (git rm) e rinomina (git mv) mantenendo i riferimenti.

Dalla radice del tema (`laravel/Themes/Civic`):

  python3 -I docs/scripts/docs-apply-map.py MAPPA.json            dry-run: scrive il rapporto, non tocca nulla
  python3 -I docs/scripts/docs-apply-map.py MAPPA.json --apply    riscrive i riferimenti, poi `git rm` e `git mv`

Mappa (JSON): {"retire": {"docs/vecchio.md": "docs/canonico.md" | null}, "rename": {"docs/Vecchio.md": "docs/nuovo.md"},
               "archive": {"docs/vecchio.md": {"to": "docs/archive/vecchio.md", "canonical": "docs/canonico.md"}}}
- `archive`: come `retire` per i riferimenti (puntano al canonico) ma il file non si cancella: `git mv` nell'archivio dichiarato,
  senza riscriverne il contenuto (l'archivio e' immutabile).

- `retire` con canonico: i riferimenti a `vecchio` puntano al canonico (si segue la catena fino al documento che resta).
  `retire` senza canonico (null): documento senza contenuto proprio; i riferimenti restano e il rapporto li elenca.
- `rename`: la cartella non cambia, cambia solo il nome (nessun spostamento fra cartelle).
- Si riscrivono i link (`[t](p)`, immagini, definizioni `[t]: p`), il frontmatter (`superseded_by`, `canonical`, `related`) e i percorsi
  citati nel testo o nei code span (`docs/x.md`, `./x.md`, `x.md`), purche' il percorso risolto (dalla cartella del file, dalla radice del
  tema o da `docs/`) sia un file della mappa. Si salta il contenuto dei blocchi di codice. Un nome senza cartella si riscrive solo se il
  file e' nella stessa cartella: mai per nome unico altrove.
- Non scrive in `docs/adr/`, `docs/contracts/`, `docs/stories/` (di altri pacchetti): i riferimenti da li' restano e il rapporto li elenca.
- Rifiuta la mappa se un bersaglio di `rename` esiste gia' e non e' ritirato, o se due sorgenti puntano allo stesso nome.

@see docs/scripts/docs-audit.py
"""
from __future__ import annotations

import json
import os
import re
import subprocess
import sys
from pathlib import Path

ROOT = Path(subprocess.run(["git", "rev-parse", "--show-toplevel"], capture_output=True, text=True, check=True).stdout.strip())
FROZEN = ("docs/adr/", "docs/contracts/", "docs/stories/", "docs/archive/", "docs/raw/")
FENCE = re.compile(r"^\s{0,3}(```|~~~)")
TOKEN = re.compile(r"[\w./@~\[\]\-]*[\w\]\-]\.md(?![\w])")


def tracked_md() -> set[str]:
    out = subprocess.run(["git", "ls-files", "-co", "--exclude-standard", "-z", "docs"], capture_output=True, text=True, cwd=ROOT, check=True).stdout
    return {f for f in out.split("\0") if f.endswith(".md") and (ROOT / f).exists()}


def final_target(path: str, retire: dict, rename: dict, depth: int = 0) -> str | None:
    """Dove sta oggi il contenuto di `path`: il canonico (se ritirato) e il nuovo nome (se rinominato); None = nessun contenuto."""
    if depth > 10:
        return None
    if path in retire:
        return final_target(retire[path], retire, rename, depth + 1) if retire[path] else None
    return rename.get(path, path)


def check_map(plan: dict, files: set[str]) -> list[str]:
    errors = []
    retire, rename = plan.get("retire", {}), plan.get("rename", {})
    for f in list(retire) + list(rename):
        if f not in files:
            errors.append(f"sorgente inesistente: {f}")
    seen: dict[str, str] = {}
    for old, new in rename.items():
        if os.path.dirname(old) != os.path.dirname(new):
            errors.append(f"rename cambia cartella: {old} -> {new}")
        if (new in files and new not in retire) or new in seen:
            errors.append(f"bersaglio occupato o doppio: {new}")
        seen[new] = old
    return errors


def style_path(tok: str, base: str, new: str, src: str) -> str:
    if base == "root":
        return new
    if base == "docs":
        return os.path.relpath(new, "docs")
    if "/" not in tok and os.path.dirname(new) == os.path.dirname(src):
        return os.path.basename(new)
    rel = os.path.relpath(new, os.path.dirname(src))
    return "./" + rel if tok.startswith("./") and not rel.startswith(".") else rel


def rewrite_text(src: str, text: str, files: set[str], retire: dict, rename: dict, log: list) -> str:
    out, in_fence = [], False
    for n, line in enumerate(text.split("\n"), 1):
        if FENCE.match(line):
            in_fence = not in_fence
            out.append(line)
            continue
        if in_fence:
            out.append(line)
            continue

        def repl(m: re.Match) -> str:
            tok = m.group(0)
            core = tok[2:] if tok.startswith("./") else tok
            for base, prefix in (("dir", os.path.dirname(src)), ("root", ""), ("docs", "docs")):
                cand = os.path.normpath(os.path.join(prefix, core))
                if cand in files:
                    if cand not in retire and cand not in rename:
                        return tok
                    new = final_target(cand, retire, rename)
                    if new is None:
                        log.append({"file": src, "line": n, "token": tok, "action": "senza-canonico"})
                        return tok
                    if new == cand:
                        return tok
                    rep = style_path(tok, base, new, src)
                    log.append({"file": src, "line": n, "token": tok, "to": rep, "action": "riscritto"})
                    return rep
            return tok

        out.append(TOKEN.sub(repl, line))
    return "\n".join(out)


def main() -> int:
    if len(sys.argv) < 2:
        print(__doc__)
        return 2
    plan = json.loads(Path(sys.argv[1]).read_text(encoding="utf-8"))
    apply = "--apply" in sys.argv
    files = tracked_md()
    rename = plan.get("rename", {})
    archive = plan.get("archive", {})
    retire = {**plan.get("retire", {}), **{old: v["canonical"] for old, v in archive.items()}}
    errors = check_map({"retire": retire, "rename": rename}, files)
    errors += [f"bersaglio dell'archivio occupato: {v['to']}" for v in archive.values() if (ROOT / v["to"]).exists()]
    if errors:
        print("\n".join(errors))
        return 1
    log: list = []
    changed: dict[str, str] = {}
    for f in sorted(files):
        if f in retire or f.startswith(FROZEN):
            continue
        text = (ROOT / f).read_text(encoding="utf-8", errors="replace")
        new = rewrite_text(f, text, files, retire, rename, log)
        if new != text:
            changed[f] = new
    frozen_refs = []
    for f in sorted(files):
        if f.startswith(FROZEN):
            tmp: list = []
            rewrite_text(f, (ROOT / f).read_text(encoding="utf-8", errors="replace"), files, retire, rename, tmp)
            frozen_refs += [e for e in tmp if e["action"] == "riscritto"]
    report = {
        "retire": len(retire),
        "rename": len(rename),
        "file_riscritti": len(changed),
        "riferimenti_riscritti": sum(1 for e in log if e["action"] == "riscritto"),
        "senza_canonico": [e for e in log if e["action"] == "senza-canonico"],
        "riferimenti_da_cartelle_non_mie": frozen_refs,
    }
    if "--log" in sys.argv:
        Path(sys.argv[sys.argv.index("--log") + 1]).write_text(json.dumps(log, indent=1, ensure_ascii=False), encoding="utf-8")
    if not apply:
        print(json.dumps(report, indent=1, ensure_ascii=False))
        return 0
    for f, new in changed.items():
        (ROOT / f).write_text(new, encoding="utf-8")
    for f in retire:
        if f in archive:
            (ROOT / archive[f]["to"]).parent.mkdir(parents=True, exist_ok=True)
            subprocess.run(["git", "mv", "--", f, archive[f]["to"]], cwd=ROOT, check=True)
        else:
            subprocess.run(["git", "rm", "-q", "--", f], cwd=ROOT, check=True)
    for old, new in rename.items():
        subprocess.run(["git", "mv", "--", old, new], cwd=ROOT, check=True)
    print(json.dumps(report, indent=1, ensure_ascii=False))
    return 0


if __name__ == "__main__":
    sys.exit(main())

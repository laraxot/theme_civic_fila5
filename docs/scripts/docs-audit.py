#!/usr/bin/env python3
"""Controllo riproducibile della documentazione del tema Civic: link relativi rotti, nomi dei file .md, avanzi (.old/.tmp),
documenti raggiungibili dall'indice unico.

Dalla radice del tema (`laravel/Themes/Civic`), sola lettura:

  python3 -I docs/scripts/docs-audit.py links  [--list] [--json FILE]   conta i link relativi rotti nei .md di docs/
  python3 -I docs/scripts/docs-audit.py names  [--list]                 nomi non in kebab-case minuscolo (eccezioni: README.md ...)
  python3 -I docs/scripts/docs-audit.py leftovers                       .tmp / .old / .md_old / *.old.md rimasti in docs/
  python3 -I docs/scripts/docs-audit.py reach  [--list]                 .md di docs/ non raggiungibili da docs/README.md
  python3 -I docs/scripts/docs-audit.py all                             i quattro controlli; exit 1 se uno fallisce
  python3 -I docs/scripts/docs-audit.py baseline FILE.json              salva i numeri per il confronto prima/dopo

Perimetro: i file .md tracciati o non ignorati da git sotto `docs/` (`git ls-files -co --exclude-standard`), quindi le
cartelle generate e ignorate (graphify-out, Main_files) non contano.

Regole:
- link: inline `[t](p)`, immagini e definizioni `[t]: p`; fuori dai blocchi di codice e dai code span; si ignorano URL con schema,
  `#ancora`, percorsi assoluti, segnaposto (`{{ }}`, `$`, `<>`, `*`). Un link e' rotto se il bersaglio, risolto dalla cartella del
  file, non esiste su disco (un link a una cartella e' buono se la cartella esiste). Le ancore (`#...`) non sono verificate.
- nomi: `^[a-z0-9]+(-[a-z0-9]+)*(\\.story)?\\.md$`; eccezioni convenzionali README, CHANGELOG, AGENTS, CLAUDE, LICENSE,
  CONTRIBUTING, SECURITY. `docs/raw/` (reperti immutabili) e i file con prefisso `_` (modelli) sono esclusi.
- indice: `docs/README.md`; un link a una cartella raggiunge il `README.md` della cartella.

@see docs/github-surfaces.md
"""
from __future__ import annotations

import argparse
import json
import os
import re
import subprocess
import sys
from pathlib import Path
from urllib.parse import unquote

ROOT = Path(subprocess.run(["git", "rev-parse", "--show-toplevel"], capture_output=True, text=True, check=True).stdout.strip())
DOCS = ROOT / "docs"
INDEX = DOCS / "README.md"
CONVENTIONAL = {"README", "CHANGELOG", "AGENTS", "CLAUDE", "LICENSE", "CONTRIBUTING", "SECURITY"}
NAME_OK = re.compile(r"^[a-z0-9]+(?:-[a-z0-9]+)*(?:\.story)?$")
FENCE = re.compile(r"^\s{0,3}(```|~~~)")
CODE_SPAN = re.compile(r"`[^`\n]*`")
INLINE = re.compile(r"!?\[(?:[^\]\\]|\\.)*\]\(\s*(<[^>]+>|[^)\s]+)(?:\s+(?:\"[^\"]*\"|'[^']*'))?\s*\)")
REFDEF = re.compile(r"^\s{0,3}\[[^\]]+\]:\s*(<[^>]+>|\S+)")
SCHEME = re.compile(r"^[A-Za-z][A-Za-z0-9+.-]*:")
SKIP_TARGET = re.compile(r"[{}$<>*|]|%7B")
LEFTOVER = re.compile(r"(\.(tmp|old|bak|orig|md_old)$)|(\.old\.[a-z]+$)", re.I)


def tracked_files() -> list[str]:
    out = subprocess.run(
        ["git", "ls-files", "-co", "--exclude-standard", "-z", "docs"], capture_output=True, text=True, cwd=ROOT, check=True
    ).stdout
    return sorted(f for f in out.split("\0") if f and (ROOT / f).exists())


def md_files() -> list[str]:
    return [f for f in tracked_files() if f.endswith(".md")]


def link_targets(text: str):
    """(numero riga, bersaglio grezzo) dei link fuori da code block e code span."""
    in_fence = False
    for n, line in enumerate(text.splitlines(), 1):
        if FENCE.match(line):
            in_fence = not in_fence
            continue
        if in_fence:
            continue
        clean = CODE_SPAN.sub("", line)
        for m in INLINE.finditer(clean):
            yield n, m.group(1)
        m = REFDEF.match(clean)
        if m:
            yield n, m.group(1)


def resolve(src: str, raw: str) -> Path | None:
    """Percorso su disco a cui punta il link; None se non e' un link relativo verificabile."""
    t = raw.strip("<>").strip()
    if not t or t.startswith(("#", "/")) or SCHEME.match(t) or SKIP_TARGET.search(t):
        return None
    t = unquote(t.split("#", 1)[0].split("?", 1)[0])
    if not t:
        return None
    return Path(os.path.normpath((ROOT / src).parent / t))


def broken_links() -> tuple[list[tuple[str, int, str]], int]:
    broken, total = [], 0
    for f in md_files():
        try:
            text = (ROOT / f).read_text(encoding="utf-8", errors="replace")
        except OSError:
            continue
        for n, raw in link_targets(text):
            p = resolve(f, raw)
            if p is None:
                continue
            total += 1
            if not p.exists():
                broken.append((f, n, raw))
    return broken, total


def bad_names() -> list[str]:
    bad = []
    for f in md_files():
        if f.startswith("docs/raw/"):
            continue
        base = os.path.basename(f)
        if base.startswith("_"):
            continue
        stem = base[:-3]
        if stem in CONVENTIONAL or NAME_OK.match(stem):
            continue
        bad.append(f)
    return bad


def leftovers() -> list[str]:
    return [f for f in tracked_files() if LEFTOVER.search(os.path.basename(f))]


def reachable() -> tuple[set[str], list[str]]:
    docs = set(md_files())
    start = INDEX.relative_to(ROOT).as_posix()
    if start not in docs:
        return set(), sorted(docs)
    seen, queue = {start}, [start]
    while queue:
        cur = queue.pop()
        for _, raw in link_targets((ROOT / cur).read_text(encoding="utf-8", errors="replace")):
            p = resolve(cur, raw)
            if p is None:
                continue
            if p.is_dir():
                p = p / "README.md"
            try:
                rel = p.relative_to(ROOT).as_posix()
            except ValueError:
                continue
            if rel in docs and rel not in seen:
                seen.add(rel)
                queue.append(rel)
    return seen, sorted(docs - seen)


def cmd_links(a) -> int:
    broken, total = broken_links()
    files = len({b[0] for b in broken})
    print(f"link relativi verificabili: {total}; rotti: {len(broken)} in {files} file")
    if a.list:
        for f, n, raw in broken:
            print(f"{f}:{n}: {raw}")
    if a.json:
        Path(a.json).write_text(json.dumps([{"file": f, "line": n, "target": r} for f, n, r in broken], indent=1), encoding="utf-8")
    return 0


def cmd_names(a) -> int:
    bad = bad_names()
    print(f"nomi .md non conformi: {len(bad)}")
    if a.list:
        print("\n".join(bad))
    return 1 if bad else 0


def cmd_leftovers(_a) -> int:
    left = leftovers()
    print(f"avanzi (.tmp/.old/.md_old/*.old.*): {len(left)}")
    print("\n".join(left))
    return 1 if left else 0


def cmd_reach(a) -> int:
    seen, missing = reachable()
    print(f"documenti .md: {len(seen) + len(missing)}; raggiungibili da {INDEX.relative_to(ROOT)}: {len(seen)}; non raggiungibili: {len(missing)}")
    if a.list:
        print("\n".join(missing))
    return 1 if missing else 0


def cmd_baseline(a) -> int:
    broken, total = broken_links()
    seen, missing = reachable()
    data = {
        "md": len(md_files()),
        "links_verificabili": total,
        "links_rotti": len(broken),
        "nomi_non_conformi": len(bad_names()),
        "avanzi": len(leftovers()),
        "non_raggiungibili": len(missing),
    }
    Path(a.file).write_text(json.dumps(data, indent=1), encoding="utf-8")
    print(json.dumps(data))
    return 0


def cmd_all(a) -> int:
    a.list = False
    a.json = None
    codes = [cmd_links(a), cmd_names(a), cmd_leftovers(a), cmd_reach(a)]
    broken, _ = broken_links()
    return 1 if broken or any(codes) else 0


def main() -> int:
    ap = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    sub = ap.add_subparsers(dest="cmd", required=True)
    for name, fn in (("links", cmd_links), ("names", cmd_names), ("leftovers", cmd_leftovers), ("reach", cmd_reach), ("all", cmd_all)):
        p = sub.add_parser(name)
        p.add_argument("--list", action="store_true")
        if name == "links":
            p.add_argument("--json")
        p.set_defaults(fn=fn)
    p = sub.add_parser("baseline")
    p.add_argument("file")
    p.set_defaults(fn=cmd_baseline)
    a = ap.parse_args()
    return a.fn(a)


if __name__ == "__main__":
    sys.exit(main())

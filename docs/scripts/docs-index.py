#!/usr/bin/env python3
"""Rigenera il catalogo di `docs/README.md`: l'elenco di tutti i documenti .md di `docs/`, per area, con link relativi.

Dalla radice del tema (`laravel/Themes/Civic`):

  python3 -I docs/scripts/docs-index.py            riscrive il blocco generato di docs/README.md
  python3 -I docs/scripts/docs-index.py --check    non scrive; exit 1 se il blocco non e' aggiornato

Il blocco sta fra i marcatori `docs-index:begin` e `docs-index:end` (se mancano, viene aggiunto in fondo). Il resto di README.md
e' scritto a mano e non viene toccato. Perimetro: i .md tracciati o non ignorati sotto `docs/` (come `docs-audit.py`),
compresi `adr/`, `contracts/` e `stories/` (qui si leggono soltanto: non si modificano). Il titolo e' `title:` del frontmatter,
altrimenti il primo `# `, altrimenti il nome del file. Nessuna data nel blocco: lo stesso albero produce sempre lo stesso testo.

Verifica che ogni documento sia raggiungibile dall'indice: `python3 -I docs/scripts/docs-audit.py reach`.

@see docs/scripts/docs-audit.py
@see docs/README.md
"""
from __future__ import annotations

import argparse
import os
import re
import subprocess
import sys
from collections import defaultdict
from pathlib import Path
from urllib.parse import quote

ROOT = Path(subprocess.run(["git", "rev-parse", "--show-toplevel"], capture_output=True, text=True, check=True).stdout.strip())
README = ROOT / "docs" / "README.md"
BEGIN = "<!-- docs-index:begin (generato da docs/scripts/docs-index.py: non modificare a mano) -->"
END = "<!-- docs-index:end -->"
MAX_TITLE = 100
FRONTMATTER = re.compile(r"\A---\n(.*?)\n---\n", re.S)
TITLE_KEY = re.compile(r"^title:\s*(.+?)\s*$", re.M)
H1 = re.compile(r"^#\s+(.+?)\s*#*\s*$", re.M)


def md_files() -> list[str]:
    out = subprocess.run(["git", "ls-files", "-co", "--exclude-standard", "-z", "docs"], capture_output=True, text=True, cwd=ROOT, check=True).stdout
    files = {f for f in out.split("\0") if f.endswith(".md") and (ROOT / f).exists()}
    files.discard("docs/README.md")
    return sorted(files, key=lambda f: (os.path.dirname(f).lower(), os.path.basename(f).lower()))


def title_of(path: str) -> str:
    text = (ROOT / path).read_text(encoding="utf-8", errors="replace")
    title = None
    fm = FRONTMATTER.match(text)
    if fm:
        m = TITLE_KEY.search(fm.group(1))
        if m:
            title = m.group(1).strip().strip("\"'")
        text = text[fm.end():]
    if not title:
        m = H1.search(text)
        title = m.group(1) if m else os.path.basename(path)[:-3]
    title = " ".join(re.sub(r"[`*_]", "", title).split()) or os.path.basename(path)[:-3]
    title = title.replace("\\", "/").replace("[", "(").replace("]", ")").replace("<", "(").replace(">", ")")
    return title if len(title) <= MAX_TITLE else title[: MAX_TITLE - 1].rstrip() + "…"


def link(path: str) -> str:
    rel = os.path.relpath(path, "docs")
    return f"- [{title_of(path)}]({quote(rel, safe='/-_.~')})"


def build_block() -> str:
    files = md_files()
    areas: dict[str, list[str]] = defaultdict(list)
    for f in files:
        rel = os.path.relpath(f, "docs")
        areas[rel.split("/", 1)[0] if "/" in rel else ""].append(f)
    lines = [BEGIN, "", f"Documenti catalogati: {len(files)} (questo file escluso), in {len(areas)} aree.", ""]
    for area in sorted(areas, key=lambda a: (a != "", a.lower())):
        items = areas[area]
        label = "radice di `docs/`" if area == "" else f"`{area}/`"
        lines += [f"<details>", f"<summary><strong>{label}</strong>: {len(items)} documenti</summary>", ""]
        current = None
        for f in items:
            sub = os.path.dirname(os.path.relpath(f, "docs"))
            if area != "" and sub != current:
                current = sub
                if sub != area:
                    lines += ["", f"**`{sub}/`**", ""]
            lines.append(link(f))
        lines += ["", "</details>", ""]
    lines.append(END)
    return "\n".join(lines)


def main() -> int:
    ap = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    ap.add_argument("--check", action="store_true")
    args = ap.parse_args()
    block = build_block()
    text = README.read_text(encoding="utf-8")
    if BEGIN.split(" (")[0] in text and END in text:
        start = text.index(BEGIN.split(" (")[0])
        new = text[:start] + block + text[text.index(END) + len(END):]
    else:
        new = text.rstrip("\n") + "\n\n## Catalogo completo (generato)\n\n" + block + "\n"
    if args.check:
        if new != text:
            print("docs/README.md: il catalogo non e' aggiornato (python3 -I docs/scripts/docs-index.py)")
            return 1
        print("docs/README.md: catalogo aggiornato")
        return 0
    if new != text:
        README.write_text(new, encoding="utf-8")
    print(f"catalogo scritto: {block.count(chr(10) + '- [')} documenti")
    return 0


if __name__ == "__main__":
    sys.exit(main())

import re
from pathlib import Path

t = Path("resources/views/partials/framer/_body_about-us.blade.php").read_text(encoding="utf-8")

start = t.find('class="framer-l9N4n framer-TtKYf framer-18vrsrq"')
chunk = t[start : start + 120000]
print("chunk len", len(chunk))

for kw in ["History", "Values", "Team", "Certified", "Timeline", "Our "]:
    print(kw, chunk.find(kw))

# top-level direct children: after opening div, find immediate <div class="framer-
# naive: find all <section data-framer-name
for m in re.finditer(r'<section[^>]+data-framer-name="([^"]+)"', chunk):
    print("SECTION:", m.group(1))

# div with data-framer-name that might be section wrappers
for m in re.finditer(r'<div class="framer-[a-zA-Z0-9]+"[^>]*data-framer-name="([^"]+)"', chunk[:50000]):
    name = m.group(1)
    if len(name) < 60:
        print("DIV:", name)

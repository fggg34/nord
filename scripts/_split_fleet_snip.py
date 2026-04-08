raw = open("_fleet_section_snip.txt", "r", encoding="utf-8", errors="replace").read()
i = raw.find("<main")
main = raw[i:]
div_start = main.find('<div class="framer-8sf16o"')
print("8sf16o", div_start)
left = main[:div_start] if div_start != -1 else main
open("_fleet_left_fragment.html", "w", encoding="utf-8").write(left)
if div_start != -1:
    open("_fleet_cards_only.html", "w", encoding="utf-8").write(main[div_start : div_start + 9500])

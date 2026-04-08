"""Regenerate resources/views/partials/our-fleet/_fleet-section.blade.php from _fleet_left_fragment.html."""
from pathlib import Path

root = Path(__file__).resolve().parents[1]
left_path = root / "_fleet_left_fragment.html"
prep = left_path.read_text(encoding="utf-8").strip()
repls = [
    (
        "content('our-fleet', 'tag', 'p_vehicle_categories')",
        "content('our-fleet', 'fleet_categories', 'tag')",
    ),
    (
        "content('our-fleet', 'title', 'h3_built_for_every_route_and_requirement')",
        "content('our-fleet', 'fleet_categories', 'heading')",
    ),
    (
        "content('our-fleet', 'body', 'p_at_loginord_versatility_is_key_our_fleet_is_strategically_diversified_to_meet_the_full_spectrum_of_t')",
        "content('our-fleet', 'fleet_categories', 'intro_1')",
    ),
    (
        "content('our-fleet', 'body', 'p_whether_youre_moving_raw_materials_consumer_goods_or_specialized_cargo_we_have_the_right_vehicle_to_')",
        "content('our-fleet', 'fleet_categories', 'intro_2')",
    ),
    (
        "content('our-fleet', 'know_our_services', 'p_talk_to_our_fleet_team')",
        "content('our-fleet', 'fleet_categories', 'cta_label')",
    ),
    (
        'href="{{ url(\'/contact-us\') }}"',
        'href="{{ cms_link(content(\'our-fleet\', \'fleet_categories\', \'cta_url\'), \'/contact-us\') }}"',
    ),
    (
        'src="../assets/images/af40b499a662ffc7-3NSshCmK7vz6VHCPAq6twmsYQ.svg"',
        "src=\"{{ asset('assets/images/af40b499a662ffc7-3NSshCmK7vz6VHCPAq6twmsYQ.svg') }}\"",
    ),
]
for a, b in repls:
    if a not in prep:
        raise SystemExit(f"Missing substring in {left_path}: {a[:60]}…")
    prep = prep.replace(a, b)

cards = """
</div><div class="framer-8sf16o" data-framer-name="cards"><div class="ssr-variant hidden-1robhz6">
@forelse ($__fleetCategoryCards as $__idx => $__card)
@include('partials.our-fleet._fleet-category-card', ['card' => $__card, 'index' => $__idx, 'expanded' => $__idx === 0])
@empty
@endforelse
</div></div></div></main>
"""
head = """@php
    $__fleetCategoryCards = collect(json_decode(content('our-fleet', 'cms_repeaters', 'fleet_category_cards') ?? '[]', true) ?: [])->filter(fn ($r) => is_array($r))->values();
@endphp
@push('body_scripts')
    <script src="{{ asset('js/fleet-accordion.js') }}" defer></script>
@endpush
"""
out = head + prep + cards
target = root / "resources/views/partials/our-fleet/_fleet-section.blade.php"
target.write_text(out, encoding="utf-8")
print("OK", target.relative_to(root), len(out))

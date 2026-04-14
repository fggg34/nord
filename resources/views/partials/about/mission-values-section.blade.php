@php
    $mvTag = content('about-us', 'mission_values', 'tag') ?? 'OUR MISSION, VISION & VALUES';
    $mvHeading = content('about-us', 'mission_values', 'heading') ?? 'What Drives Us.';
    $rawItems = content('about-us', 'cms_repeaters', 'mission_values_items');
    $missionRows = [];
    if ($rawItems !== null && $rawItems !== '') {
        $decoded = json_decode($rawItems, true);
        if (is_array($decoded)) {
            foreach ($decoded as $row) {
                if (! is_array($row)) {
                    continue;
                }
                $missionRows[] = [
                    'title' => (string) ($row['title'] ?? ''),
                    'description' => (string) ($row['description'] ?? ''),
                    'arrow_image' => (string) ($row['arrow_image'] ?? ''),
                    'arrow_alt' => (string) ($row['arrow_alt'] ?? ''),
                ];
            }
        }
    }
    if ($missionRows === []) {
        $missionRows = [
            ['title' => 'Mission', 'description' => 'To deliver seamless, efficient, and honest logistics solutions for growing businesses.', 'arrow_image' => '', 'arrow_alt' => ''],
            ['title' => 'Vision', 'description' => 'To become the most trusted logistics partner for companies across borders.', 'arrow_image' => '', 'arrow_alt' => ''],
            ['title' => 'Values', 'description' => 'Reliability. Transparency. Sustainability. Respect.', 'arrow_image' => '', 'arrow_alt' => ''],
        ];
    }
    $defaultArrowSrc = asset('assets/images/ad0ec91db203cf1e-m1GbbtQhZ7EjlEriUBWyLPdgXPA.svg');
    $containerClasses = ['framer-1da65ss-container', 'framer-mo8p5h-container', 'framer-mf660z-container'];
@endphp
<section class="framer-1hu0j2w" data-framer-name="Our Values Section" id="stats-section">
    <div class="framer-1mx2u1x" data-framer-name="wrapper">
        <div class="ssr-variant hidden-13rutd2">
            <div class="framer-vjmcl9-container">
                <div class="framer-d1hoI framer-LQZ0A framer-q6mWm framer-O77o5 framer-T1vSl framer-1n7qzeg framer-v-1n7qzeg" data-framer-name="size title 3" style="max-width: 100%; width: 100%; opacity: 1;">
                    <div class="framer-1wz5kj7" data-framer-name="Tag + Title" style="opacity: 1;">
                        <div class="framer-lcc7dt" data-framer-name="tag" style="justify-content: center; --extracted-r6o4lv: var(--variable-reference-zEBtgtJTx-KUyYiRlWU); --framer-paragraph-spacing: 0px; --variable-reference-zEBtgtJTx-KUyYiRlWU: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                            <p class="framer-text framer-styles-preset-ily28r" data-styles-preset="jLcxwmdlI" dir="auto" style="--framer-text-alignment:left;--framer-text-color:var(--extracted-r6o4lv, var(--variable-reference-zEBtgtJTx-KUyYiRlWU))">{{ e($mvTag) }}</p>
                        </div>
                        <div class="framer-omfipc" data-framer-name="title" style="justify-content: center; --extracted-a0htzi: var(--variable-reference-zEBtgtJTx-KUyYiRlWU); --framer-paragraph-spacing: 0px; --variable-reference-zEBtgtJTx-KUyYiRlWU: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                            <h3 class="framer-text framer-styles-preset-1c03wm7" data-styles-preset="A4yf_ml_9" dir="auto" style="--framer-text-alignment:left;--framer-text-color:var(--extracted-a0htzi, var(--variable-reference-zEBtgtJTx-KUyYiRlWU))">{{ e($mvHeading) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="framer-1muy4y6" data-framer-name="Values">
            <div class="framer-1l4tggj hidden-13rutd2" data-framer-name="spacer"></div>
            <div class="framer-1nwrwe9" data-framer-name="content">
                @foreach ($missionRows as $idx => $row)
                    @php
                        $wrapClass = $containerClasses[$idx % count($containerClasses)];
                        $arrowSrc = cms_public_url($row['arrow_image'] ?? null, $defaultArrowSrc);
                        $arrowAlt = trim((string) ($row['arrow_alt'] ?? ''));
                    @endphp
                    <div class="ssr-variant">
                        <div class="{{ $wrapClass }}">
                            <div class="framer-8AHyQ framer-karxc framer-T1vSl framer-1w0rubh framer-v-1w0rubh" data-framer-name="block" style="width: 100%; opacity: 1;">
                                <figure class="framer-b2bu52" data-framer-name="arrow" style="will-change: transform; opacity:0; transform:translateY(40px);" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                                    <div class="framer-yftsd4" style="opacity: 1;">
                                        <div style="position:absolute;border-radius:inherit;corner-shape:inherit;top:0;right:0;bottom:0;left:0" data-framer-background-image-wrapper="true">
                                            <img decoding="auto" loading="lazy" width="40" height="40" src="{{ $arrowSrc }}" alt="{{ e($arrowAlt) }}" style="display:block;width:100%;height:100%;border-radius:inherit;corner-shape:inherit;object-position:center;object-fit:cover">
                                        </div>
                                    </div>
                                </figure>
                                <div class="framer-5ftja0" style="opacity: 1;">
                                    <div class="framer-25eomy" data-framer-name="title" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                                        <p class="framer-text framer-styles-preset-1q5693g" data-styles-preset="TLhS6ZgFj" dir="auto" style="--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($row['title'] !== '' ? $row['title'] : '—') }}</p>
                                    </div>
                                    <div class="framer-zo00g8" data-framer-name="text" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                                        <p class="framer-text framer-styles-preset-18qugew" data-styles-preset="CkgWlN8A8" dir="auto" style="--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($row['description']) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

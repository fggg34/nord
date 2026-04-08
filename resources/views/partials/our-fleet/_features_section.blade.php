@php
    $__fleetFeaturesCards = collect(json_decode(content('our-fleet', 'cms_repeaters', 'fleet_features_cards') ?? '[]', true) ?: [])
        ->filter(fn ($r) => is_array($r))
        ->values();
@endphp
<div class="framer-1qco6jt" data-framer-name="Block 1">
    <div class="ssr-variant">
        <div class="framer-1y6fko7-container">
            <div class="framer-nXI8G framer-FgXOS framer-T1vSl framer-108fdyp framer-v-108fdyp" data-framer-name="Variant 1" style="width: 100%; opacity: 1;">
                <div class="framer-1ehk1ey" data-framer-name="title" style="justify-content: center; --extracted-a0htzi: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                    <h3 class="framer-text framer-styles-preset-1ppejsv" data-styles-preset="Sh_ucc6ui" dir="auto" style="--framer-text-alignment:center;--framer-text-color:var(--extracted-a0htzi, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ content('our-fleet', 'features_section', 'heading') ?? 'Connected Fleet, Connected You.' }}</h3>
                </div>
                <div class="framer-1vosyro" data-framer-name="body" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                    <p class="framer-text framer-styles-preset-18qugew" data-styles-preset="CkgWlN8A8" dir="auto" style="--framer-text-alignment:center;--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ content('our-fleet', 'features_section', 'description') ?? 'Every vehicle is equipped with advanced telematics hardware, giving you real-time visibility and proactive alerts.' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="framer-1p21ela" data-framer-name="cards">
        @foreach ($__fleetFeaturesCards as $__card)
            @include('partials.our-fleet._fleet_features_card', ['card' => $__card])
        @endforeach
    </div>
</div>

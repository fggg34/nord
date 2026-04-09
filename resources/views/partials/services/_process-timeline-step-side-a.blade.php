{{-- Physical left column: copy is right-aligned toward the center line. --}}
@php
    $numRaw = trim((string) ($number ?? ''));
    if ($numRaw === '') {
        $numRaw = str_pad((string) ($fallback_step_index ?? 1), 2, '0', STR_PAD_LEFT);
    }
    $digits = str_split($numRaw) ?: ['0'];
@endphp
<div class="ssr-variant">
    <div class="framer-mxe4lo-container">
        <div class="framer-Gfq87 framer-kyBfp framer-T1vSl framer-1xchlsa framer-v-hsoes0" data-framer-name="right aligned" style="width: 100%; opacity: 1;">
            <div class="framer-nmbrnm" data-framer-name="nr + title" style="opacity: 1;">
                <div class="framer-jqc40s-container" style="will-change: transform; opacity:0; transform:translateY(40px);" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                    <div class="framer-rOBNv framer-LQZ0A framer-1rtee3t framer-v-1rtee3t" data-framer-name="tag" style="opacity: 1;">
                        <div class="framer-1jru3ku" data-border="true" data-framer-appear-id="1jru3ku" data-framer-name="shape" style="--border-bottom-width: 4px; --border-color: #c40023; --border-left-width: 4px; --border-right-width: 4px; --border-style: solid; --border-top-width: 4px; will-change: transform; border-radius: 56px; opacity: 1; transform: none;" data-nce-scroll="true"></div>
                        <div class="framer-12dfj9l" style="opacity: 1;">
                            <div class="framer-1u0caki" data-framer-name="text" style="justify-content: flex-end; --extracted-r6o4lv: var(--variable-reference-Jju9HfMVV-p7bgp70n3); --framer-paragraph-spacing: 0px; --variable-reference-Jju9HfMVV-p7bgp70n3: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); transform: none; opacity: 1;" data-framer-component-type="RichTextContainer">
                                <p class="framer-text framer-styles-preset-ily28r" data-styles-preset="jLcxwmdlI" dir="auto" style="--framer-text-color:var(--extracted-r6o4lv, var(--variable-reference-Jju9HfMVV-p7bgp70n3))">
                                    <span style="white-space:nowrap">
                                        @foreach ($digits as $d)
                                            <span style="display: inline-block; opacity:0; transform:translateY(40px); will-change: transform;" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">{{ e($d) }}</span>
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="framer-w1pjr1" data-framer-name="title" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                    <p class="framer-text framer-styles-preset-1m4fxxt" data-styles-preset="IcVUEeNmM" dir="auto" style="--framer-text-alignment:right;--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($title ?? '') }}</p>
                </div>
            </div>
            <div class="framer-141whlz" data-framer-name="text" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                <p class="framer-text framer-styles-preset-18qugew" data-styles-preset="CkgWlN8A8" dir="auto" style="--framer-text-alignment:right;--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($description ?? '') }}</p>
            </div>
        </div>
    </div>
</div>

@php
    $num = str_pad((string) $index, 2, '0', STR_PAD_LEFT);
    $digits = str_split($num);
    $imgPath = trim((string) ($image ?? ''));
    $imgSrc = cms_public_url($imgPath !== '' ? $imgPath : null, asset('assets/images/10b2101792bd7e4e-iBliZ6U0n2mOK6nHB0zA61chf4.webp'));
    $alt = trim((string) ($image_alt ?? ''));
    $imgAlt = $alt !== '' ? $alt : (trim((string) ($title ?? '')) !== '' ? $title : 'Service capability');
@endphp
<div class="framer-dgbr7p" data-framer-name="service card">
    <nav class="framer-15ex0b9" data-framer-name="stack">
        <div class="framer-1oeh707" data-framer-name="Title">
            <div class="ssr-variant">
                <div class="framer-poamg-container">
                    <div class="framer-rOBNv framer-LQZ0A framer-1rtee3t framer-v-1rtee3t" data-framer-name="tag" style="opacity: 1;">
                        <div class="framer-1jru3ku" data-border="true" data-framer-appear-id="1jru3ku" data-framer-name="shape" style="--border-bottom-width: 4px; --border-color: #c40023; --border-left-width: 4px; --border-right-width: 4px; --border-style: solid; --border-top-width: 4px; border-radius: 56px; opacity: 1; transform: none"></div>
                        <div class="framer-12dfj9l" style="opacity: 1;">
                            <div class="framer-1u0caki" data-framer-name="text" style="justify-content: flex-end; --extracted-r6o4lv: var(--variable-reference-Jju9HfMVV-p7bgp70n3); --framer-paragraph-spacing: 0px; --variable-reference-Jju9HfMVV-p7bgp70n3: var(--token-93ed733c-d50c-4cfe-9503-161904973ec7, rgb(255, 255, 255)); transform: none; opacity: 1;" data-framer-component-type="RichTextContainer">
                                <p class="framer-text framer-styles-preset-ily28r" data-styles-preset="jLcxwmdlI" dir="auto" style="--framer-text-color:var(--extracted-r6o4lv, var(--variable-reference-Jju9HfMVV-p7bgp70n3))">
                                    <span style="white-space:nowrap">
                                        @foreach ($digits as $d)
                                            <span style="display: inline-block; opacity: 1; transform: none">{{ $d }}</span>
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="framer-1cu97xx" data-framer-name="Stack" style="opacity: 1; transform: none">
                <div class="framer-8jnqgf" data-framer-name="title" style="justify-content:center;transform:none" data-framer-component-type="RichTextContainer">
                    <h4 class="framer-text framer-styles-preset-1ppejsv" data-styles-preset="Sh_ucc6ui" dir="auto" style="--framer-text-color:var(--token-93ed733c-d50c-4cfe-9503-161904973ec7, rgb(255, 255, 255))">{{ e($title) }}</h4>
                </div>
            </div>
        </div>
    </nav>
    <div class="framer-1eykh0c" data-framer-name="Img + body text">
        <div class="framer-1pn2fnr" data-framer-name="wrapper">
            <div class="framer-ki9inx" data-framer-name="image">
                <div class="ssr-variant">
                    <div class="framer-l71w6v-container" data-framer-name="img - service" name="img - service">
                        <div name="img - service" class="framer-Z0z4Z framer-rlntoc framer-v-ut5ihd" data-framer-name="image - start" style="max-height: 100%; width: 100%; border-radius: 8px; opacity: 1;">
                            <div class="framer-1nbhg90" data-framer-name="frame" style="background-color: #c40023; opacity: 1;"></div>
                            <figure class="framer-w9jxa7" data-framer-name="image" style="border-radius: 8px; opacity: 1;">
                                <div style="position:absolute;border-radius:inherit;corner-shape:inherit;top:0;right:0;bottom:0;left:0" data-framer-background-image-wrapper="true">
                                    <img decoding="auto" loading="lazy" width="2400" height="2227" src="{{ $imgSrc }}" alt="{{ e($imgAlt) }}" style="display:block;width:100%;height:100%;border-radius:inherit;corner-shape:inherit;object-position:center;object-fit:cover">
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="framer-rb6qxn" data-framer-name="texts">
                <div class="framer-22pk9s" data-framer-name="text - service">
                    <div class="framer-1vvie4t" data-framer-name="text" style="justify-content:center;will-change:transform;opacity:1;transform:none" data-framer-component-type="RichTextContainer" data-nce-scroll="true">
                        <div class="framer-text framer-styles-preset-18qugew cms-core-cap-body">{!! $body !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

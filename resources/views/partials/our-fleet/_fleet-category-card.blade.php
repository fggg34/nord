@php
    $title    = (string) ($card['title'] ?? '');
    $number   = (string) ($card['number'] ?? '');
    if ($number === '') {
        $number = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
    }
    $chars    = preg_split('//u', $number, -1, PREG_SPLIT_NO_EMPTY) ?: ['0', '1'];
    $img      = cms_public_url($card['image'] ?? null, asset('assets/images/b9e7aba949a61bc7-sqjR9log69svYrWvzRtPpLFHarc.jpg'));
    $alt      = (string) (($card['image_alt'] ?? '') !== '' ? $card['image_alt'] : $title);
    $body     = (string) ($card['body'] ?? '');
    $expanded = (bool) ($expanded ?? true);
@endphp

<div class="framer-1dyiqbv-container{{ $expanded ? '' : ' fleet-card-collapsed' }}">
    <div class="framer-4ASUa framer-kOAMY framer-T1vSl framer-karxc framer-het4pm framer-v-het4pm"
         data-framer-name="expanded" data-highlight="true" tabindex="0"
         style="--1pi171q: 32px 24px 32px 24px; background-color: var(--token-93ed733c-d50c-4cfe-9503-161904973ec7, rgb(255, 255, 255)); width: 100%; border-radius: 8px; opacity: 1;">

        {{-- Spacer --}}
        <div class="framer-1hgguji-container" style="transform: translateX(-50%); opacity: 1;">
            <div></div>
        </div>

        {{-- ── Header row: number + title + close/expand button ── --}}
        <div class="framer-132ktlz" data-framer-name="title + button" style="opacity: 1;">

            {{-- Number + Title --}}
            <div class="framer-i4ybcc" data-framer-name="nr + title" style="opacity: 1;">

                {{-- Number badge (orange dot + digits) --}}
                <div class="framer-18le97c-container"
                     style="opacity: 1;">
                    <div class="framer-rOBNv framer-LQZ0A framer-1rtee3t framer-v-1rtee3t"
                         data-framer-name="tag" style="opacity: 1;">
                        <div class="framer-1jru3ku" data-border="true" data-framer-appear-id="1jru3ku" data-framer-name="shape"
                             style="--border-bottom-width: 4px; --border-color: var(--token-0cfc16fd-3729-4b64-9ac8-d1037c8fcb3d, #c40023); --border-left-width: 4px; --border-right-width: 4px; --border-style: solid; --border-top-width: 4px; will-change: transform; border-radius: 56px; opacity: 1; transform: none;"
                             data-nce-scroll="true">
                        </div>
                        <div class="framer-12dfj9l" style="opacity: 1;">
                            <div class="framer-1u0caki" data-framer-name="text"
                                 style="justify-content: flex-end; --extracted-r6o4lv: var(--variable-reference-Jju9HfMVV-p7bgp70n3); --framer-paragraph-spacing: 0px; --variable-reference-Jju9HfMVV-p7bgp70n3: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); transform: none; opacity: 1;"
                                 data-framer-component-type="RichTextContainer">
                                <p class="framer-text framer-styles-preset-ily28r" data-styles-preset="jLcxwmdlI" dir="auto"
                                   style="--framer-text-color:var(--extracted-r6o4lv, var(--variable-reference-Jju9HfMVV-p7bgp70n3))">
                                    <span style="white-space:nowrap">
                                        @foreach ($chars as $ch)
                                            <span style="display: inline-block;">{{ e($ch) }}</span>
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Title --}}
                <div class="framer-174gm5d" data-framer-name="title"
                     style="justify-content: flex-start; --extracted-1w1cjl5: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; opacity: 1;"
                     data-framer-component-type="RichTextContainer">
                    <h6 class="framer-text framer-styles-preset-1adjllf" data-styles-preset="RzpL6gaF9" dir="auto"
                        style="--framer-text-color:var(--extracted-1w1cjl5, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">
                        {{ e($title !== '' ? $title : '—') }}
                    </h6>
                </div>

            </div>

            {{-- Close / Expand button --}}
            <div class="framer-ntvsza-container" style="opacity: 1;">
                <div class="framer-YuKtw framer-qsesjr framer-v-qsesjr" data-border="true" data-framer-name="contract"
                     style="--border-bottom-width: 1px; --border-color: var(--token-0cfc16fd-3729-4b64-9ac8-d1037c8fcb3d, #c40023); --border-left-width: 1px; --border-right-width: 1px; --border-style: solid; --border-top-width: 1px; background-color: rgba(0, 0, 0, 0); height: 100%; width: 100%; border-radius: 32px; transform: none; opacity: 1;">

                    {{-- X icon (close — visible when expanded) --}}
                    <div data-framer-component-type="SVG" data-framer-name="cross"
                         style="image-rendering: pixelated; flex-shrink: 0; opacity: 1;"
                         class="framer-1i90huq fleet-icon-close" aria-hidden="true">
                        <div class="svgContainer" style="width:100%;height:100%;aspect-ratio:inherit">
                            <svg viewBox="0 0 14 14" style="width:100%;height:100%;">
                                <path d="M 1.589 13.742 C 1.242 14.086 0.679 14.086 0.332 13.742 C -0.015 13.399 -0.015 12.842 0.332 12.499 L 5.853 7.036 L 0.26 1.501 C -0.087 1.158 -0.087 0.601 0.26 0.258 C 0.607 -0.086 1.17 -0.086 1.517 0.258 L 7.11 5.792 L 12.483 0.476 C 12.83 0.133 13.393 0.133 13.74 0.476 C 14.087 0.819 14.087 1.376 13.74 1.72 L 8.367 7.036 L 13.668 12.28 C 14.015 12.624 14.015 13.181 13.668 13.524 C 13.321 13.867 12.758 13.867 12.411 13.524 L 7.11 8.279 Z"
                                      fill="var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23))"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- + icon (expand — visible when collapsed) --}}
                    <div data-framer-component-type="SVG" data-framer-name="plus"
                         style="image-rendering: pixelated; flex-shrink: 0; opacity: 1;"
                         class="framer-1i90huq fleet-icon-expand" aria-hidden="true">
                        <div class="svgContainer" style="width:100%;height:100%;aspect-ratio:inherit">
                            <svg viewBox="0 0 14 14" style="width:100%;height:100%;">
                                <path d="M 7 0 C 7.552 0 8 0.448 8 1 L 8 6 L 13 6 C 13.552 6 14 6.448 14 7 C 14 7.552 13.552 8 13 8 L 8 8 L 8 13 C 8 13.552 7.552 14 7 14 C 6.448 14 6 13.552 6 13 L 6 8 L 1 8 C 0.448 8 0 7.552 0 7 C 0 6.448 0.448 6 1 6 L 6 6 L 6 1 C 6 0.448 6.448 0 7 0 Z"
                                      fill="var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23))"></path>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- ── Image ── --}}
        <div class="framer-1u1xu3x-container fleet-card-body" style="opacity: 1;">
            <div class="framer-Z0z4Z framer-rlntoc framer-v-ikh08d"
                 data-framer-name="image - end"
                 style="height: 100%; width: 100%; border-radius: 8px; opacity: 1;">
                <div class="framer-1nbhg90" data-framer-name="frame"
                     style="background-color: var(--token-0cfc16fd-3729-4b64-9ac8-d1037c8fcb3d, #c40023); transform: none; transform-origin: 50% 50% 0px;">
                </div>
                <figure class="framer-w9jxa7" data-framer-name="image" style="border-radius: 8px; opacity: 1;">
                    <div style="position:absolute;border-radius:inherit;corner-shape:inherit;top:0;right:0;bottom:0;left:0"
                         data-framer-background-image-wrapper="true">
                        <img decoding="auto" width="1920" height="1080"
                             src="{{ $img }}" alt="{{ e($alt) }}"
                             style="display:block;width:100%;height:100%;border-radius:inherit;corner-shape:inherit;object-position:center;object-fit:cover">
                    </div>
                </figure>
            </div>
        </div>

        {{-- ── Description / copy ── --}}
        <div class="framer-ecrg75 fleet-card-body" data-framer-name="copy" style="opacity: 1;">
            <div class="framer-1g9piqy" data-framer-name="text"
                 style="justify-content: flex-start; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; opacity: 1;"
                 data-framer-component-type="RichTextContainer">
                <div class="framer-text framer-styles-preset-18qugew" data-styles-preset="CkgWlN8A8" dir="auto"
                     style="--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">
                    {!! $body !!}
                </div>
            </div>
        </div>

    </div>
</div>

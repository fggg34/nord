@php
    $iconPath = trim((string) ($icon ?? ''));
    $iconSrc = cms_public_url($iconPath !== '' ? $iconPath : null, $fallback_icon_url ?? asset('assets/images/7f1511527afde3b3-9evVzCTgnvOhSapzBMvHCFEFTqs.svg'));
    $altText = trim((string) ($alt ?? ''));
    $iconAlt = $altText !== '' ? $altText : (trim((string) ($title ?? '')) !== '' ? $title : '');
@endphp
<div class="ssr-variant hidden-1k94c2q hidden-14ex2b4">
    <div class="framer-16ozw88-container">
        <div class="framer-68J19 framer-karxc framer-T1vSl framer-dhb081 framer-v-dhb081" data-framer-name="card" style="--12jzupl: row; --1ja08us: 1 0 0px; --fl74ms: 1px; width: 100%; opacity: 1;">
            <div class="framer-onr887" style="opacity: 1;">
                <div class="framer-1m53rzy" data-framer-name="icon" style="will-change: transform; opacity:0; transform:translateY(40px);" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                    <div style="position:absolute;border-radius:inherit;corner-shape:inherit;top:0;right:0;bottom:0;left:0" data-framer-background-image-wrapper="true">
                        <img decoding="auto" loading="lazy" width="32" height="32" src="{{ $iconSrc }}" alt="{{ e($iconAlt) }}" style="display:block;width:100%;height:100%;border-radius:inherit;corner-shape:inherit;object-position:center;object-fit:cover">
                    </div>
                </div>
                <div class="framer-qlfc52" data-framer-name="title" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                    <p class="framer-text framer-styles-preset-1q5693g" data-styles-preset="TLhS6ZgFj" dir="auto" style="--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($title ?? '') }}</p>
                </div>
            </div>
            <div class="framer-12ry61w" data-framer-name="text" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)">
                <p class="framer-text framer-styles-preset-18qugew" data-styles-preset="CkgWlN8A8" dir="auto" style="--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($description ?? '') }}</p>
            </div>
        </div>
    </div>
</div>

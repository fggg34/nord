@php
    $card = is_array($card ?? null) ? $card : [];
    $title = trim((string) ($card['title'] ?? ''));
    $description = trim((string) ($card['description'] ?? ''));
    $image = trim((string) ($card['image'] ?? ''));
    $alt = trim((string) ($card['alt'] ?? ''));
    if ($alt === '' && $title !== '') {
        $alt = $title;
    }
    $show = $title !== '' || $description !== '' || $image !== '';
    $placeholder = 'data:image/svg+xml,'.rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="400" height="240" viewBox="0 0 400 240"><rect width="400" height="240" fill="#fed9cd"/></svg>');
@endphp
@if ($show)
<div class="framer-vorhnd" data-framer-name="card">
    <div class="framer-btilnm" data-framer-name="image">
        <div class="ssr-variant" style="width:100%;height:100%;min-height:11.5rem;display:flex;align-items:center;justify-content:center;background:var(--token-1e0f44e7-e745-45d4-a9c4-0dd04bfcb626, rgb(254, 217, 205));border-radius:8px;overflow:hidden">
            @if ($image !== '')
                <img decoding="auto" loading="lazy" width="400" height="240" src="{{ cms_public_url($image, $placeholder) }}" alt="{{ e($alt) }}" style="width:100%;height:100%;object-fit:cover;min-height:11.5rem;display:block">
            @else
                <div style="width:100%;min-height:11.5rem" aria-hidden="true"></div>
            @endif
        </div>
    </div>
    <div class="ssr-variant">
        <div class="framer-u4qqmg-container">
            <div class="framer-BFD8b framer-Kgz85 framer-P94oq framer-1biizjd framer-v-1biizjd" data-framer-name="Variant 1" style="width: 100%; opacity: 1;">
                <div class="framer-14g3ffr" data-framer-name="title" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; transform: none; opacity: 1;" data-framer-component-type="RichTextContainer">
                    <p class="framer-text framer-styles-preset-7ice6b" data-styles-preset="vnnK8mUU3" dir="auto" style="--framer-text-alignment:center;--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($title) }}</p>
                </div>
                <div class="framer-g90v50" data-framer-name="description" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; transform: none; opacity: 1;" data-framer-component-type="RichTextContainer">
                    <p class="framer-text framer-styles-preset-1luqla7" data-styles-preset="c5ZxYZqDW" dir="auto" style="--framer-text-alignment:center;--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($description) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

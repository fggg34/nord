@php
    $index = (int) ($index ?? 0);
    $title = (string) ($title ?? '');
    $description = (string) ($description ?? '');
    $containerClasses = [
        'framer-9ddvuy-container',
        'framer-1j3br8g-container',
        'framer-xvzw1j-container',
        'framer-1nyieao-container',
    ];
    $wrapClass = $containerClasses[$index % count($containerClasses)];
@endphp
<div class="{{ $wrapClass }}" style="opacity: 1;">
<div class="framer-VIjlE framer-T1vSl framer-10b55xm framer-v-10b55xm" data-framer-name="Variant 1" style="width: 100%; opacity: 1;">
<div class="framer-13qnswk-container" style="opacity: 1;">
<!--$-->
<div style="display:flex;justify-content:center;align-items:center;gap:0px;flex-direction:row">
<span style="color: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)) !important; font-family: Urbanist, &quot;Urbanist Placeholder&quot;, sans-serif !important; font-size: calc(var(--framer-root-font-size, 1rem) * 4) !important; font-weight: 600 !important; line-height: 100% !important; letter-spacing: 0em !important; text-align: left !important; font-style: normal !important; padding: 0px !important; margin: 0px !important; box-sizing: content-box !important; white-space: nowrap !important; display: inline-block !important; align-self: flex-end !important;">
</span>
<span style="color: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)) !important; font-family: Urbanist, &quot;Urbanist Placeholder&quot;, sans-serif !important; font-size: calc(var(--framer-root-font-size, 1rem) * 4) !important; font-weight: 600 !important; line-height: 100% !important; letter-spacing: 0em !important; text-align: center !important; font-style: normal !important; padding: 0px !important; margin: 0px !important; box-sizing: content-box !important; white-space: nowrap !important; display: inline-block !important; align-self: baseline !important;">{{ e($title !== '' ? $title : '—') }}</span>
<span style="color: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)) !important; font-family: Urbanist, &quot;Urbanist Placeholder&quot;, sans-serif !important; font-size: calc(var(--framer-root-font-size, 1rem) * 4) !important; font-weight: 600 !important; line-height: 100% !important; letter-spacing: 0em !important; text-align: left !important; font-style: normal !important; padding: 0px !important; margin: 0px !important; box-sizing: content-box !important; white-space: nowrap !important; display: inline-block !important; align-self: flex-end !important;"></span>
</div>
<!--/$-->
</div>
<div class="framer-eotita" data-framer-name="body" style="justify-content: center; --extracted-r6o4lv: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); --framer-paragraph-spacing: 0px; transform: none; opacity: 1;" data-framer-component-type="RichTextContainer">
<p class="framer-text framer-styles-preset-18qugew" data-styles-preset="CkgWlN8A8" dir="auto" style="--framer-text-color:var(--extracted-r6o4lv, var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)))">{{ e($description) }}</p>
</div>
</div>
</div>

@php
    $fallback = asset('assets/images/ed05f9acd87eadf4-YS8lEtRBWRD8b6HqR7UwqBKcVAc.jpg');
    $src = cms_public_url(content('home', 'hero', 'hero_image'), $fallback);
@endphp
<img
    src="{{ $src }}"
    alt=""
    loading="eager"
    decoding="async"
    style="cursor:auto;width:100%;height:100%;border-radius:0px;display:block;object-fit:cover;background-color:var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23));object-position:50% 50%"
/>

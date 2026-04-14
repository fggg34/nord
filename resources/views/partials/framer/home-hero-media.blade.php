@php
    $fallback = asset('assets/images/ed05f9acd87eadf4-YS8lEtRBWRD8b6HqR7UwqBKcVAc.jpg');
    $__heroVideo = trim((string) (content('home', 'hero', 'hero_video') ?? ''));
    $__heroImage = trim((string) (content('home', 'hero', 'hero_image') ?? ''));
    $imgSrc = cms_public_url($__heroImage !== '' ? $__heroImage : null, $fallback);
    $videoSrc = $__heroVideo !== '' ? cms_public_url($__heroVideo, '') : '';
@endphp
@if ($__heroVideo !== '')
<video
    src="{{ $videoSrc }}"
    autoplay
    muted
    loop
    playsinline
    preload="auto"
    fetchpriority="high"
    style="cursor:auto;width:100%;height:100%;border-radius:0px;display:block;object-fit:cover;background-color:var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23));object-position:50% 50%"
></video>
@else
<img
    src="{{ $imgSrc }}"
    alt=""
    loading="eager"
    decoding="async"
    style="cursor:auto;width:100%;height:100%;border-radius:0px;display:block;object-fit:cover;background-color:var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23));object-position:50% 50%"
/>
@endif

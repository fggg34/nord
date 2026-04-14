@php
    $__featBgPath = trim((string) content('about-us', 'our_history', 'background_image'));
    $__featBgSrc = cms_public_url($__featBgPath !== '' ? $__featBgPath : null, asset('assets/images/f7700f312d212cef-RWfhGa3bv1AiOKKGCnBsOVGJcDE.webp'));
    $__featBgAlt = content('about-us', 'our_history', 'background_alt') ?: 'Truck on a local road';
@endphp
<div class="framer-nr4cy1" data-framer-name="background"><div class="framer-jj5911" data-framer-name="image"><div style="position:absolute;border-radius:inherit;corner-shape:inherit;top:0;right:0;bottom:0;left:0" data-framer-background-image-wrapper="true"><img decoding="auto" loading="lazy" width="2400" height="3600" src="{{ $__featBgSrc }}" alt="{{ e($__featBgAlt) }}" style="display:block;width:100%;height:100%;border-radius:inherit;corner-shape:inherit;object-position:center;object-fit:cover"></div></div><div class="framer-1eobsjm" data-framer-name="overlay"></div></div>

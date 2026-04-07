@php
    $card = is_array($card ?? null) ? $card : [];
    $title = trim((string) ($card['title'] ?? ''));
    $iconPath = trim((string) ($card['icon'] ?? ''));
    $alt = trim((string) ($card['alt'] ?? ''));
    $fallbackIcon = asset('assets/images/af40b499a662ffc7-3NSshCmK7vz6VHCPAq6twmsYQ.svg');
@endphp
@if ($title !== '')
<div class="framer-ch8301" data-framer-name="card"><div class="framer-whyus-illus" style="display:flex;align-items:center;justify-content:center;min-height:11rem;padding:1rem 0.75rem;background:var(--token-c9e785a9-c247-4ebc-b898-4c97fa07eb2d, rgb(231, 229, 228));border-radius:8px;margin:0 0 0.5rem 0"><img decoding="auto" loading="lazy" width="200" height="160" src="{{ cms_public_url($iconPath !== '' ? $iconPath : null, $fallbackIcon) }}" alt="{{ e($alt) }}" style="max-width:100%;max-height:9rem;width:auto;height:auto;object-fit:contain"></div><div class="framer-wf3fx2" data-framer-name="body" style="justify-content:center;transform:none" data-framer-component-type="RichTextContainer"><p class="framer-text framer-styles-preset-7ice6b" data-styles-preset="vnnK8mUU3" dir="auto" style="--framer-text-alignment:center;--framer-text-color:var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23))">{{ e($title) }}</p></div></div>
@endif

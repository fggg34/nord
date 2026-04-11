@php
    $logoPathPreload = content('settings', 'branding', 'logo');
    $logoPreloadUrl =
        $logoPathPreload !== null && trim((string) $logoPathPreload) !== ''
            ? cms_public_url($logoPathPreload, '')
            : '';
@endphp
@if ($logoPreloadUrl !== '')
    <link rel="preload" href="{{ $logoPreloadUrl }}" as="image" fetchpriority="high">
@endif
@php
    $favPath = content('settings', 'branding', 'favicon');
    $favUrl = ($favPath !== null && trim((string) $favPath) !== '')
        ? cms_public_url($favPath, '')
        : '';
    $favMime = '';
    if ($favPath !== null && trim((string) $favPath) !== '') {
        $ext = strtolower(pathinfo((string) $favPath, PATHINFO_EXTENSION));
        $favMime = match ($ext) {
            'svg' => 'image/svg+xml',
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'ico' => 'image/x-icon',
            default => '',
        };
    }
@endphp
@if ($favUrl !== '')
    <link rel="icon" href="{{ $favUrl }}"@if ($favMime !== '') type="{{ $favMime }}"@endif>
    <link rel="apple-touch-icon" href="{{ $favUrl }}">
@endif

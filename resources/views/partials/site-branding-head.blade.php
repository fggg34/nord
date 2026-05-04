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
    $favPathRaw = content('settings', 'branding', 'favicon');
    $favPathTrim = ($favPathRaw !== null && trim((string) $favPathRaw) !== '') ? trim((string) $favPathRaw) : '';
    $favUrl = $favPathTrim !== '' ? cms_public_url($favPathTrim, '') : '';

    $favBust = '';
    if ($favPathTrim !== '' && ! preg_match('#^https?://#i', $favPathTrim) && ! str_starts_with($favPathTrim, '/')) {
        if (str_starts_with($favPathTrim, 'assets/')) {
            $disk = public_path($favPathTrim);
        } else {
            $disk = public_path('storage/'.ltrim(str_replace('\\', '/', $favPathTrim), '/'));
        }
        if (is_file($disk)) {
            $favBust = '?v='.filemtime($disk);
        }
    }

    $favMime = '';
    if ($favPathTrim !== '') {
        $ext = strtolower(pathinfo($favPathTrim, PATHINFO_EXTENSION));
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

    $defaultLightFav = public_path('assets/images/47ca88889afac36a-54405mITjKzrnYbhvtkOGz9fM.svg');
    $defaultDarkFav = public_path('assets/images/dad6ab56b16aa0e8-pHNiOe8hCc9VlYYeYfAboBa5WQ.svg');
    $defaultApple = public_path('assets/images/96445f00d3c5d75f-KTXj89urIY9zn4OnyyO1jUvgYU.png');
    $defaultLightUrl = asset('assets/images/47ca88889afac36a-54405mITjKzrnYbhvtkOGz9fM.svg');
    $defaultDarkUrl = asset('assets/images/dad6ab56b16aa0e8-pHNiOe8hCc9VlYYeYfAboBa5WQ.svg');
    $defaultAppleUrl = asset('assets/images/96445f00d3c5d75f-KTXj89urIY9zn4OnyyO1jUvgYU.png');
    $defaultLightV = is_file($defaultLightFav) ? filemtime($defaultLightFav) : 0;
    $defaultDarkV = is_file($defaultDarkFav) ? filemtime($defaultDarkFav) : 0;
    $defaultAppleV = is_file($defaultApple) ? filemtime($defaultApple) : 0;
@endphp
@if ($favUrl !== '')
    <link rel="icon" href="{{ $favUrl }}{{ $favBust }}"@if ($favMime !== '') type="{{ $favMime }}"@endif>
    <link rel="apple-touch-icon" href="{{ $favUrl }}{{ $favBust }}">
@else
    <link rel="icon" href="{{ $defaultLightUrl }}?v={{ $defaultLightV }}" type="image/svg+xml" media="(prefers-color-scheme: light)">
    <link rel="icon" href="{{ $defaultDarkUrl }}?v={{ $defaultDarkV }}" type="image/svg+xml" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" href="{{ $defaultAppleUrl }}?v={{ $defaultAppleV }}">
@endif

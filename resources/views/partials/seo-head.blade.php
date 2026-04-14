@php
    $page = $page ?? 'home';
    $defaultTitle = $defaultTitle ?? '';
    $defaultDescription = $defaultDescription ?? '';
    $defaultOgImage = $defaultOgImage ?? '/assets/images/95221dd86b926b19-TUsk3ygy6f75eOtFugQRJAXcjFY.jpg';

    $pt = trim((string) (content($page, 'seo', 'meta_title') ?? ''));
    $pd = trim((string) (content($page, 'seo', 'meta_description') ?? ''));
    $po = trim((string) (content($page, 'seo', 'og_image') ?? ''));
    $pr = trim((string) (content($page, 'seo', 'robots') ?? ''));

    $siteName = trim((string) (content('settings', 'seo', 'site_name') ?? ''));
    $globalDesc = trim((string) (content('settings', 'seo', 'default_meta_description') ?? ''));
    $globalOg = trim((string) (content('settings', 'seo', 'default_og_image') ?? ''));
    $twitterCard = trim((string) (content('settings', 'seo', 'twitter_card') ?? ''));
    if ($twitterCard === '') {
        $twitterCard = 'summary_large_image';
    }

    $title = $pt !== '' ? $pt : $defaultTitle;
    $description = $pd !== '' ? $pd : ($globalDesc !== '' ? $globalDesc : $defaultDescription);

    $ogImageRaw = $po !== '' ? $po : ($globalOg !== '' ? $globalOg : $defaultOgImage);
    $ogImageUrl = seo_absolute_url($ogImageRaw);

    $canonical = url()->current();
@endphp
	<title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
@if($pr !== '')
    <meta name="robots" content="{{ $pr }}">
@endif
    <link rel="canonical" href="{{ $canonical }}">
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">
@if($siteName !== '')
    <meta property="og:site_name" content="{{ $siteName }}">
@endif
    <!-- Twitter -->
    <meta name="twitter:card" content="{{ $twitterCard }}">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImageUrl }}">

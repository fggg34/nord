<!DOCTYPE html>
<html{!! $htmlAttrs ?? ' lang="en" class="lenis"' !!}>
<head>
    @php
        $__framerOverridesPath = public_path('css/framer-overrides.css');
        $__siteHeaderCssPath = public_path('css/site-header.css');
        $__framerOverridesV = is_file($__framerOverridesPath) ? filemtime($__framerOverridesPath) : 0;
        $__siteHeaderCssV = is_file($__siteHeaderCssPath) ? filemtime($__siteHeaderCssPath) : 0;
    @endphp
    <base href="{{ url('/') }}">
    <meta name="google-site-verification" content="d6FRz3-dsK2ETo5_XnY6biS-YI6XTHydGzY8J3kanvE">
    @yield('head_inner')
    @stack('styles')
    @include('partials.site-branding-head')
    {{-- After Framer head + @stack: overrides win; ?v = filemtime for cache bust --}}
    <link rel="stylesheet" href="{{ asset('css/framer-overrides.css') }}?v={{ $__framerOverridesV }}">
    <link rel="stylesheet" href="{{ asset('css/site-header.css') }}?v={{ $__siteHeaderCssV }}">
</head>
<body class="{{ request()->is('/') ? 'page-home' : 'page-inner' }}{{ request()->is('contact-us') ? ' page-contact-us' : '' }}">
    <script src="{{ asset('js/cms-framer-split-titles.js') }}"></script>
    @include('partials.site-branding-body')
    @include('partials.site-header')
    @yield('body_inner')
    @stack('body_scripts')
</body>
</html>

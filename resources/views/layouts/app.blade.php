<!DOCTYPE html>
<html{!! $htmlAttrs ?? ' lang="en" class="lenis"' !!}>
<head>
    <base href="{{ url('/') }}">
    <meta name="google-site-verification" content="d6FRz3-dsK2ETo5_XnY6biS-YI6XTHydGzY8J3kanvE">
    @yield('head_inner')
    <link rel="stylesheet" href="{{ asset('css/framer-overrides.css') }}?v={{ is_file($__p = public_path('css/framer-overrides.css')) ? filemtime($__p) : '0' }}">
    <link rel="stylesheet" href="{{ asset('css/site-header.css') }}?v={{ is_file($__p = public_path('css/site-header.css')) ? filemtime($__p) : '0' }}">
    @stack('styles')
    @include('partials.site-branding-head')
</head>
<body class="{{ request()->is('/') ? 'page-home' : 'page-inner' }}">
    <script src="{{ asset('js/cms-framer-split-titles.js') }}"></script>
    @include('partials.site-branding-body')
    @include('partials.site-header')
    @yield('body_inner')
    @stack('body_scripts')
</body>
</html>

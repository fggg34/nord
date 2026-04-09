<!DOCTYPE html>
<html{!! $htmlAttrs ?? ' lang="en" class="lenis"' !!}>
<head>
    <base href="{{ url('/') }}">
    @yield('head_inner')
    <link rel="stylesheet" href="{{ asset('css/framer-overrides.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site-header.css') }}">
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

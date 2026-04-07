<!DOCTYPE html>
<html{!! $htmlAttrs ?? ' lang="en" class="lenis"' !!}>
<head>
    <base href="{{ url('/') }}">
    @yield('head_inner')
    <link rel="stylesheet" href="{{ asset('css/framer-overrides.css') }}">
    @stack('styles')
    @include('partials.site-branding-head')
</head>
<body>
    <script src="{{ asset('js/cms-framer-split-titles.js') }}"></script>
    @include('partials.site-branding-body')
    @yield('body_inner')
    @stack('body_scripts')
</body>
</html>

<!DOCTYPE html>
<html{!! $htmlAttrs ?? ' lang="en" class="lenis"' !!}>
<head>
    <base href="{{ url('/') }}">
    @yield('head_inner')
    <link rel="stylesheet" href="{{ asset('css/framer-overrides.css') }}">
</head>
<body>
    <script src="{{ asset('js/cms-framer-split-titles.js') }}"></script>
    @yield('body_inner')
</body>
</html>

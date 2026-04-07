<!DOCTYPE html>
<html{!! $htmlAttrs ?? ' lang="en" class="lenis"' !!}>
<head>
    <base href="{{ url('/') }}">
    @yield('head_inner')
</head>
<body>
    <script src="{{ asset('js/cms-framer-split-titles.js') }}"></script>
    @yield('body_inner')
</body>
</html>

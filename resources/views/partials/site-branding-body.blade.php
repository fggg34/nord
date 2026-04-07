@php
    $logoPath = content('settings', 'branding', 'logo');
    $logoUrl = ($logoPath !== null && trim((string) $logoPath) !== '')
        ? cms_public_url($logoPath, '')
        : '';
@endphp
@if ($logoUrl !== '')
    <script>
        (function () {
            var u = @json($logoUrl);
            function apply() {
                document.querySelectorAll('a[data-framer-name="logo"] img').forEach(function (img) {
                    img.src = u;
                });
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', apply);
            } else {
                apply();
            }
            window.addEventListener('load', apply);
        })();
    </script>
@endif

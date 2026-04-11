@php
    $logoPath = content('settings', 'branding', 'logo');
    $logoUrl = ($logoPath !== null && trim((string) $logoPath) !== '')
        ? cms_public_url($logoPath, '')
        : '';
@endphp
@if ($logoUrl !== '')
    {{-- Header logo uses CMS URL from SSR (site-header); only Framer #main logos need this patch. --}}
    <script>
        (function () {
            var u = @json($logoUrl);
            function apply() {
                document
                    .querySelectorAll('#main a[data-framer-name="logo"] img')
                    .forEach(function (img) {
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

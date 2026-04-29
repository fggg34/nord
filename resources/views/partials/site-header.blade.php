@php
    $logoFallback = asset('assets/images/7a8ad5ffe1d0e0dd-gAwdzX5sAYe1G4iwpCz5uyohzY.svg');
    $logoPath = content('settings', 'branding', 'logo');
    $logoSrc =
        $logoPath !== null && trim((string) $logoPath) !== ''
            ? cms_public_url($logoPath, $logoFallback)
            : $logoFallback;
    $quoteHref = route('contact-us') . '#contacts';
    $nav = [];
    $rawHeaderNav = content('settings', 'cms_repeaters', 'header_nav_items');
    $headerNavItems = json_decode($rawHeaderNav ?? '[]', true);
    if (is_array($headerNavItems)) {
        foreach ($headerNavItems as $row) {
            if (! is_array($row)) {
                continue;
            }
            $label = trim((string) ($row['label'] ?? ''));
            if ($label === '') {
                continue;
            }
            $linkRaw = isset($row['link']) ? trim((string) $row['link']) : '';
            $nav[] = [
                'label' => $label,
                'url' => cms_link($linkRaw !== '' ? $linkRaw : null, '/'),
            ];
        }
    }
    if ($nav === []) {
        $nav = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'About Us', 'url' => url('/about-us')],
            ['label' => 'Services', 'url' => url('/services')],
            ['label' => 'Fleet', 'url' => url('/our-fleet')],
            ['label' => 'Contact Us', 'url' => url('/contact-us')],
        ];
    }
@endphp
<header class="site-header" role="banner" aria-label="Primary">
    <div class="site-header__inner">
        <a
            class="site-header__logo"
            href="{{ url('/') }}"
            data-framer-name="logo"
            aria-label="Company logo. Leads to homepage"
        >
            <img
                src="{{ $logoSrc }}"
                width="186"
                height="45"
                alt=""
                decoding="sync"
                fetchpriority="high"
            />
        </a>
        <nav
            class="site-header__nav-wrap"
            id="site-header-menu"
            aria-label="Primary navigation"
        >
            <ul class="site-header__nav">
                @foreach ($nav as $item)
                    @php
                        $active = rtrim(request()->url(), '/') === rtrim($item['url'], '/');
                    @endphp
                    <li>
                        <a
                            href="{{ $item['url'] }}"
                            @if ($active) aria-current="page" @endif
                            class="{{ $active ? 'is-active' : '' }}"
                        ><span>{{ $item['label'] }}</span></a>
                    </li>
                @endforeach
            </ul>
            <div class="site-header__cta site-header__cta--drawer">
                @include('partials.site-header-quote-button')
            </div>
        </nav>
        <div class="site-header__actions">
            <div class="site-header__cta site-header__cta--bar">
                @include('partials.site-header-quote-button')
            </div>
            <button
                type="button"
                class="site-header__menu-btn"
                id="site-header-menu-toggle"
                aria-expanded="false"
                aria-controls="site-header-menu"
                aria-label="Open menu"
            >
                <span class="site-header__menu-btn-lines" aria-hidden="true"></span>
            </button>
        </div>
    </div>
</header>
<script>
    (function () {
        var root = document.querySelector('.site-header');
        var btn = document.getElementById('site-header-menu-toggle');
        var nav = document.getElementById('site-header-menu');
        if (!root || !btn) return;

        var mqMobile = window.matchMedia('(max-width: 809.98px)');

        function syncNavAria() {
            if (!nav) return;
            if (!mqMobile.matches) {
                nav.removeAttribute('aria-hidden');
                return;
            }
            nav.setAttribute('aria-hidden', root.classList.contains('is-menu-open') ? 'false' : 'true');
        }

        function setOpen(open) {
            root.classList.toggle('is-menu-open', open);
            btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            btn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
            document.body.classList.toggle('site-header-menu-open', open);
            syncNavAria();
        }

        function close() {
            setOpen(false);
        }

        btn.addEventListener('click', function () {
            setOpen(!root.classList.contains('is-menu-open'));
        });

        root.querySelectorAll('.site-header__nav a').forEach(function (link) {
            link.addEventListener('click', close);
        });

        root.querySelectorAll('a.site-header__quote').forEach(function (quoteLink) {
            quoteLink.addEventListener('click', function (e) {
                close();
                try {
                    var href = quoteLink.getAttribute('href');
                    if (!href || href.indexOf('#contacts') === -1) return;
                    var u = new URL(href, window.location.href);
                    if (u.hash !== '#contacts') return;
                    var section = document.getElementById('contacts');
                    if (!section) return;
                    var pathHere = window.location.pathname.replace(/\/$/, '') || '/';
                    var pathTarget = u.pathname.replace(/\/$/, '') || '/';
                    if (pathHere !== pathTarget) return;
                    e.preventDefault();
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    if (history.replaceState) {
                        history.replaceState(null, '', u.pathname + u.hash);
                    }
                } catch (err) {}
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') close();
        });

        window.addEventListener(
            'resize',
            function () {
                if (window.matchMedia('(min-width: 810px)').matches) close();
                syncNavAria();
            },
            { passive: true }
        );

        mqMobile.addEventListener('change', syncNavAria);
        syncNavAria();

        if (document.body.classList.contains('page-home')) {
            var scrollThreshold = 20;
            function syncScrolled() {
                var y = window.scrollY || document.documentElement.scrollTop || 0;
                root.classList.toggle('is-scrolled', y > scrollThreshold);
            }
            syncScrolled();
            window.addEventListener('scroll', syncScrolled, { passive: true });
        }
    })();
</script>

@php
    $logoDefault = asset('assets/images/7a8ad5ffe1d0e0dd-gAwdzX5sAYe1G4iwpCz5uyohzY.svg');
    $quoteHref = route('contact-us') . '#contacts';
    $nav = [
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'About Us', 'url' => url('/about-us')],
        ['label' => 'Services', 'url' => url('/services')],
        ['label' => 'Fleet', 'url' => url('/our-fleet')],
        ['label' => 'Contact Us', 'url' => url('/contact-us')],
    ];
@endphp
<header class="site-header" role="banner" aria-label="Primary">
    <div class="site-header__inner">
        <a
            class="site-header__logo"
            href="{{ url('/') }}"
            data-framer-name="logo"
            aria-label="Company logo. Leads to homepage"
        >
            <img src="{{ $logoDefault }}" width="132" height="32" alt="" decoding="async" />
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
        </nav>
        <div class="site-header__actions">
            <div class="site-header__cta">
                <a class="site-header__quote" href="{{ $quoteHref }}">
                    <span class="site-header__quote-text">Get a Quote</span>
                    <span class="site-header__quote-icon" aria-hidden="true">
                        <img
                            src="{{ asset('assets/images/af40b499a662ffc7-3NSshCmK7vz6VHCPAq6twmsYQ.svg') }}"
                            width="40"
                            height="40"
                            alt=""
                        />
                    </span>
                </a>
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

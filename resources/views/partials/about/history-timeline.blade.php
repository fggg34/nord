@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about-history-timeline.css') }}">
@endpush
@push('body_scripts')
    <script src="{{ asset('js/about-history-timeline.js') }}" defer></script>
@endpush

@php
    $historyHeading = content('about-us', 'our_history', 'heading') ?? 'Our History';
    $raw = content('about-us', 'cms_repeaters', 'history_timeline');
    $historyItems = [];
    if ($raw !== null && $raw !== '') {
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            foreach ($decoded as $row) {
                if (! is_array($row)) {
                    continue;
                }
                $historyItems[] = [
                    'year' => (string) ($row['year'] ?? ''),
                    'title' => (string) ($row['title'] ?? ''),
                    'description' => (string) ($row['description'] ?? ''),
                    'image' => (string) ($row['image'] ?? ''),
                    'alt' => (string) ($row['alt'] ?? ''),
                ];
            }
        }
    }
    if ($historyItems === []) {
        $historyItems = [
            ['year' => '2010', 'title' => 'One Truck. One Dream.', 'description' => "LogiNord was founded in a small Rotterdam warehouse with just one vehicle and a clear mission: to offer reliable transport for local businesses with the kind of service larger firms couldn\u{2019}t match.", 'image' => '', 'alt' => 'Truck parked in front of warehouse'],
            ['year' => '2013', 'title' => 'Cross-border growth.', 'description' => 'We expanded scheduled lanes into neighboring markets, added dedicated account managers, and invested in tracking so customers could see every shipment in real time.', 'image' => '', 'alt' => ''],
            ['year' => '2017', 'title' => 'Scale with standards.', 'description' => 'ISO-aligned processes, temperature-capable equipment, and a larger partner network helped us serve food, retail, and industrial clients without losing the personal touch.', 'image' => '', 'alt' => ''],
            ['year' => '2021', 'title' => 'US hub, one team.', 'description' => "A Houston office brought US coverage under the same operations playbook as Europe\u{2014}single point of contact, shared compliance rigor, and 24/7 coordination.", 'image' => '', 'alt' => ''],
            ['year' => '2025', 'title' => 'Next-mile innovation.', 'description' => 'Today we combine experienced planners with modern tooling: smarter routing, emissions-aware options, and the flexibility to plug into your ERP or TMS.', 'image' => '', 'alt' => ''],
        ];
    }
@endphp

<main class="loginord-history framer-lffq0j" data-framer-name="Our history" id="our-history"
      style="--history-count: {{ count($historyItems) }}">
    <div class="loginord-history__pin">
        <h2 class="loginord-history__heading">{{ e($historyHeading) }}</h2>

        <div class="loginord-history__body">
            {{-- Left: tag indicator + years --}}
            <div class="loginord-history__left">
                <div class="loginord-history__left-inner">
                    <div class="loginord-history__indicator" aria-hidden="true">
                        <span class="loginord-history__dot"></span>
                        <span class="loginord-history__line"></span>
                        <span class="loginord-history__tag">Year</span>
                    </div>

                    <div class="loginord-history__years" role="tablist" aria-orientation="vertical">
                        @foreach ($historyItems as $idx => $item)
                            <button
                                type="button"
                                class="loginord-history__year{{ $idx === 0 ? ' is-active' : '' }}"
                                data-history-index="{{ $idx }}"
                                role="tab"
                                aria-selected="{{ $idx === 0 ? 'true' : 'false' }}"
                                id="our-history-year-{{ $idx }}"
                                aria-controls="our-history-pane-{{ $idx }}"
                            >{{ e($item['year'] !== '' ? $item['year'] : '—') }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right: content panes --}}
            <div class="loginord-history__right">
                <div class="loginord-history__panes">
                    @foreach ($historyItems as $idx => $item)
                        @php
                            $imgUrl = ($item['image'] ?? '') !== '' ? cms_public_url($item['image'], '') : '';
                        @endphp
                        <article
                            class="loginord-history__pane{{ $idx === 0 ? ' is-active' : '' }}"
                            data-history-index="{{ $idx }}"
                            role="tabpanel"
                            id="our-history-pane-{{ $idx }}"
                            aria-labelledby="our-history-year-{{ $idx }}"
                            @if ($idx !== 0) hidden @endif
                        >
                            <h3 class="loginord-history__pane-title">{{ e($item['title']) }}</h3>
                            <p class="loginord-history__pane-desc">{{ e($item['description']) }}</p>
                            <div class="loginord-history__media">
                                @if ($imgUrl !== '')
                                    <img src="{{ $imgUrl }}" alt="{{ e($item['alt'] ?? '') }}" width="1200" height="750" loading="lazy" decoding="async">
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>

<section class="framer-7izgl3" data-framer-name="Features Section" id="features"><div class="framer-1nw0ten" data-framer-name="wrapper"><div class="ssr-variant hidden-1k94c2q"><div class="framer-1b72942-container"><div class="framer-d1hoI framer-LQZ0A framer-q6mWm framer-O77o5 framer-T1vSl framer-1n7qzeg framer-v-1n7qzeg" data-framer-name="size title 3" style="max-width: 100%; width: 100%; opacity: 1;"><div class="framer-1wz5kj7" data-framer-name="Tag + Title" style="opacity: 1;"><div class="framer-lcc7dt" data-framer-name="tag" style="justify-content: center; --extracted-r6o4lv: var(--variable-reference-zEBtgtJTx-KUyYiRlWU); --framer-paragraph-spacing: 0px; --variable-reference-zEBtgtJTx-KUyYiRlWU: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)"><p class="framer-text framer-styles-preset-ily28r" data-styles-preset="jLcxwmdlI" dir="auto" style="--framer-text-alignment:left;--framer-text-color:var(--extracted-r6o4lv, var(--variable-reference-zEBtgtJTx-KUyYiRlWU))">{{ content('services', 'features', 'tag') ?? 'FUELING EVERY MOVE' }}</p></div><div class="framer-omfipc" data-framer-name="title" style="justify-content: center; --extracted-a0htzi: var(--variable-reference-zEBtgtJTx-KUyYiRlWU); --framer-paragraph-spacing: 0px; --variable-reference-zEBtgtJTx-KUyYiRlWU: var(--token-0698ec6e-98d5-4dc5-82cd-980692a5f3e9, rgb(28, 24, 23)); will-change: transform; opacity:0; transform:translateY(40px);" data-framer-component-type="RichTextContainer" data-nce-scroll="true" data-nce-initial-transform="translateY(40px)"><h3 class="framer-text framer-styles-preset-1c03wm7" data-styles-preset="A4yf_ml_9" dir="auto" style="--framer-text-alignment:left;--framer-text-color:var(--extracted-a0htzi, var(--variable-reference-zEBtgtJTx-KUyYiRlWU))">{{ content('services', 'features', 'heading') ?? 'What Sets Us Apart:' }}</h3></div></div></div></div></div><div class="framer-1e9eghq" data-framer-name="features"><div class="framer-19oiuay hidden-1k94c2q" data-framer-name="spacer"></div><div class="framer-112nz65" data-framer-name="Stack">@php
    $__featuresRaw = content('services', 'cms_repeaters', 'features_items');
    $__featuresItems = json_decode($__featuresRaw ?: '[]', true);
    if (! is_array($__featuresItems)) {
        $__featuresItems = [];
    }
    $__featureIconFallbacks = [
        asset('assets/images/7f1511527afde3b3-9evVzCTgnvOhSapzBMvHCFEFTqs.svg'),
        asset('assets/images/9cb6162ed8f371a8-nNxIxSslCuOx4gx4QYOH0qVUlEY.svg'),
        asset('assets/images/80388aeb276a2311-gaR0VwBnC0N4APFwe98Wh6FNzA.svg'),
        asset('assets/images/41dd09a259e93519-ewowPWKy313pFX3YtxCqcFjFxg.svg'),
        asset('assets/images/b19f77a9d7bfe0b3-xfwVeEi5Q4ThoeqAvKoLkDEGjM.svg'),
    ];
@endphp
@forelse ($__featuresItems as $__fi => $__feature)
    @include('partials.services._features-item-card', [
        'title' => $__feature['title'] ?? '',
        'description' => $__feature['description'] ?? '',
        'icon' => $__feature['icon'] ?? '',
        'alt' => $__feature['alt'] ?? '',
        'fallback_icon_url' => $__featureIconFallbacks[$__fi % count($__featureIconFallbacks)] ?? asset('assets/images/7f1511527afde3b3-9evVzCTgnvOhSapzBMvHCFEFTqs.svg'),
    ])
@empty
@endforelse</div></div></div></section>
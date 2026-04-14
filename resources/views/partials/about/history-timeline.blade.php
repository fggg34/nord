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
    $historyBgPath = trim((string) (content('about-us', 'our_history', 'background_image') ?? ''));
    $historyBgAlt = (string) (content('about-us', 'our_history', 'background_alt') ?? '');
    $historyBgFallback = asset('assets/images/93745a2ce8d0ce1f-WLPKtH14Ct7v2NfwWdkFssnvloU.svg');
    $historyBgSrc = cms_public_url($historyBgPath !== '' ? $historyBgPath : null, $historyBgFallback);
@endphp

<main class="loginord-history framer-lffq0j loginord-history--framer-bg" id="our-history"
      style="--history-count: {{ count($historyItems) }}">
    <div class="framer-nr4cy1" data-framer-name="background">
        <div class="framer-jj5911" data-framer-name="image">
            <div style="position:absolute;border-radius:inherit;corner-shape:inherit;top:0;right:0;bottom:0;left:0" data-framer-background-image-wrapper="true">
                <img decoding="auto" loading="lazy" width="2400" height="3600" src="{{ $historyBgSrc }}" alt="{{ e($historyBgAlt) }}" style="display:block;width:100%;height:100%;border-radius:inherit;corner-shape:inherit;object-position:center;object-fit:cover">
            </div>
        </div>
        <div class="framer-1eobsjm" data-framer-name="content">
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
        </div>
    </div>
</main>

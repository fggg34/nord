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

<section class="framer-1usp193" data-framer-name="Features Section" id="features"><div class="ssr-variant"><div class="framer-1hroiaz-container"><div class="framer-TDsxi framer-uslge framer-v-uslge" data-framer-name="default" style="background-color: var(--token-1e0f44e7-e745-45d4-a9c4-0dd04bfcb626, rgb(254, 217, 205)); height: 100%; width: 100%; opacity: 1;"></div></div></div><div class="framer-8cyj1l" data-framer-name="wrapper">@include('partials.our-fleet._features_section')</div></section>

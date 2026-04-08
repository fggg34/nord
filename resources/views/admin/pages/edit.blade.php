@extends('admin.layouts.app')

@section('title', $pageLabel)

@section('content')
    @php
        $groupedMain = $grouped->except(['our_locations', 'team', 'certified']);
        $groupedOurLocations = $grouped->only(['our_locations']);
        $groupedTeam = $grouped->only(['team']);
        $groupedCertified = $grouped->only(['certified']);
        $groupedHomeServicesIndustries = collect();

        $repeatersMain = $repeaters;
        $repeatersTeamTail = collect();
        $repeatersCertifiedTail = collect();
        $repeatersServicesCoreCaps = collect();
        $repeatersServicesFeatures = collect();
        $repeatersServicesProcess = collect();
        $repeatersOurFleetByTheNumbers = collect();
        $repeatersOurFleetFleetCards = collect();
        $repeatersHomeServiceCards = collect();
        if ($page === 'about-us') {
            $repeatersTeamTail = $repeaters->filter(fn (array $r) => ($r['key'] ?? '') === 'team_members')->values();
            $repeatersCertifiedTail = $repeaters->filter(fn (array $r) => ($r['key'] ?? '') === 'certified_items')->values();
            $repeatersMain = $repeaters->filter(fn (array $r) => ! in_array($r['key'] ?? '', ['team_members', 'certified_items'], true))->values();
        }
        if ($page === 'services') {
            $repeatersServicesCoreCaps = $repeaters->filter(fn (array $r) => ($r['key'] ?? '') === 'core_capabilities')->values();
            $repeatersServicesFeatures = $repeaters->filter(fn (array $r) => ($r['key'] ?? '') === 'features_items')->values();
            $repeatersServicesProcess = $repeaters->filter(fn (array $r) => ($r['key'] ?? '') === 'process_steps')->values();
            $repeatersMain = $repeaters->filter(fn (array $r) => ! in_array($r['key'] ?? '', ['core_capabilities', 'features_items', 'process_steps'], true))->values();
        }
        if ($page === 'our-fleet') {
            $repeatersOurFleetByTheNumbers = $repeaters->filter(fn (array $r) => ($r['key'] ?? '') === 'by_the_numbers_items')->values();
            $repeatersOurFleetFleetCards = $repeaters->filter(fn (array $r) => ($r['key'] ?? '') === 'fleet_category_cards')->values();
            $repeatersMain = $repeaters->filter(fn (array $r) => ! in_array($r['key'] ?? '', ['by_the_numbers_items', 'fleet_category_cards'], true))->values();
        }
        if ($page === 'home') {
            $groupedMain = $groupedMain->except(['services_industries']);
            $groupedHomeServicesIndustries = $grouped->only(['services_industries']);
            $repeatersHomeServiceCards = $repeaters->filter(fn (array $r) => ($r['key'] ?? '') === 'service_cards')->values();
            $repeatersMain = $repeatersMain->filter(fn (array $r) => ($r['key'] ?? '') !== 'service_cards')->values();
        }
    @endphp

    <div class="cms-topbar">
        <div>
            <h1>{{ $pageLabel }}</h1>
            <p>
                @if ($page === 'settings')
                    Site-wide branding: upload a logo (header on all pages) and favicon (browser tab). Save to apply on the public site.
                @else
                    Edit copy for this page only. Changes apply on the public site after save.
                @endif
            </p>
        </div>
        <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
            @if (session('status'))
                <span class="cms-status">{{ session('status') }}</span>
            @endif
        </div>
    </div>

    <form method="post" action="{{ route('admin.pages.update', ['page' => $page]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.pages._content-section-cards', ['sections' => $groupedMain])

        @if ($page === 'home' && $groupedHomeServicesIndustries->isNotEmpty())
            @include('admin.pages._content-section-cards', ['sections' => $groupedHomeServicesIndustries])
        @endif

        @if ($page === 'home' && $repeatersHomeServiceCards->isNotEmpty())
            <x-admin.section-card
                title="Services (#industries-scroll) — cards"
                description="Heading and intro are edited in the section above. Here: each row is one service card on the public home page (#industries-scroll)."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersHomeServiceCards as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @if ($repeatersMain->isNotEmpty())
            <x-admin.section-card
                title="Structured repeaters"
                description="These store JSON in the database. Existing Framer-driven text fields above are unchanged. Use repeaters for lists you will render in custom templates or future components."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersMain as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @if ($repeatersServicesCoreCaps->isNotEmpty())
            <x-admin.section-card
                title="Our Services — capability cards (repeater)"
                description="Shown in #our-services on the public Services page (right column). Each row: title, image, alt text, and rich HTML body (TinyMCE)."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersServicesCoreCaps as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @if ($repeatersServicesFeatures->isNotEmpty())
            <x-admin.section-card
                title="Features section — rows (repeater)"
                description="Shown in #features on the public Services page (right column). Each row: icon, optional alt, title, and short description."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersServicesFeatures as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @if ($repeatersServicesProcess->isNotEmpty())
            <x-admin.section-card
                title="Our Process — timeline steps (repeater)"
                description="Shown in #process on the public Services page. Row order = timeline order: 1st, 3rd, 5th… on the right of the line; 2nd, 4th… on the left. Each row: step number, title, description."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersServicesProcess as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @if ($repeatersOurFleetByTheNumbers->isNotEmpty())
            <x-admin.section-card
                title="By the numbers — stat columns (repeater)"
                description="Shown in #stats-section on the public Our fleet page (right column grid). Each row: stat headline (e.g. 4+, 80%) and short description."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersOurFleetByTheNumbers as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @if ($repeatersOurFleetFleetCards->isNotEmpty())
            <x-admin.section-card
                title="Fleet section — category cards (repeater)"
                description="Shown in the Fleet section on the public Our fleet page (right column accordion). Each row: optional index, title, image, alt text, and rich HTML body (TinyMCE)."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersOurFleetFleetCards as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @include('admin.pages._content-section-cards', ['sections' => $groupedOurLocations])

        @include('admin.pages._content-section-cards', ['sections' => $groupedTeam])

        @if ($repeatersTeamTail->isNotEmpty())
            <x-admin.section-card
                title="Team — member cards (repeater)"
                description="Shown in the Team section on the public About page. Appears after Our Locations and team intro fields above."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersTeamTail as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @include('admin.pages._content-section-cards', ['sections' => $groupedCertified])

        @if ($repeatersCertifiedTail->isNotEmpty())
            <x-admin.section-card
                title="Certified — standard rows (repeater)"
                description="Shown in the Certified section on the public About page (#certified), after Team."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeatersCertifiedTail as $rep)
                        <x-admin.repeater
                            :label="$rep['label']"
                            :description="$rep['description'] ?? null"
                            :fields="$rep['fields']"
                            :items="$rep['items']"
                            :storage-key="$rep['storage_key']"
                        />
                    @endforeach
                </div>
            </x-admin.section-card>
        @endif

        @if (in_array($page, ['services', 'our-fleet'], true))
            @push('scripts')
                <script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>
                <script>
                    window.cmsInitRepTinyMCE = function (textareaEl, item, key) {
                        if (typeof tinymce === 'undefined' || !textareaEl || !item || !key) {
                            return;
                        }
                        var id = textareaEl.id;
                        if (!id || !/^[a-zA-Z0-9_-]+$/.test(id)) {
                            id = 'tmce_' + Math.random().toString(36).slice(2);
                            textareaEl.id = id;
                        }
                        if (tinymce.get(id)) {
                            tinymce.get(id).remove();
                        }
                        textareaEl.value = item[key] || '';
                        tinymce.init({
                            selector: '#' + id,
                            promotion: false,
                            license_key: 'gpl',
                            height: 320,
                            menubar: false,
                            plugins: 'lists link autoresize',
                            toolbar: 'blocks | bold italic | bullist numlist | link | removeformat | code',
                            browser_spellcheck: true,
                            setup: function (editor) {
                                editor.on('init', function () {
                                    editor.setContent(item[key] || '');
                                });
                                editor.on('change input Undo Redo KeyUp', function () {
                                    item[key] = editor.getContent();
                                });
                            },
                        });
                    };
                </script>
            @endpush
        @endif

        @if ($grouped->isEmpty() && $repeaters->isEmpty())
            <x-admin.section-card title="No fields yet">
                <p style="margin: 0; color: var(--cms-muted);">Run <code>php artisan site:instrument-content</code> to extract text into the database, or add rows manually.</p>
            </x-admin.section-card>
        @endif

        <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap; margin-top: 0.5rem;">
            <x-admin.primary-button type="submit">Save changes</x-admin.primary-button>
            <span style="font-size: 0.8rem; color: var(--cms-muted);">You are editing: <strong>{{ $page }}</strong></span>
        </div>
    </form>
@endsection

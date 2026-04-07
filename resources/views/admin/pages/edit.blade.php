@extends('admin.layouts.app')

@section('title', $pageLabel)

@section('content')
    @php
        use App\Support\CmsFieldPresenter;
    @endphp

    <div class="cms-topbar">
        <div>
            <h1>{{ $pageLabel }}</h1>
            <p>Edit copy for this page only. Changes apply on the public site after save.</p>
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

        @foreach ($grouped as $section => $rows)
            <x-admin.section-card :title="CmsFieldPresenter::sectionHeading($section)">
                <x-admin.field-grid class="cms-field-grid cms-field-grid--2">
                    @foreach ($rows as $row)
                        @php
                            $widget = CmsFieldPresenter::widget($row);
                            $fname = 'fields['.$row->id.']';
                        @endphp
                        @if ($widget['type'] === 'textarea')
                            <x-admin.form-field :label="CmsFieldPresenter::label($row)" span="2">
                                <x-admin.input-textarea
                                    :name="$fname"
                                    :value="old('fields.'.$row->id, $row->value)"
                                    placeholder="Enter text…"
                                />
                            </x-admin.form-field>
                        @elseif ($widget['type'] === 'select')
                            <x-admin.form-field :label="CmsFieldPresenter::label($row)">
                                <x-admin.input-select
                                    :name="$fname"
                                    :value="old('fields.'.$row->id, $row->value)"
                                    :options="$widget['options'] ?? []"
                                />
                            </x-admin.form-field>
                        @elseif ($widget['type'] === 'image')
                            @php
                                $fallback = asset('assets/images/ed05f9acd87eadf4-YS8lEtRBWRD8b6HqR7UwqBKcVAc.jpg');
                                $preview = cms_public_url($row->value, $fallback);
                            @endphp
                            <x-admin.form-field :label="CmsFieldPresenter::label($row)" span="2">
                                <div style="display: flex; flex-direction: column; gap: 0.75rem; align-items: flex-start;">
                                    <img
                                        src="{{ $preview }}"
                                        alt=""
                                        style="max-width: min(100%, 420px); max-height: 220px; object-fit: cover; border-radius: 8px; border: 1px solid var(--cms-border, #e5e7eb);"
                                    />
                                    <input
                                        type="file"
                                        name="files[{{ $row->id }}]"
                                        accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml"
                                        style="font-size: 0.85rem;"
                                    />
                                    <span style="font-size: 0.75rem; color: var(--cms-muted);">Upload replaces the current image. Uses the public disk (<code>storage/app/public</code> → <code>public/storage</code>).</span>
                                </div>
                            </x-admin.form-field>
                        @else
                            <x-admin.form-field :label="CmsFieldPresenter::label($row)">
                                <x-admin.input-text
                                    :name="$fname"
                                    :value="old('fields.'.$row->id, $row->value)"
                                    placeholder="Short text…"
                                />
                            </x-admin.form-field>
                        @endif
                    @endforeach
                </x-admin.field-grid>
            </x-admin.section-card>
        @endforeach

        @if ($repeaters->isNotEmpty())
            <x-admin.section-card
                title="Structured repeaters"
                description="These store JSON in the database. Existing Framer-driven text fields above are unchanged. Use repeaters for lists you will render in custom templates or future components."
            >
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @foreach ($repeaters as $rep)
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

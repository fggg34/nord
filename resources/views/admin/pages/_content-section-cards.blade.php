@php
    use App\Support\CmsFieldPresenter;
@endphp
@foreach ($sections as $section => $rows)
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
                                accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml,image/x-icon,.ico"
                                style="font-size: 0.85rem;"
                            />
                            <span style="font-size: 0.75rem; color: var(--cms-muted);">Upload replaces the current image. Uses the public disk (<code>storage/app/public</code> → <code>public/storage</code>).</span>
                        </div>
                    </x-admin.form-field>
                @elseif ($widget['type'] === 'video')
                    @php
                        $fallback = '';
                        $vid = trim((string) $row->value);
                        $preview = $vid !== '' ? cms_public_url($vid, $fallback) : '';
                    @endphp
                    <x-admin.form-field :label="CmsFieldPresenter::label($row)" span="2">
                        <div style="display: flex; flex-direction: column; gap: 0.75rem; align-items: flex-start;">
                            @if ($preview !== '')
                                <video
                                    src="{{ $preview }}"
                                    controls
                                    playsinline
                                    preload="metadata"
                                    style="max-width: min(100%, 420px); max-height: 220px; border-radius: 8px; border: 1px solid var(--cms-border, #e5e7eb); background: #111;"
                                ></video>
                            @else
                                <span style="font-size: 0.85rem; color: var(--cms-muted);">No video uploaded yet.</span>
                            @endif
                            <input
                                type="file"
                                name="files[{{ $row->id }}]"
                                accept="video/mp4,video/webm,video/ogg,video/quicktime,.mp4,.webm,.ogg,.mov"
                                style="font-size: 0.85rem;"
                            />
                            <span style="font-size: 0.75rem; color: var(--cms-muted);">Optional. If set on the home “Clients say” section, it replaces the side image on the public page. Max ~40&nbsp;MB.</span>
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

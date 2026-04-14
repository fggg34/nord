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
                        $stored = trim((string) $row->value);
                        $hasMedia = $stored !== '';
                        $preview = $hasMedia ? cms_public_url($stored, $fallback) : '';
                    @endphp
                    <x-admin.form-field :label="CmsFieldPresenter::label($row)" span="2">
                        <div class="cms-media-field" data-cms-media-row>
                            <div class="cms-media-preview-wrap">
                                @if ($preview !== '')
                                    <img src="{{ $preview }}" alt="" loading="lazy" decoding="async" />
                                @else
                                    <div class="cms-media-preview-wrap--empty">
                                        No custom image saved in the CMS yet. The public page uses the template default until you upload a file here—there is nothing to remove.
                                    </div>
                                @endif
                            </div>
                            <div class="cms-media-toolbar">
                                <input
                                    type="file"
                                    name="files[{{ $row->id }}]"
                                    accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml,image/x-icon,.ico"
                                />
                                @if ($hasMedia)
                                    <input type="hidden" name="clear_files[{{ $row->id }}]" value="1" class="cms-clear-file-input" disabled>
                                    <button type="button" class="cms-btn-remove-media" data-cms-remove-media aria-label="Remove image">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        Remove image
                                    </button>
                                @endif
                            </div>
                            @if ($hasMedia)
                                <div class="cms-media-clear-banner">
                                    <span>Current image will be removed when you save.</span>
                                    <button type="button" class="cms-btn-undo-clear" data-cms-undo-clear>Undo</button>
                                </div>
                            @endif
                            <p class="cms-media-help">Upload a new file to replace the image. Uses the public disk (<code>storage/app/public</code> → <code>public/storage</code>).</p>
                        </div>
                    </x-admin.form-field>
                @elseif ($widget['type'] === 'video')
                    @php
                        $fallback = '';
                        $vid = trim((string) $row->value);
                        $hasMedia = $vid !== '';
                        $preview = $vid !== '' ? cms_public_url($vid, $fallback) : '';
                    @endphp
                    <x-admin.form-field :label="CmsFieldPresenter::label($row)" span="2">
                        <div class="cms-media-field" data-cms-media-row>
                            <div class="cms-media-preview-wrap">
                                @if ($preview !== '')
                                    <video src="{{ $preview }}" controls playsinline preload="metadata"></video>
                                @else
                                    <div class="cms-media-preview-wrap--empty">No video uploaded yet.</div>
                                @endif
                            </div>
                            <div class="cms-media-toolbar">
                                <input
                                    type="file"
                                    name="files[{{ $row->id }}]"
                                    accept="video/mp4,video/webm,video/ogg,video/quicktime,.mp4,.webm,.ogg,.mov"
                                />
                                @if ($hasMedia)
                                    <input type="hidden" name="clear_files[{{ $row->id }}]" value="1" class="cms-clear-file-input" disabled>
                                    <button type="button" class="cms-btn-remove-media" data-cms-remove-media aria-label="Remove video">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        Remove video
                                    </button>
                                @endif
                            </div>
                            @if ($hasMedia)
                                <div class="cms-media-clear-banner">
                                    <span>Current video will be removed when you save.</span>
                                    <button type="button" class="cms-btn-undo-clear" data-cms-undo-clear>Undo</button>
                                </div>
                            @endif
                            <p class="cms-media-help">Optional. Max ~40&nbsp;MB. On the home “Clients say” section, a video replaces the side image on the public page.</p>
                        </div>
                    </x-admin.form-field>
                @elseif ($widget['type'] === 'image_or_video')
                    @php
                        $fallback = asset('assets/images/ed05f9acd87eadf4-YS8lEtRBWRD8b6HqR7UwqBKcVAc.jpg');
                        $stored = trim((string) $row->value);
                        $hasMedia = $stored !== '';
                        $preview = $stored !== '' ? cms_public_url($stored, $fallback) : '';
                        $isVid = $stored !== '' && cms_is_video_path($stored);
                    @endphp
                    <x-admin.form-field :label="CmsFieldPresenter::label($row)" span="2">
                        <div class="cms-media-field" data-cms-media-row>
                            <div class="cms-media-preview-wrap">
                                @if ($preview !== '')
                                    @if ($isVid)
                                        <video src="{{ $preview }}" controls playsinline preload="metadata"></video>
                                    @else
                                        <img src="{{ $preview }}" alt="" loading="lazy" decoding="async" />
                                    @endif
                                @else
                                    <div class="cms-media-preview-wrap--empty">No image or video yet.</div>
                                @endif
                            </div>
                            <div class="cms-media-toolbar">
                                <input
                                    type="file"
                                    name="files[{{ $row->id }}]"
                                    accept="image/jpeg,image/png,image/webp,image/gif,image/svg+xml,video/mp4,video/webm,video/quicktime,video/ogg"
                                />
                                @if ($hasMedia)
                                    <input type="hidden" name="clear_files[{{ $row->id }}]" value="1" class="cms-clear-file-input" disabled>
                                    <button type="button" class="cms-btn-remove-media" data-cms-remove-media aria-label="Remove file">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        Remove file
                                    </button>
                                @endif
                            </div>
                            @if ($hasMedia)
                                <div class="cms-media-clear-banner">
                                    <span>Current file will be removed when you save.</span>
                                    <button type="button" class="cms-btn-undo-clear" data-cms-undo-clear>Undo</button>
                                </div>
                            @endif
                            <p class="cms-media-help">Image (JPEG, PNG, WebP, SVG, GIF) or video (MP4, WebM, MOV). Max ~15&nbsp;MB per image, ~80&nbsp;MB per video.</p>
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

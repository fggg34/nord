@props([
    'label' => '',
    'description' => null,
    'fields' => [],
    'items' => [],
    'storageKey' => '',
])

@php
    $storagePrefix = '/storage/';
@endphp
<div x-data="cmsRepeater(@js($items), @js($fields), @js($storagePrefix))" style="border: 1px dashed var(--cms-border); border-radius: 10px; padding: 1rem; background: #f8fafc;">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap;">
        <div>
            <div style="font-weight: 600; font-size: 0.95rem;">{{ $label }}</div>
            @if ($description)
                <p style="margin: 0.35rem 0 0; font-size: 0.8rem; color: var(--cms-muted); max-width: 40rem;">{{ $description }}</p>
            @endif
        </div>
        <button type="button" @click="add()" style="flex-shrink: 0; display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1rem; font-weight: 600; font-size: 0.85rem; border: 1px solid var(--cms-border); border-radius: 8px; cursor: pointer; background: #fff; color: var(--cms-text);">+ Add item</button>
    </div>

    <template x-if="items.length === 0">
        <p style="margin: 0; font-size: 0.85rem; color: var(--cms-muted);">No items yet. Click “Add item” to start.</p>
    </template>

    <div style="display: flex; flex-direction: column; gap: 1rem;">
        <template x-for="(item, index) in items" :key="index">
            <div style="background: #fff; border: 1px solid var(--cms-border); border-radius: 10px; padding: 1rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                    <span style="font-size: 0.75rem; font-weight: 600; color: var(--cms-muted); text-transform: uppercase; letter-spacing: 0.04em;">Item <span x-text="index + 1"></span></span>
                    <button type="button" @click="remove(index)" style="font-size: 0.8rem; color: #b91c1c; background: none; border: 0; cursor: pointer; font-weight: 600;">Remove</button>
                </div>
                <div class="cms-field-grid cms-field-grid--2" style="display: grid; gap: 0.85rem; grid-template-columns: 1fr;">
                    <template x-for="f in fields" :key="f.key">
                        <div class="cms-repeater-field" :class="(f.type === 'textarea' || f.type === 'image' || f.type === 'image_or_video' || f.type === 'html') ? 'cms-span-2' : ''" style="min-width: 0;">
                            <label :for="'rep-'+index+'-'+f.key" style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem; color: var(--cms-muted);" x-text="f.label"></label>
                            <input x-show="f.type === 'text'" type="text" class="cms-rep-input" x-model="item[f.key]" :placeholder="f.placeholder || ''" :id="'rep-'+index+'-'+f.key">
                            <textarea x-show="f.type === 'textarea'" class="cms-rep-textarea" x-model="item[f.key]" rows="3" :placeholder="f.placeholder || ''" :id="'rep-'+index+'-'+f.key"></textarea>
                            <template x-if="f.type === 'html'">
                                <textarea
                                    class="cms-rep-html"
                                    rows="8"
                                    :id="'rep-html-'+index+'-'+f.key"
                                    x-init="$nextTick(() => { if (window.cmsInitRepTinyMCE) window.cmsInitRepTinyMCE($el, item, f.key); })"
                                ></textarea>
                            </template>
                            <div x-show="f.type === 'image' || f.type === 'image_or_video'" class="cms-rep-media-stack">
                                <div class="cms-rep-media-card">
                                    <div class="cms-rep-media-preview">
                                        <template x-if="item[f.key] && isVideoPath(item[f.key])">
                                            <video :src="storageSrc(item[f.key])" muted playsinline loop controls style="max-height: 100px; max-width: 100%; border-radius: 8px; border: 1px solid var(--cms-border); background: #0f172a;"></video>
                                        </template>
                                        <template x-if="item[f.key] && !isVideoPath(item[f.key])">
                                            <img :src="storageSrc(item[f.key])" alt="" style="max-height: 72px; max-width: 100%; width: auto; object-fit: contain; border-radius: 8px; border: 1px solid var(--cms-border);" />
                                        </template>
                                        <template x-if="!item[f.key]">
                                            <div style="font-size: 0.8rem; color: var(--cms-muted); padding: 0.35rem 0;">No file in this slot — upload to add.</div>
                                        </template>
                                    </div>
                                    <div class="cms-rep-media-actions">
                                        <input
                                            type="file"
                                            class="cms-rep-file"
                                            :name="'repeater_files[{{ $storageKey }}]['+index+']['+f.key+']'"
                                            :accept="f.type === 'image_or_video' ? 'image/jpeg,image/png,image/webp,image/gif,image/svg+xml,video/mp4,video/webm,video/quicktime,video/ogg' : 'image/jpeg,image/png,image/webp,image/gif,image/svg+xml'"
                                            :id="'rep-'+index+'-'+f.key"
                                        />
                                        <button
                                            type="button"
                                            class="cms-btn-remove-media"
                                            x-show="item[f.key]"
                                            @click="item[f.key] = ''; const inp = $el.closest('.cms-rep-media-actions').querySelector('.cms-rep-file'); if (inp) inp.value = '';"
                                            title="Clear this file (saved when you submit)"
                                        >
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                            <span x-text="f.type === 'image_or_video' ? 'Remove media' : 'Remove image'"></span>
                                        </button>
                                    </div>
                                </div>
                                <span x-show="f.type === 'image' && f.max_mb" style="font-size: 0.72rem; color: var(--cms-muted);">JPEG, PNG, WebP, SVG, or GIF (incl. animated). New upload replaces the stored file for this row. Max ~<span x-text="f.max_mb"></span>&nbsp;MB per image.</span>
                                <span x-show="f.type === 'image' && !f.max_mb" style="font-size: 0.72rem; color: var(--cms-muted);">JPEG, PNG, WebP, SVG, or GIF (incl. animated). New upload replaces the stored file for this row. Max ~15&nbsp;MB per image.</span>
                                <span x-show="f.type === 'image_or_video'" style="font-size: 0.72rem; color: var(--cms-muted);">Image (JPEG, PNG, WebP, SVG, GIF) or video (MP4, WebM, MOV). New upload replaces this row. Max ~15&nbsp;MB per image, ~80&nbsp;MB per video.</span>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>

    <input type="hidden" name="repeaters[{{ $storageKey }}]" :value="JSON.stringify(items)">
</div>
<style>
    @media (min-width: 700px) {
        .cms-field-grid.cms-field-grid--2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
        .cms-span-2 { grid-column: span 2; }
    }
    .cms-rep-input, .cms-rep-textarea {
        width: 100%;
        padding: 0.5rem 0.6rem;
        border: 1px solid var(--cms-border);
        border-radius: 8px;
        font: inherit;
    }
    .cms-rep-textarea { resize: vertical; min-height: 4rem; }
    .cms-rep-file { font-size: 0.85rem; max-width: 100%; }
</style>

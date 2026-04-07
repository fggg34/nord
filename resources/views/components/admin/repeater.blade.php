@props([
    'label' => '',
    'description' => null,
    'fields' => [],
    'items' => [],
    'storageKey' => '',
])

<div x-data="cmsRepeater(@js($items), @js($fields))" style="border: 1px dashed var(--cms-border); border-radius: 10px; padding: 1rem; background: #f8fafc;">
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
                        <div class="cms-repeater-field" :class="f.type === 'textarea' ? 'cms-span-2' : ''" style="min-width: 0;">
                            <label :for="'rep-'+index+'-'+f.key" style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem; color: var(--cms-muted);" x-text="f.label"></label>
                            <input x-show="f.type === 'text'" type="text" class="cms-rep-input" x-model="item[f.key]" :placeholder="f.placeholder || ''" :id="'rep-'+index+'-'+f.key">
                            <textarea x-show="f.type === 'textarea'" class="cms-rep-textarea" x-model="item[f.key]" rows="3" :placeholder="f.placeholder || ''" :id="'rep-'+index+'-'+f.key"></textarea>
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
</style>

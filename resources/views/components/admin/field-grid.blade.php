<div {{ $attributes->merge(['style' => 'display: grid; gap: 1rem 1.25rem; grid-template-columns: 1fr;']) }}
     class="cms-field-grid">
    {{ $slot }}
</div>
<style>
    @media (min-width: 900px) {
        .cms-field-grid.cms-field-grid--2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .cms-field-grid.cms-field-grid--2 .cms-span-2 { grid-column: span 2; }
    }
</style>

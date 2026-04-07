@props([
    'label' => '',
    'hint' => null,
    'span' => '1',
])

@php
    $spanClass = $span === '2' ? 'cms-span-2' : '';
@endphp

<div class="{{ $spanClass }}" style="min-width: 0;">
    @if ($label !== '')
        <label style="display: block; font-size: 0.8rem; font-weight: 600; color: var(--cms-text); margin-bottom: 0.35rem;">{{ $label }}</label>
    @endif
    {{ $slot }}
    @if ($hint)
        <div style="font-size: 0.72rem; color: var(--cms-muted); margin-top: 0.35rem; font-family: ui-monospace, monospace; word-break: break-all;">{{ $hint }}</div>
    @endif
</div>

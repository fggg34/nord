@props(['type' => 'button'])

<button
    type="{{ $type }}"
    {{ $attributes->merge(['style' => 'display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.55rem 1rem; font-weight: 600; font-size: 0.85rem; border: 1px solid var(--cms-border); border-radius: 8px; cursor: pointer; background: #fff; color: var(--cms-text); transition: background 0.15s;']) }}
>{{ $slot }}</button>

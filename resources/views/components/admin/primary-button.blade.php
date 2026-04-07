@props(['type' => 'button'])

<button
    type="{{ $type }}"
    {{ $attributes->merge(['style' => 'display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.15rem; font-weight: 600; font-size: 0.9rem; border: 0; border-radius: 8px; cursor: pointer; background: var(--cms-accent); color: #fff; box-shadow: 0 1px 2px rgba(37,99,235,0.25); transition: filter 0.15s, transform 0.1s;']) }}
>{{ $slot }}</button>

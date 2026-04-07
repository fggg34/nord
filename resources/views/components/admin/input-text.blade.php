@props([
    'name' => '',
    'value' => '',
    'id' => null,
    'placeholder' => '',
])

@php $fieldId = $id ?? str_replace(['[', ']'], '_', $name); @endphp
<input
    type="text"
    name="{{ $name }}"
    id="{{ $fieldId }}"
    value="{{ $value }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['style' => 'width: 100%; padding: 0.55rem 0.65rem; border: 1px solid var(--cms-border); border-radius: 8px; font: inherit; background: #fff; transition: border-color 0.15s, box-shadow 0.15s;']) }}
    onfocus="this.style.borderColor='var(--cms-accent)'; this.style.boxShadow='0 0 0 3px var(--cms-accent-soft)'"
    onblur="this.style.borderColor=''; this.style.boxShadow=''"
>

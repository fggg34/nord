@props([
    'name' => '',
    'value' => '',
    'id' => null,
    'placeholder' => '',
    'rows' => 4,
])

@php $fieldId = $id ?? str_replace(['[', ']'], '_', $name); @endphp
<textarea
    name="{{ $name }}"
    id="{{ $fieldId }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['style' => 'width: 100%; padding: 0.55rem 0.65rem; border: 1px solid var(--cms-border); border-radius: 8px; font: inherit; background: #fff; resize: vertical; min-height: 5rem; line-height: 1.45;']) }}
    onfocus="this.style.borderColor='var(--cms-accent)'; this.style.boxShadow='0 0 0 3px var(--cms-accent-soft)'"
    onblur="this.style.borderColor=''; this.style.boxShadow=''"
>{{ $value }}</textarea>

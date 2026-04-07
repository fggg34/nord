@props([
    'name' => '',
    'value' => '',
    'id' => null,
    'options' => [],
])

@php $fieldId = $id ?? str_replace(['[', ']'], '_', $name); @endphp
<select
    name="{{ $name }}"
    id="{{ $fieldId }}"
    {{ $attributes->merge(['style' => 'width: 100%; padding: 0.55rem 0.65rem; border: 1px solid var(--cms-border); border-radius: 8px; font: inherit; background: #fff;']) }}
>
    @foreach ($options as $optValue => $optLabel)
        <option value="{{ $optValue }}" @selected((string) $value === (string) $optValue)>{{ $optLabel }}</option>
    @endforeach
</select>

@props([
    'page',
    'section' => 'hero',
    'mediaKey',
    'altKey' => null,
    'defaultAlt' => '',
    'fallback',
    'style',
    'width' => null,
    'height' => null,
    'decoding' => null,
    'loading' => null,
    'fetchpriority' => null,
])

@php
    $raw = trim((string) (content($page, $section, $mediaKey) ?? ''));
    $storedPath = $raw !== '' ? $raw : null;
    $mediaUrl = cms_public_url($storedPath, $fallback);
    $altText = $altKey !== null
        ? (string) (content($page, $section, $altKey) ?? $defaultAlt)
        : $defaultAlt;
@endphp

@if (cms_is_video_path($storedPath))
    <video
        src="{{ $mediaUrl }}"
        @if ($width) width="{{ $width }}" @endif
        @if ($height) height="{{ $height }}" @endif
        autoplay
        muted
        loop
        playsinline
        preload="auto"
        @if (trim($altText) !== '')
            aria-label="{{ e($altText) }}"
        @else
            aria-hidden="true"
        @endif
        style="{{ $style }}"
    ></video>
@else
    <img
        src="{{ $mediaUrl }}"
        alt="{{ e($altText) }}"
        @if ($width) width="{{ $width }}" @endif
        @if ($height) height="{{ $height }}" @endif
        @if ($decoding !== null) decoding="{{ $decoding }}" @endif
        @if ($loading !== null) loading="{{ $loading }}" @endif
        @if ($fetchpriority !== null) fetchpriority="{{ $fetchpriority }}" @endif
        style="{{ $style }}"
    />
@endif

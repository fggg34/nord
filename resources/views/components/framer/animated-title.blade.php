@props([
    'page' => 'home',
    'section' => 'hero',
    'key' => 'title',
    'fallback' => '',
])

<span
    class="cms-framer-split-root"
    data-cms-text="{{ e(content($page, $section, $key) ?? $fallback) }}"
></span>
<script>window.__cmsFramerSplitBuildAdjacent(document.currentScript.previousElementSibling);</script>

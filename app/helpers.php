<?php

use App\Support\ContentRepository;

if (! function_exists('content')) {
    /**
     * Resolved CMS string for a page/section/key, or null when not defined in the database.
     * Use in Blade: {{ content('home', 'hero', 'title') ?? 'Original fallback' }}
     */
    function content(string $page, string $section, string $key): ?string
    {
        return ContentRepository::get($page, $section, $key);
    }
}

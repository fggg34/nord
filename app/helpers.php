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

if (! function_exists('cms_link')) {
    /**
     * Build a URL from CMS text: absolute http(s), site path (with optional #fragment), or fallback path.
     */
    function cms_link(?string $value, string $defaultPath): string
    {
        $v = ($value === null || trim($value) === '') ? $defaultPath : trim($value);
        if (preg_match('#^https?://#i', $v)) {
            return $v;
        }

        $parts = explode('#', $v, 2);
        $path = '/'.ltrim($parts[0], '/');
        $base = url($path);

        return isset($parts[1]) ? $base.'#'.$parts[1] : $base;
    }
}

if (! function_exists('cms_public_url')) {
    /**
     * Resolve a stored CMS path to a public URL (uploads on disk `public`, Framer `assets/`, or absolute URL).
     */
    function cms_public_url(?string $storedPath, string $fallback): string
    {
        if ($storedPath === null || trim($storedPath) === '') {
            return $fallback;
        }

        $v = trim($storedPath);
        if (preg_match('#^https?://#i', $v)) {
            return $v;
        }
        if (str_starts_with($v, '/')) {
            return $v;
        }
        if (str_starts_with($v, 'assets/')) {
            return asset($v);
        }

        // Root-relative so the browser uses the current host:port (e.g. 127.0.0.1:8000).
        // Storage::disk('public')->url() uses APP_URL only and breaks when APP_URL omits :8000.
        return '/storage/'.ltrim(str_replace('\\', '/', $v), '/');
    }
}

if (! function_exists('cms_is_video_path')) {
    /**
     * Whether a CMS media path points to a video file (by extension).
     */
    function cms_is_video_path(?string $storedPath): bool
    {
        if ($storedPath === null || trim($storedPath) === '') {
            return false;
        }

        return (bool) preg_match('/\.(mp4|webm|mov|ogv|m4v)(\?|#|$)/i', $storedPath);
    }
}

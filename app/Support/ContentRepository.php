<?php

namespace App\Support;

use App\Models\Content;
use Illuminate\Support\Facades\Cache;

class ContentRepository
{
    /** @var array<string, array<string, string>> */
    protected static array $runtime = [];

    public static function cacheKey(string $page): string
    {
        return 'site_contents_page_'.$page;
    }

    /**
     * @return array<string, string> map of "section\x1Ekey" => value
     */
    public static function loadPage(string $page): array
    {
        if (! isset(static::$runtime[$page])) {
            static::$runtime[$page] = Cache::remember(static::cacheKey($page), 3600, function () use ($page) {
                return Content::query()
                    ->where('page', $page)
                    ->get()
                    ->mapWithKeys(fn (Content $r) => ["{$r->section}\x1E{$r->key}" => $r->value])
                    ->all();
            });
        }

        return static::$runtime[$page];
    }

    public static function get(string $page, string $section, string $key): ?string
    {
        $map = static::loadPage($page);
        $full = "{$section}\x1E{$key}";

        if (! array_key_exists($full, $map)) {
            return null;
        }

        return $map[$full];
    }

    public static function forgetPage(string $page): void
    {
        unset(static::$runtime[$page]);
        Cache::forget(static::cacheKey($page));
    }

    public static function forgetAllRuntime(): void
    {
        static::$runtime = [];
    }
}

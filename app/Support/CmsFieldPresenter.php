<?php

namespace App\Support;

use App\Models\Content;
use Illuminate\Support\Str;

class CmsFieldPresenter
{
    public static function label(Content $row): string
    {
        $path = "{$row->page}.{$row->section}.{$row->key}";
        $labels = config('cms.field_labels', []);

        if (isset($labels[$path]) && is_string($labels[$path]) && $labels[$path] !== '') {
            return $labels[$path];
        }

        $key = $row->key;

        return Str::headline(str_replace(['_', '.'], ' ', $key));
    }

    /**
     * @return array{type: 'text'|'textarea'|'select'|'image'|'video'|'image_or_video', options?: array<string, string>}
     */
    public static function widget(Content $row): array
    {
        $path = "{$row->page}.{$row->section}.{$row->key}";
        $overrides = config('cms.field_overrides', []);

        if (isset($overrides[$path]) && is_array($overrides[$path])) {
            $o = $overrides[$path];
            $type = $o['type'] ?? 'text';
            if ($type === 'select' && isset($o['options']) && is_array($o['options'])) {
                return ['type' => 'select', 'options' => $o['options']];
            }
            if ($type === 'image') {
                return ['type' => 'image'];
            }
            if ($type === 'video') {
                return ['type' => 'video'];
            }
            if ($type === 'image_or_video') {
                return ['type' => 'image_or_video'];
            }

            return ['type' => in_array($type, ['text', 'textarea'], true) ? $type : 'text'];
        }

        $inferred = self::inferMediaWidgetFromKey((string) $row->key);
        if ($inferred !== null) {
            return $inferred;
        }

        if ($row->type === 'textarea') {
            return ['type' => 'textarea'];
        }

        if ($row->type === 'text') {
            return ['type' => 'text'];
        }

        if (in_array($row->section, ['hero', 'stats'], true)) {
            return ['type' => 'text'];
        }

        if (mb_strlen($row->value) > 180 || str_contains($row->value, "\n")) {
            return ['type' => 'textarea'];
        }

        return ['type' => 'text'];
    }

    /**
     * Detect image/video fields by key so the admin always shows upload + remove, even when
     * {@see Content::$type} is "text" (common for instrumented rows) or the field is missing
     * from config('cms.field_overrides'). Hero/banner fields were previously forced to plain text.
     *
     * @return array{type: 'image'|'video'|'image_or_video'}|null
     */
    public static function inferMediaWidgetFromKey(string $key): ?array
    {
        if ($key === 'left_media') {
            return ['type' => 'image_or_video'];
        }
        if ($key === 'banner_image') {
            return ['type' => 'image_or_video'];
        }
        if (str_ends_with($key, '_video')) {
            return ['type' => 'video'];
        }
        if (str_ends_with($key, '_image')) {
            return ['type' => 'image'];
        }

        return null;
    }

    public static function sectionHeading(string $section): string
    {
        $map = config('cms.section_labels', []);

        if (isset($map[$section]) && is_string($map[$section]) && $map[$section] !== '') {
            return $map[$section];
        }

        return Str::headline(str_replace('_', ' ', $section));
    }
}

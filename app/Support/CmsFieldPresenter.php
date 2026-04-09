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
     * @return array{type: 'text'|'textarea'|'select'|'image'|'video', options?: array<string, string>}
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

            return ['type' => in_array($type, ['text', 'textarea'], true) ? $type : 'text'];
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

    public static function sectionHeading(string $section): string
    {
        $map = config('cms.section_labels', []);

        if (isset($map[$section]) && is_string($map[$section]) && $map[$section] !== '') {
            return $map[$section];
        }

        return Str::headline(str_replace('_', ' ', $section));
    }
}

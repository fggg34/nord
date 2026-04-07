<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            ['page' => 'our-fleet', 'section' => 'hero', 'key' => 'tag', 'value' => 'INTRODUCING', 'type' => null],
            ['page' => 'our-fleet', 'section' => 'hero', 'key' => 'title', 'value' => 'Our Fleet in Motion.', 'type' => null],
            ['page' => 'our-fleet', 'section' => 'hero', 'key' => 'banner_image', 'value' => '', 'type' => null],
            ['page' => 'our-fleet', 'section' => 'hero', 'key' => 'banner_alt', 'value' => 'Truck on motion entering a bridge', 'type' => null],
            ['page' => 'our-fleet', 'section' => 'hero', 'key' => 'description', 'value' => 'Modern vehicles, advanced technology, total reliability — engineered to move your cargo safely and on time, every time.', 'type' => null],
        ];

        foreach ($rows as $row) {
            Content::query()->updateOrCreate(
                [
                    'page' => $row['page'],
                    'section' => $row['section'],
                    'key' => $row['key'],
                ],
                [
                    'value' => $row['value'],
                    'type' => $row['type'],
                ]
            );
        }
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'our-fleet')
            ->where('section', 'hero')
            ->whereIn('key', ['tag', 'title', 'banner_image', 'banner_alt', 'description'])
            ->delete();
    }
};

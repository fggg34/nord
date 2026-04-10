<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            ['page' => 'our-fleet', 'section' => 'fleet_categories', 'key' => 'left_media', 'value' => '', 'type' => null],
            ['page' => 'our-fleet', 'section' => 'fleet_categories', 'key' => 'left_media_alt', 'value' => '', 'type' => null],
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
            ->where('section', 'fleet_categories')
            ->whereIn('key', ['left_media', 'left_media_alt'])
            ->delete();
    }
};

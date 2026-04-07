<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            ['page' => 'services', 'section' => 'hero', 'key' => 'title', 'value' => 'Tailored Logistics', 'type' => null],
            ['page' => 'services', 'section' => 'hero', 'key' => 'tag', 'value' => 'OUR SERVICES', 'type' => null],
            ['page' => 'services', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'For a Global World.', 'type' => null],
            ['page' => 'services', 'section' => 'hero', 'key' => 'banner_image', 'value' => '', 'type' => null],
            ['page' => 'services', 'section' => 'hero', 'key' => 'banner_alt', 'value' => 'Loginord truck at warehouse', 'type' => null],
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
            ->where('page', 'services')
            ->where('section', 'hero')
            ->whereIn('key', ['title', 'tag', 'subtitle', 'banner_image', 'banner_alt'])
            ->delete();
    }
};

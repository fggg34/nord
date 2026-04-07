<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            ['page' => 'about-us', 'section' => 'hero', 'key' => 'tag', 'value' => 'About Us', 'type' => null],
            ['page' => 'about-us', 'section' => 'hero', 'key' => 'banner_image', 'value' => '', 'type' => null],
            ['page' => 'about-us', 'section' => 'hero', 'key' => 'banner_alt', 'value' => 'About Loginord', 'type' => null],
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
            ->where('page', 'about-us')
            ->where('section', 'hero')
            ->whereIn('key', ['tag', 'banner_image', 'banner_alt'])
            ->delete();
    }
};

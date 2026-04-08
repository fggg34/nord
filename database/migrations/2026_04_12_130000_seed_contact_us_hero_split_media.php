<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $flat = [
            ['page' => 'contact-us', 'section' => 'hero', 'key' => 'title', 'value' => 'Tailored Logistics', 'type' => null],
            ['page' => 'contact-us', 'section' => 'hero', 'key' => 'tag', 'value' => 'OUR SERVICES', 'type' => null],
            ['page' => 'contact-us', 'section' => 'hero', 'key' => 'subtitle', 'value' => 'For a Global World.', 'type' => null],
            ['page' => 'contact-us', 'section' => 'hero', 'key' => 'split_image_1', 'value' => '', 'type' => null],
            ['page' => 'contact-us', 'section' => 'hero', 'key' => 'split_image_2', 'value' => '', 'type' => null],
            ['page' => 'contact-us', 'section' => 'hero', 'key' => 'split_image_1_alt', 'value' => '', 'type' => null],
            ['page' => 'contact-us', 'section' => 'hero', 'key' => 'split_image_2_alt', 'value' => '', 'type' => null],
        ];

        foreach ($flat as $row) {
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
            ->where('page', 'contact-us')
            ->where('section', 'hero')
            ->whereIn('key', ['title', 'tag', 'subtitle', 'split_image_1', 'split_image_2', 'split_image_1_alt', 'split_image_2_alt'])
            ->delete();
    }
};

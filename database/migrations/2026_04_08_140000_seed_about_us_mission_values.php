<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'mission_values',
                'key' => 'tag',
            ],
            [
                'value' => 'OUR MISSION, VISION & VALUES',
                'type' => 'text',
            ]
        );

        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'mission_values',
                'key' => 'heading',
            ],
            [
                'value' => 'What Drives Us.',
                'type' => 'text',
            ]
        );

        $items = [
            [
                'title' => 'Mission',
                'description' => 'To deliver seamless, efficient, and honest logistics solutions for growing businesses.',
            ],
            [
                'title' => 'Vision',
                'description' => 'To become the most trusted logistics partner for companies across borders.',
            ],
            [
                'title' => 'Values',
                'description' => 'Reliability. Transparency. Sustainability. Respect.',
            ],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'cms_repeaters',
                'key' => 'mission_values_items',
            ],
            [
                'value' => json_encode($items, JSON_UNESCAPED_UNICODE),
                'type' => 'repeater',
            ]
        );
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'about-us')
            ->where('section', 'mission_values')
            ->whereIn('key', ['tag', 'heading'])
            ->delete();

        Content::query()
            ->where('page', 'about-us')
            ->where('section', 'cms_repeaters')
            ->where('key', 'mission_values_items')
            ->delete();
    }
};

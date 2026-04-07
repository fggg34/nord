<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $text = [
            ['key' => 'tag', 'value' => 'GLOBAL REACH. LOCAL STRENGTH.'],
            ['key' => 'heading', 'value' => 'Our Locations'],
            ['key' => 'subheading', 'value' => 'We Operate from two Strategic Hubs:'],
            ['key' => 'card_title', 'value' => 'Rotterdam, Netherlands'],
            ['key' => 'card_subtitle', 'value' => 'European Headquarters & Warehouse'],
            ['key' => 'card_body', 'value' => 'Located in the heart of Europe’s logistics corridor, our Rotterdam HQ oversees ground freight, regional distribution, and B2B partnerships across France, Germany, Benelux, and Spain.'],
            ['key' => 'card_image_alt', 'value' => 'Image of the Rotterdam Headquarters'],
            ['key' => 'background_alt', 'value' => 'Workers moving around on warehouse'],
        ];

        foreach ($text as $row) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'about-us',
                    'section' => 'our_locations',
                    'key' => $row['key'],
                ],
                [
                    'value' => $row['value'],
                    'type' => null,
                ]
            );
        }

        foreach (['card_image', 'background_image'] as $key) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'about-us',
                    'section' => 'our_locations',
                    'key' => $key,
                ],
                [
                    'value' => '',
                    'type' => null,
                ]
            );
        }
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'about-us')
            ->where('section', 'our_locations')
            ->delete();
    }
};

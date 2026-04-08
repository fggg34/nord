<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $flat = [
            ['page' => 'our-fleet', 'section' => 'features_section', 'key' => 'heading', 'value' => 'Connected Fleet, Connected You.', 'type' => null],
            ['page' => 'our-fleet', 'section' => 'features_section', 'key' => 'description', 'value' => 'Every vehicle is equipped with advanced telematics hardware, giving you real-time visibility and proactive alerts.', 'type' => null],
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

        $items = [
            ['image' => '', 'title' => 'Live GPS Tracking', 'description' => 'See exact location and ETA.', 'alt' => ''],
            ['image' => '', 'title' => 'API Integration', 'description' => 'Embed tracking into your TMS or portal.', 'alt' => ''],
            ['image' => '', 'title' => 'Automated Alerts', 'description' => 'Route deviations, temperature excursions.', 'alt' => ''],
            ['image' => '', 'title' => 'Telematics Dashboard', 'description' => 'Speed, fuel consumption, driver behavior.', 'alt' => ''],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'our-fleet',
                'section' => 'cms_repeaters',
                'key' => 'fleet_features_cards',
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
            ->where('page', 'our-fleet')
            ->where('section', 'features_section')
            ->whereIn('key', ['heading', 'description'])
            ->delete();

        Content::query()
            ->where('page', 'our-fleet')
            ->where('section', 'cms_repeaters')
            ->where('key', 'fleet_features_cards')
            ->delete();
    }
};

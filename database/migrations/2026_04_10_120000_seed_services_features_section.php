<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $flat = [
            ['page' => 'services', 'section' => 'features', 'key' => 'tag', 'value' => 'FUELING EVERY MOVE', 'type' => null],
            ['page' => 'services', 'section' => 'features', 'key' => 'heading', 'value' => 'What Sets Us Apart:', 'type' => null],
            ['page' => 'services', 'section' => 'features', 'key' => 'background_image', 'value' => '', 'type' => null],
            ['page' => 'services', 'section' => 'features', 'key' => 'background_alt', 'value' => 'Truck on a local road', 'type' => null],
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
            [
                'icon' => '',
                'alt' => '',
                'title' => 'Certified Reliability',
                'description' => 'ISO 9001 processes & time-definite performance.',
            ],
            [
                'icon' => '',
                'alt' => '',
                'title' => 'Own Fleet + Trusted Partners',
                'description' => 'Flexibility and control for consistent delivery.',
            ],
            [
                'icon' => '',
                'alt' => '',
                'title' => 'Dual-Hub Operations',
                'description' => 'Rotterdam & Houston coverage ensures global reach and regional precision.',
            ],
            [
                'icon' => '',
                'alt' => '',
                'title' => 'Client-Centric Integrations',
                'description' => 'API-based tracking, order management & EDI support.',
            ],
            [
                'icon' => '',
                'alt' => '',
                'title' => 'Scalable for Growth',
                'description' => 'Modular service plans for evolving business needs.',
            ],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'services',
                'section' => 'cms_repeaters',
                'key' => 'features_items',
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
            ->where('page', 'services')
            ->where('section', 'features')
            ->delete();

        Content::query()
            ->where('page', 'services')
            ->where('section', 'cms_repeaters')
            ->where('key', 'features_items')
            ->delete();
    }
};

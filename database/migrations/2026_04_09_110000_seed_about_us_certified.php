<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        foreach (
            [
                ['key' => 'tag', 'value' => 'INDUSTRY STANDARDS'],
                ['key' => 'heading', 'value' => 'Certified. Verified. Compliant.'],
                ['key' => 'intro', 'value' => 'Loginord operates under ISO 9001 standards and complies with HACCP and ADR regulations. All vehicles and processes are regularly audited for quality and safety.'],
            ] as $row
        ) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'about-us',
                    'section' => 'certified',
                    'key' => $row['key'],
                ],
                [
                    'value' => $row['value'],
                    'type' => null,
                ]
            );
        }

        $items = [
            [
                'icon' => '',
                'alt' => '',
                'title' => 'ISO 9001:2015',
                'description' => 'Our operations follow strict quality management standards, ensuring consistency, efficiency, and customer satisfaction at every stage.',
            ],
            [
                'icon' => '',
                'alt' => '',
                'title' => 'GDP Certification',
                'description' => 'We comply with Good Distribution Practices to guarantee the integrity and safety of products throughout the supply chain.',
            ],
            [
                'icon' => '',
                'alt' => '',
                'title' => 'Environmental Compliance',
                'description' => 'Commitment to sustainable logistics practices that meet international environmental and safety regulations.',
            ],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'cms_repeaters',
                'key' => 'certified_items',
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
            ->where('section', 'certified')
            ->delete();

        Content::query()
            ->where('page', 'about-us')
            ->where('section', 'cms_repeaters')
            ->where('key', 'certified_items')
            ->delete();
    }
};

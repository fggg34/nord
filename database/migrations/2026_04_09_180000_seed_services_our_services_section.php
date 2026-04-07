<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $defaultBody = <<<'HTML'
<p>We move goods across Europe and North America with precision. Whether it's full truckloads or smaller consignments, our multimodal solutions ensure on-time, secure deliveries.</p>
<p><strong>Multi-modal shipping:</strong> Road, rail, air, and ocean freight.</p>
<p><strong>Customs-ready:</strong> International documentation and clearance support.</p>
<p><strong>Route optimization:</strong> For efficiency, cost, and sustainability.</p>
HTML;

        $flat = [
            ['page' => 'services', 'section' => 'our_services', 'key' => 'tag', 'value' => 'KEY EXPERTISE', 'type' => null],
            ['page' => 'services', 'section' => 'our_services', 'key' => 'heading', 'value' => 'Core Capabilities', 'type' => null],
            ['page' => 'services', 'section' => 'our_services', 'key' => 'description', 'value' => 'Delivering tailored transport and logistics solutions to move your business forward.', 'type' => null],
            ['page' => 'services', 'section' => 'our_services', 'key' => 'cta_label', 'value' => 'Get in Touch', 'type' => null],
            ['page' => 'services', 'section' => 'our_services', 'key' => 'cta_url', 'value' => 'contact-us', 'type' => null],
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

        $items = [[
            'title' => 'National & International Freight',
            'image' => '',
            'image_alt' => 'View of containers in motion at a large logistics hub located in a port.',
            'body' => trim($defaultBody),
        ]];

        Content::query()->updateOrCreate(
            [
                'page' => 'services',
                'section' => 'cms_repeaters',
                'key' => 'core_capabilities',
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
            ->where('section', 'our_services')
            ->delete();

        Content::query()
            ->where('page', 'services')
            ->where('section', 'cms_repeaters')
            ->where('key', 'core_capabilities')
            ->delete();
    }
};

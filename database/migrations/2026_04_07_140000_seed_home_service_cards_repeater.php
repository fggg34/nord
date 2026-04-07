<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $items = [
            [
                'title' => 'National & International Freight',
                'image' => 'assets/images/10b2101792bd7e4e-iBliZ6U0n2mOK6nHB0zA61chf4.webp',
                'alt' => 'View of containers in motion at a large logistics hub located in a port.',
            ],
            [
                'title' => 'Regional Distribution',
                'image' => 'assets/images/726905a05768370c-Hr6t8ScCAwHOJkSXSmsF2S264A.jpg',
                'alt' => 'Stacked shipping containers.',
            ],
            [
                'title' => 'Warehousing & Fulfillment',
                'image' => 'assets/images/7cbd6e2a07f19067-XbiC6HqXQazD6tC0lwwd6VHSp8.webp',
                'alt' => 'Large logistics warehouse with a worker walking in the center, seen in profile.',
            ],
            [
                'title' => 'Refrigerated Transport',
                'image' => 'assets/images/ac9659f112d9bd86-ZBaUPtNu1XK33fXrjh3e6RFX9u0.webp',
                'alt' => 'Set of refrigerated trailers for transport.',
            ],
            [
                'title' => '3PL Subcontracting',
                'image' => 'assets/images/a03f37408efda518-7LCSOKNtTwk0qTCBifDWJdJE.webp',
                'alt' => 'Drone view of a transportation truck depot.',
            ],
        ];

        $row = Content::query()->firstOrCreate(
            [
                'page' => 'home',
                'section' => 'cms_repeaters',
                'key' => 'service_cards',
            ],
            [
                'value' => '[]',
                'type' => 'repeater',
            ]
        );

        $raw = trim((string) $row->value);
        if ($raw === '' || $raw === '[]') {
            $row->update([
                'value' => json_encode($items, JSON_UNESCAPED_UNICODE),
                'type' => 'repeater',
            ]);
        }
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'home')
            ->where('section', 'cms_repeaters')
            ->where('key', 'service_cards')
            ->update([
                'value' => '[]',
                'type' => 'repeater',
            ]);
    }
};

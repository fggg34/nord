<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $textRows = [
            ['key' => 'label', 'value' => 'Why Loginord', 'type' => 'text'],
            ['key' => 'title', 'value' => 'Why Leading Businesses Rely on Us', 'type' => 'text'],
            ['key' => 'description', 'value' => 'We combine smart operations with real-world reliability to move what matters — faster, safer, and smarter.', 'type' => 'textarea'],
            ['key' => 'button_text', 'value' => 'Know More About Us', 'type' => 'text'],
            ['key' => 'button_link', 'value' => '/about-us', 'type' => 'text'],
        ];

        foreach ($textRows as $row) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'home',
                    'section' => 'why_us',
                    'key' => $row['key'],
                ],
                [
                    'value' => $row['value'],
                    'type' => $row['type'],
                ]
            );
        }

        $cards = [
            [
                'title' => 'Multilingual support across Europe and the US',
                'icon' => 'assets/images/80388aeb276a2311-gaR0VwBnC0N4APFwe98Wh6FNzA.svg',
                'alt' => '',
            ],
            [
                'title' => 'Real-Time Shipment Visibility',
                'icon' => 'assets/images/7f1511527afde3b3-9evVzCTgnvOhSapzBMvHCFEFTqs.svg',
                'alt' => '',
            ],
            [
                'title' => 'Fast Delivery across 20+ Countries',
                'icon' => 'assets/images/47ca88889afac36a-54405mITjKzrnYbhvtkOGz9fM.svg',
                'alt' => '',
            ],
            [
                'title' => 'Certified and Compliant Fleet',
                'icon' => 'assets/images/b19f77a9d7bfe0b3-xfwVeEi5Q4ThoeqAvKoLkDEGjM.svg',
                'alt' => '',
            ],
        ];

        $rep = Content::query()->firstOrCreate(
            [
                'page' => 'home',
                'section' => 'cms_repeaters',
                'key' => 'why_us_cards',
            ],
            [
                'value' => '[]',
                'type' => 'repeater',
            ]
        );

        $raw = trim((string) $rep->value);
        if ($raw === '' || $raw === '[]') {
            $rep->update([
                'value' => json_encode($cards, JSON_UNESCAPED_UNICODE),
                'type' => 'repeater',
            ]);
        }
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'home')
            ->where('section', 'why_us')
            ->delete();

        Content::query()
            ->where('page', 'home')
            ->where('section', 'cms_repeaters')
            ->where('key', 'why_us_cards')
            ->update([
                'value' => '[]',
                'type' => 'repeater',
            ]);
    }
};

<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $textRows = [
            ['key' => 'title', 'value' => 'What Our Clients Say', 'type' => 'text'],
            ['key' => 'description', 'value' => 'Delivering best experience. We ensure safe and efficient delivery for our clients every step of the way.', 'type' => 'textarea'],
            ['key' => 'side_image', 'value' => 'assets/images/af338afc80410c34-DypsTNmxrRW7PqSF2Maw0oUSz4.webp', 'type' => 'text'],
        ];

        foreach ($textRows as $row) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'home',
                    'section' => 'clients_say',
                    'key' => $row['key'],
                ],
                [
                    'value' => $row['value'],
                    'type' => $row['type'],
                ]
            );
        }

        $reviews = [
            [
                'quote' => 'Loginord helped us streamline our entire distribution network in Western Europe. Always on time, always reliable.',
                'avatar' => 'assets/images/5eaa2b9d3cad9117-eA14AQZoraXhWBvjDmeNUInSEk.webp',
                'name' => 'Frank Anderson',
                'company' => 'European Food Co.',
                'alt' => '',
            ],
            [
                'quote' => 'Loginord became a true partner in our cold-chain operations across the US. Their real-time visibility tools make all the difference.',
                'avatar' => 'assets/images/842ff60c0f48147b-unWYDuYMRPUeJ16AX0mrzNKJ8.webp',
                'name' => 'Carla Jennings',
                'company' => 'FreshHarvest Foods',
                'alt' => '',
            ],
            [
                'quote' => 'What impressed us most was their flexibility during seasonal peaks. Loginord scaled up quickly without compromising quality.',
                'avatar' => 'assets/images/a66ebee36bae6c58-Ej8sUg9nHnlycpYyqFac2ga4.webp',
                'name' => 'Thierry Morel',
                'company' => 'AgriNova Americas',
                'alt' => '',
            ],
            [
                'quote' => 'From the first shipment, it was clear they understood the complexity of electronics transport. Everything has been smooth and secure.',
                'avatar' => 'assets/images/2e1e56344870055d-V4oFVZNGp88PU7IzhV9HJiodMws.webp',
                'name' => 'Derek Tanaka',
                'company' => 'Nextronix Components',
                'alt' => '',
            ],
        ];

        $rep = Content::query()->firstOrCreate(
            [
                'page' => 'home',
                'section' => 'cms_repeaters',
                'key' => 'clients_say_reviews',
            ],
            [
                'value' => '[]',
                'type' => 'repeater',
            ]
        );

        $raw = trim((string) $rep->value);
        if ($raw === '' || $raw === '[]') {
            $rep->update([
                'value' => json_encode($reviews, JSON_UNESCAPED_UNICODE),
                'type' => 'repeater',
            ]);
        }
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'home')
            ->where('section', 'clients_say')
            ->delete();

        Content::query()
            ->where('page', 'home')
            ->where('section', 'cms_repeaters')
            ->where('key', 'clients_say_reviews')
            ->update([
                'value' => '[]',
                'type' => 'repeater',
            ]);
    }
};

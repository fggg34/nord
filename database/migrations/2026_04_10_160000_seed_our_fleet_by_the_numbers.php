<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $flat = [
            ['page' => 'our-fleet', 'section' => 'by_the_numbers', 'key' => 'tag', 'value' => 'BY THE NUMBERS', 'type' => null],
            ['page' => 'our-fleet', 'section' => 'by_the_numbers', 'key' => 'heading', 'value' => 'A diverse fleet serving Europe & United States.', 'type' => null],
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
            ['title' => '4+', 'description' => 'Total Vehicles.'],
            ['title' => '40+', 'description' => 'Heavy-duty Semi-Trailers.'],
            ['title' => '+2', 'description' => 'Urban Delivery Vehicles.'],
            ['title' => '80%', 'description' => 'ADR & HACCP–Compliant Units.'],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'our-fleet',
                'section' => 'cms_repeaters',
                'key' => 'by_the_numbers_items',
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
            ->where('section', 'by_the_numbers')
            ->whereIn('key', ['tag', 'heading'])
            ->delete();

        Content::query()
            ->where('page', 'our-fleet')
            ->where('section', 'cms_repeaters')
            ->where('key', 'by_the_numbers_items')
            ->delete();
    }
};

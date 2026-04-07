<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $items = [
            [
                'title' => 'Food & Beverage',
                'image' => 'assets/images/0278e48e56dc2eb3-fTY3jHNvYEyooysxiifTM2xSTfg.jpg',
                'alt' => 'Apples in a factory conveyor belt.',
            ],
            [
                'title' => 'Pharmaceutical & Medical',
                'image' => 'assets/images/9f950d35fe6973d7-KPtRTAWZPh8dOr5hNCF5msdU4X4.jpg',
                'alt' => 'Shelves full of pharmaceutical products',
            ],
            [
                'title' => 'Industrial & Manufacturing',
                'image' => 'assets/images/6bdd99d4c8d93c80-5UpEscfduHJTgjeKasOjUYDYps.webp',
                'alt' => 'Beige and green Rubber Components',
            ],
            [
                'title' => 'Electronics & Technology',
                'image' => 'assets/images/4a4490bf5da043ca-Ky1iXcBJYmYHQm4voS6nnQEKrqI.jpg',
                'alt' => 'Electronic products (monitor, laptop, tablet, phone) on a table.',
            ],
            [
                'title' => 'Retail & E-Commerce',
                'image' => 'assets/images/0b6a4f81fd3b2460-1hNotqCvrefWQBNcp6xuTP3XLdk.jpg',
                'alt' => 'View inside a Shopping Center',
            ],
        ];

        $row = Content::query()->firstOrCreate(
            [
                'page' => 'home',
                'section' => 'cms_repeaters',
                'key' => 'industry_cards',
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
            ->where('key', 'industry_cards')
            ->update([
                'value' => '[]',
                'type' => 'repeater',
            ]);
    }
};

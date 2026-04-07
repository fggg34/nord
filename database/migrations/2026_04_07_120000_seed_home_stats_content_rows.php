<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            ['page' => 'home', 'section' => 'stats', 'key' => 'label', 'value' => 'QUICK FACTS', 'type' => 'text'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'heading', 'value' => 'Trusted by dozens of Companies across Industries.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'stat_1_value', 'value' => '962%', 'type' => 'text'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'stat_1_description', 'value' => 'On-Time Delivery Rate.', 'type' => 'text'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'stat_2_value', 'value' => '8/7', 'type' => 'text'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'stat_2_description', 'value' => 'GPS Tracking Coverage.', 'type' => 'text'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'stat_3_value', 'value' => '+2', 'type' => 'text'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'stat_3_description', 'value' => 'Countries covered daily.', 'type' => 'text'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'stat_4_value', 'value' => '+5K', 'type' => 'text'],
            ['page' => 'home', 'section' => 'stats', 'key' => 'stat_4_description', 'value' => 'Monthly Orders Fullfilled.', 'type' => 'text'],
        ];

        foreach ($defaults as $row) {
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
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'home')
            ->where('section', 'stats')
            ->whereIn('key', [
                'label', 'heading',
                'stat_1_value', 'stat_1_description',
                'stat_2_value', 'stat_2_description',
                'stat_3_value', 'stat_3_description',
                'stat_4_value', 'stat_4_description',
            ])
            ->delete();
    }
};

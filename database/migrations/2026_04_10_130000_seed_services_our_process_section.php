<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $flat = [
            ['page' => 'services', 'section' => 'our_process', 'key' => 'tag', 'value' => 'HOW IT WORKS', 'type' => null],
            ['page' => 'services', 'section' => 'our_process', 'key' => 'heading', 'value' => 'The Process', 'type' => null],
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
            ['number' => '01', 'title' => 'Discovery', 'description' => 'We assess your needs and KPIs.'],
            ['number' => '02', 'title' => 'Solution Design', 'description' => 'We build a custom logistics plan.'],
            ['number' => '03', 'title' => 'Onboarding', 'description' => 'You get connected to our systems.'],
            ['number' => '04', 'title' => 'Operations', 'description' => 'We deliver, track, and optimize.'],
            ['number' => '05', 'title' => 'Review', 'description' => 'We meet monthly to improve.'],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'services',
                'section' => 'cms_repeaters',
                'key' => 'process_steps',
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
            ->where('section', 'our_process')
            ->delete();

        Content::query()
            ->where('page', 'services')
            ->where('section', 'cms_repeaters')
            ->where('key', 'process_steps')
            ->delete();
    }
};

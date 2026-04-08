<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            [
                'key' => 'heading',
                'value' => 'Built for Critical Industries.',
                'type' => 'text',
            ],
            [
                'key' => 'intro',
                'value' => 'We support companies in Food, Pharma, Retail, and Manufacturing with Tailored Logistics.',
                'type' => 'textarea',
            ],
        ];

        foreach ($rows as $row) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'home',
                    'section' => 'critical_industries',
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
            ->where('section', 'critical_industries')
            ->delete();
    }
};

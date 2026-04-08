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
                'value' => 'Logistics that fit your needs.',
                'type' => 'text',
            ],
            [
                'key' => 'intro',
                'value' => "From temperature-controlled transport to regional distribution — we've got it covered.",
                'type' => 'textarea',
            ],
        ];

        foreach ($rows as $row) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'home',
                    'section' => 'services_industries',
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
            ->where('section', 'services_industries')
            ->delete();
    }
};

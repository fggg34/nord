<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $rows = [
            [
                'key' => 'button_text',
                'value' => 'View all services',
                'type' => 'text',
            ],
            [
                'key' => 'button_link',
                'value' => '/services',
                'type' => 'text',
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
            ->whereIn('key', ['button_text', 'button_link'])
            ->delete();
    }
};

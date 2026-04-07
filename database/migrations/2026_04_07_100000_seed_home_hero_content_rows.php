<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            ['page' => 'home', 'section' => 'hero', 'key' => 'subtitle_top', 'value' => 'Across Europe and the US.', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'description', 'value' => 'Reliable transport. Real-time tracking. Tailored logistics for your business.', 'type' => 'textarea'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'cta_primary_text', 'value' => 'Get a Quote', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'cta_primary_link', 'value' => 'contact-us', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'cta_secondary_text', 'value' => 'Know Our Services', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'cta_secondary_link', 'value' => 'services', 'type' => 'text'],
            ['page' => 'home', 'section' => 'hero', 'key' => 'hero_image', 'value' => '', 'type' => 'text'],
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
            ->where('section', 'hero')
            ->whereIn('key', [
                'subtitle_top',
                'description',
                'cta_primary_text',
                'cta_primary_link',
                'cta_secondary_text',
                'cta_secondary_link',
                'hero_image',
            ])
            ->delete();
    }
};

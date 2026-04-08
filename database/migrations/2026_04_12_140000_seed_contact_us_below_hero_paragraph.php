<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Content::query()->updateOrCreate(
            [
                'page' => 'contact-us',
                'section' => 'below_hero',
                'key' => 'paragraph',
            ],
            [
                'value' => 'Whether you\'re looking for a quote, have a specific question, or just want to explore how we can support your logistics needs — we\'re here to help.',
                'type' => null,
            ]
        );
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'contact-us')
            ->where('section', 'below_hero')
            ->where('key', 'paragraph')
            ->delete();
    }
};

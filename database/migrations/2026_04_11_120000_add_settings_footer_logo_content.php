<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

/**
 * Footer column logo image (settings.footer.footer_logo) — editable in Site settings.
 */
return new class extends Migration
{
    public function up(): void
    {
        Content::query()->updateOrCreate(
            [
                'page' => 'settings',
                'section' => 'footer',
                'key' => 'footer_logo',
            ],
            [
                'value' => '',
                'type' => null,
            ]
        );
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'settings')
            ->where('section', 'footer')
            ->where('key', 'footer_logo')
            ->delete();
    }
};

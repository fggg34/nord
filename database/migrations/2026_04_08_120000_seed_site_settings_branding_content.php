<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['logo', 'favicon'] as $key) {
            Content::query()->firstOrCreate(
                [
                    'page' => 'settings',
                    'section' => 'branding',
                    'key' => $key,
                ],
                [
                    'value' => '',
                    'type' => 'text',
                ]
            );
        }
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'settings')
            ->where('section', 'branding')
            ->whereIn('key', ['logo', 'favicon'])
            ->delete();
    }
};

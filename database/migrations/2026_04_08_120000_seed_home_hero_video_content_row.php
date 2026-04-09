<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Content::query()->updateOrCreate(
            [
                'page' => 'home',
                'section' => 'hero',
                'key' => 'hero_video',
            ],
            [
                'value' => '',
                'type' => 'text',
            ]
        );
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'home')
            ->where('section', 'hero')
            ->where('key', 'hero_video')
            ->delete();
    }
};

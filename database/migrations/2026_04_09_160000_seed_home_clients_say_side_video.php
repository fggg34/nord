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
                'section' => 'clients_say',
                'key' => 'side_video',
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
            ->where('section', 'clients_say')
            ->where('key', 'side_video')
            ->delete();
    }
};

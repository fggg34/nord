<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Content::query()->updateOrCreate(
            [
                'page' => 'privacy-policy',
                'section' => 'hero',
                'key' => 'description',
            ],
            [
                'value' => 'At Loginord, we are committed to protecting your privacy and ensuring that your personal data is handled responsibly and transparently. This Privacy Policy explains how we collect, use, and protect your information when you interact with our website or contact us directly.',
                'type' => null,
            ]
        );
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'privacy-policy')
            ->where('section', 'hero')
            ->where('key', 'description')
            ->delete();
    }
};

<?php

use App\Models\Content;
use App\Support\ContentRepository;
use Illuminate\Database\Migrations\Migration;

/**
 * Primary header navigation (settings.cms_repeaters.header_nav_items) — editable in Site settings.
 */
return new class extends Migration
{
    public function up(): void
    {
        $default = json_encode([
            ['label' => 'Home', 'link' => '/'],
            ['label' => 'About Us', 'link' => 'about-us'],
            ['label' => 'Services', 'link' => 'services'],
            ['label' => 'Fleet', 'link' => 'our-fleet'],
            ['label' => 'Contact Us', 'link' => 'contact-us'],
        ], JSON_UNESCAPED_UNICODE);

        Content::query()->updateOrCreate(
            [
                'page' => 'settings',
                'section' => 'cms_repeaters',
                'key' => 'header_nav_items',
            ],
            [
                'value' => $default,
                'type' => 'repeater',
            ]
        );

        ContentRepository::forgetPage('settings');
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'settings')
            ->where('section', 'cms_repeaters')
            ->where('key', 'header_nav_items')
            ->delete();

        ContentRepository::forgetPage('settings');
    }
};

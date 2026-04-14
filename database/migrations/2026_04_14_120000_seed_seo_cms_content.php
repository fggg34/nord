<?php

use App\Models\Content;
use App\Support\ContentRepository;
use Illuminate\Database\Migrations\Migration;

/**
 * Site-wide and per-page SEO fields (settings.seo.* and {page}.seo.*).
 */
return new class extends Migration
{
    public function up(): void
    {
        $settingsKeys = [
            'site_name' => '',
            'default_meta_description' => '',
            'default_og_image' => '',
            'twitter_card' => 'summary_large_image',
        ];

        foreach ($settingsKeys as $key => $value) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'settings',
                    'section' => 'seo',
                    'key' => $key,
                ],
                [
                    'value' => $value,
                    'type' => null,
                ]
            );
        }

        $pageKeys = ['meta_title', 'meta_description', 'og_image', 'robots'];
        $pages = ['home', 'about-us', 'contact-us', 'services', 'our-fleet', 'privacy-policy', 'error-404', 'search'];

        foreach ($pages as $page) {
            foreach ($pageKeys as $key) {
                Content::query()->updateOrCreate(
                    [
                        'page' => $page,
                        'section' => 'seo',
                        'key' => $key,
                    ],
                    [
                        'value' => '',
                        'type' => null,
                    ]
                );
            }
        }

        foreach (array_merge(['settings'], $pages) as $p) {
            ContentRepository::forgetPage($p);
        }
    }

    public function down(): void
    {
        Content::query()->where('section', 'seo')->delete();
        foreach (array_merge(['settings'], ['home', 'about-us', 'contact-us', 'services', 'our-fleet', 'privacy-policy', 'error-404', 'search']) as $p) {
            ContentRepository::forgetPage($p);
        }
    }
};

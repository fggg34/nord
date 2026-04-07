<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Seeder;

/**
 * Seeds one content row per Framer animated hero line (see x-framer.animated-title).
 */
class CmsHeroAnimatedTitlesSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['home', 'hero', 'title', 'Your Freight, delivered with Precision.'],
            ['about-us', 'hero', 'title', 'Driven by Purpose.'],
            ['about-us', 'hero', 'subtitle', 'Built on Trust.'],
            ['contact-us', 'hero', 'title', 'Tailored Logistics'],
            ['contact-us', 'hero', 'subtitle', 'For a Global World.'],
            ['services', 'hero', 'title', 'Tailored Logistics'],
            ['services', 'hero', 'subtitle', 'For a Global World.'],
            ['our-fleet', 'hero', 'title', 'Our Fleet in Motion.'],
            ['industries', 'hero', 'title', 'Tailored to your Industry.'],
            ['privacy-policy', 'hero', 'title', 'Privacy Policy'],
            ['error-404', 'hero', 'title', '404'],
        ];

        foreach ($rows as [$page, $section, $key, $value]) {
            Content::query()->updateOrCreate(
                [
                    'page' => $page,
                    'section' => $section,
                    'key' => $key,
                ],
                [
                    'value' => $value,
                    'type' => null,
                ]
            );
        }
    }
}

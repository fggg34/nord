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
            ['about-us', 'hero', 'tag', 'About Us'],
            ['about-us', 'hero', 'banner_image', ''],
            ['about-us', 'hero', 'banner_alt', 'About Loginord'],
            ['about-us', 'hero', 'intro_paragraph', 'From last-mile delivery to international freight, Loginord offers flexible and scalable logistics solutions designed for your operational success.'],
            ['contact-us', 'hero', 'title', 'Tailored Logistics'],
            ['contact-us', 'hero', 'tag', 'OUR SERVICES'],
            ['contact-us', 'hero', 'subtitle', 'For a Global World.'],
            ['contact-us', 'hero', 'banner_image', ''],
            ['contact-us', 'hero', 'banner_alt', ''],
            ['services', 'hero', 'title', 'Tailored Logistics'],
            ['services', 'hero', 'tag', 'OUR SERVICES'],
            ['services', 'hero', 'subtitle', 'For a Global World.'],
            ['services', 'hero', 'banner_image', ''],
            ['services', 'hero', 'banner_alt', 'Loginord truck at warehouse'],
            ['our-fleet', 'hero', 'title', 'Our Fleet in Motion.'],
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

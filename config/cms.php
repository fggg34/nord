<?php

/**
 * Admin CMS structure (does not change public content() resolution).
 *
 * @see \App\Http\Controllers\Admin\PageContentController
 */
return [

    'pages' => [
        ['slug' => 'home', 'label' => 'Home'],
        ['slug' => 'about-us', 'label' => 'About us'],
        ['slug' => 'contact-us', 'label' => 'Contact us'],
        ['slug' => 'services', 'label' => 'Services'],
        ['slug' => 'our-fleet', 'label' => 'Our fleet'],
        ['slug' => 'industries', 'label' => 'Industries'],
        ['slug' => 'privacy-policy', 'label' => 'Privacy policy'],
        ['slug' => 'error-404', 'label' => '404 page'],
        ['slug' => 'search', 'label' => 'Search'],
    ],

    /**
     * JSON repeaters (type=repeater on contents row). Not referenced by Framer blades until you wire them.
     * Stored as JSON array of objects; keys match "fields" below.
     */
    'repeaters' => [
        [
            'page' => 'home',
            'section' => 'cms_repeaters',
            'key' => 'service_highlights',
            'label' => 'Service highlights (repeater)',
            'description' => 'Optional structured list. Wire the frontend with content(\'home\', \'cms_repeaters\', \'service_highlights\') and json_decode when needed.',
            'fields' => [
                ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'placeholder' => 'Short headline'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'placeholder' => 'Supporting copy'],
            ],
        ],
        [
            'page' => 'home',
            'section' => 'cms_repeaters',
            'key' => 'clients_say_reviews',
            'label' => 'What Our Clients Say — review cards (2×2 grid)',
            'description' => 'Each row: quote, author photo, name, company. Shown in the testimonial grid next to the large side image.',
            'fields' => [
                ['key' => 'quote', 'label' => 'Quote', 'type' => 'textarea', 'placeholder' => 'Testimonial text'],
                ['key' => 'avatar', 'label' => 'Author photo', 'type' => 'image'],
                ['key' => 'name', 'label' => 'Author name', 'type' => 'text', 'placeholder' => 'e.g. Frank Anderson'],
                ['key' => 'company', 'label' => 'Company / title', 'type' => 'text', 'placeholder' => 'e.g. European Food Co.'],
                ['key' => 'alt', 'label' => 'Photo alt text', 'type' => 'text', 'placeholder' => 'Optional; defaults to author name'],
            ],
        ],
        [
            'page' => 'home',
            'section' => 'cms_repeaters',
            'key' => 'partner_logos',
            'label' => 'Clients & partners (logos)',
            'description' => 'Shown in the home “Clients & partners” strip. Upload SVG or PNG; add alt text for accessibility.',
            'fields' => [
                ['key' => 'logo', 'label' => 'Logo image', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Alt text', 'type' => 'text', 'placeholder' => 'Company or partner name'],
            ],
        ],
        [
            'page' => 'home',
            'section' => 'cms_repeaters',
            'key' => 'service_cards',
            'label' => 'Services section (#industries-scroll) — service cards',
            'description' => 'Cards under “Logistics that fit your needs.” Each row: title (h5), image, optional alt. Keeps Framer layout and scroll animations.',
            'fields' => [
                ['key' => 'title', 'label' => 'Card title', 'type' => 'text', 'placeholder' => 'e.g. National & International Freight'],
                ['key' => 'image', 'label' => 'Card image', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Image alt text', 'type' => 'text', 'placeholder' => 'Describe the photo'],
            ],
        ],
        [
            'page' => 'home',
            'section' => 'cms_repeaters',
            'key' => 'industry_cards',
            'label' => 'Industries section — industry cards',
            'description' => 'Dark cards in “Built for Critical Industries.” Each row: title (heading), image, optional alt. Section title and intro stay in the text fields above.',
            'fields' => [
                ['key' => 'title', 'label' => 'Card title', 'type' => 'text', 'placeholder' => 'e.g. Food & Beverage'],
                ['key' => 'image', 'label' => 'Card image', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Image alt text', 'type' => 'text', 'placeholder' => 'Describe the photo'],
            ],
        ],
        [
            'page' => 'home',
            'section' => 'cms_repeaters',
            'key' => 'why_us_cards',
            'label' => 'Why Us section — feature cards (2×2 grid)',
            'description' => 'Each row: illustration (PNG/SVG/WebP), card title, optional alt. Replaces the animated Framer compositions with a single image per card.',
            'fields' => [
                ['key' => 'title', 'label' => 'Card text', 'type' => 'text', 'placeholder' => 'e.g. Multilingual support across Europe and the US'],
                ['key' => 'icon', 'label' => 'Illustration / icon image', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Image alt text', 'type' => 'text', 'placeholder' => 'Short description for accessibility'],
            ],
        ],
    ],

    /**
     * Human labels in admin for specific content rows (page.section.key).
     * Used for Framer animated hero lines (one DB field per full sentence).
     */
    'field_labels' => [
        'home.hero.title' => 'Hero title (animated)',
        'home.hero.subtitle_top' => 'Hero line under title (animated)',
        'home.hero.description' => 'Hero description',
        'home.hero.cta_primary_text' => 'Primary button label (header)',
        'home.hero.cta_primary_link' => 'Primary button link (path or full URL, optional #anchor)',
        'home.hero.cta_secondary_text' => 'Secondary button label (hero)',
        'home.hero.cta_secondary_link' => 'Secondary button link (path or full URL)',
        'home.hero.hero_image' => 'Hero background image (replaces video)',
        'home.stats.label' => 'Quick facts tag (animated, e.g. QUICK FACTS)',
        'home.stats.heading' => 'Quick facts main heading',
        'home.stats.stat_1_value' => 'Stat 1 — big number',
        'home.stats.stat_1_description' => 'Stat 1 — description',
        'home.stats.stat_2_value' => 'Stat 2 — big number',
        'home.stats.stat_2_description' => 'Stat 2 — description',
        'home.stats.stat_3_value' => 'Stat 3 — big number',
        'home.stats.stat_3_description' => 'Stat 3 — description',
        'home.stats.stat_4_value' => 'Stat 4 — big number',
        'home.stats.stat_4_description' => 'Stat 4 — description',
        'about-us.hero.title' => 'Hero title (animated)',
        'about-us.hero.subtitle' => 'Hero subtitle (animated)',
        'contact-us.hero.title' => 'Hero title (animated)',
        'contact-us.hero.subtitle' => 'Hero subtitle (animated)',
        'services.hero.title' => 'Hero title (animated)',
        'services.hero.subtitle' => 'Hero subtitle (animated)',
        'our-fleet.hero.title' => 'Hero title (animated)',
        'industries.hero.title' => 'Hero title (animated)',
        'privacy-policy.hero.title' => 'Hero title (animated)',
        'error-404.hero.title' => '404 heading (animated)',
        'home.clients_say.title' => 'Section heading (What Our Clients Say)',
        'home.clients_say.description' => 'Intro paragraph (above the review grid)',
        'home.clients_say.side_image' => 'Large side image (replaces video)',
    ],

    /**
     * Optional nicer section titles in admin (section slug from DB).
     */
    'section_labels' => [
        'hero' => 'Hero (headline, copy, CTAs, image)',
        'stats' => 'Quick facts (#stats-section, below hero)',
        'why_us' => 'Why Us section (label, heading, copy, CTA)',
        'clients_say' => 'What Our Clients Say (heading, intro, side image)',
    ],

    /**
     * Force input widget for a specific content row (page.section.key => spec).
     */
    'field_overrides' => [
        'home.hero.hero_image' => [
            'type' => 'image',
        ],
        'home.why_us.description' => [
            'type' => 'textarea',
        ],
        'home.clients_say.description' => [
            'type' => 'textarea',
        ],
        'home.clients_say.side_image' => [
            'type' => 'image',
        ],
    ],

];

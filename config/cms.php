<?php

/**
 * Admin CMS structure (does not change public content() resolution).
 *
 * @see App\Http\Controllers\Admin\PageContentController
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
            'key' => 'testimonials',
            'label' => 'Testimonials (repeater)',
            'description' => 'Add or remove client quotes. Optional JSON storage for future templates.',
            'fields' => [
                ['key' => 'quote', 'label' => 'Quote', 'type' => 'textarea', 'placeholder' => 'Testimonial text'],
                ['key' => 'company', 'label' => 'Company', 'type' => 'text', 'placeholder' => 'Company name'],
            ],
        ],
    ],

    /**
     * Human labels in admin for specific content rows (page.section.key).
     * Used for Framer animated hero lines (one DB field per full sentence).
     */
    'field_labels' => [
        'home.hero.title' => 'Hero title (animated)',
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
    ],

    /**
     * Optional nicer section titles in admin (section slug from DB).
     */
    'section_labels' => [
        'hero' => 'Hero (animated headings)',
    ],

    /**
     * Force input widget for a specific content row (page.section.key => spec).
     */
    'field_overrides' => [
        // 'home.general.span_text' => [
        //     'type' => 'select',
        //     'options' => ['default' => 'Default', 'alt' => 'Alternate'],
        // ],
    ],

];

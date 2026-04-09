<?php

/**
 * Admin CMS structure (does not change public content() resolution).
 *
 * @see PageContentController
 */
return [

    'pages' => [
        ['slug' => 'home', 'label' => 'Home'],
        ['slug' => 'settings', 'label' => 'Site settings'],
        ['slug' => 'about-us', 'label' => 'About us'],
        ['slug' => 'contact-us', 'label' => 'Contact us'],
        ['slug' => 'services', 'label' => 'Services'],
        ['slug' => 'our-fleet', 'label' => 'Our fleet'],
        ['slug' => 'privacy-policy', 'label' => 'Privacy policy'],
        ['slug' => 'error-404', 'label' => '404 page'],
        ['slug' => 'search', 'label' => 'Search'],
    ],

    /**
     * Per-page: only these content sections appear in the admin editor.
     * Pages not listed here show every section that has DB rows.
     * An explicit empty array means no flat sections in admin (rebuild from scratch).
     */
    'admin_visible_sections' => [
        'settings' => ['branding', 'footer'],
        'about-us' => ['hero', 'our_history', 'mission_values', 'our_locations', 'team', 'certified'],
        'contact-us' => ['hero', 'below_hero'],
        'services' => ['hero', 'below_hero', 'our_services', 'features', 'our_process'],
        'our-fleet' => ['hero', 'by_the_numbers', 'features_section', 'fleet_categories'],
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
            'description' => 'Cards under the Services heading on the home page. Edit the heading and intro in the “Services (#industries-scroll)” fields above. Each row: title (h5), image, optional alt. Keeps Framer layout and scroll animations.',
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
            'description' => 'Dark industry cards on the home page. Edit the section heading and intro in “Critical industries (Industries block)” above. Each row: title (heading), image, optional alt.',
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
            'description' => 'Each row: illustration (PNG, JPEG, WebP, SVG, or animated GIF), card title, optional alt. Replaces the animated Framer compositions with a single image per card.',
            'fields' => [
                ['key' => 'title', 'label' => 'Card text', 'type' => 'text', 'placeholder' => 'e.g. Multilingual support across Europe and the US'],
                ['key' => 'icon', 'label' => 'Illustration / icon image', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Image alt text', 'type' => 'text', 'placeholder' => 'Short description for accessibility'],
            ],
        ],
        [
            'page' => 'about-us',
            'section' => 'cms_repeaters',
            'key' => 'history_timeline',
            'label' => 'Our History — timeline (years & content)',
            'description' => 'Each row: year label, headline, story, optional image. Order = timeline order. Scrolling the section updates the active year and the panel on the right.',
            'fields' => [
                ['key' => 'year', 'label' => 'Year', 'type' => 'text', 'placeholder' => 'e.g. 2010'],
                ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'placeholder' => 'e.g. One Truck. One Dream.'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'placeholder' => 'Paragraph for this milestone'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Image alt text', 'type' => 'text', 'placeholder' => 'Describe the photo'],
            ],
        ],
        [
            'page' => 'about-us',
            'section' => 'cms_repeaters',
            'key' => 'mission_values_items',
            'label' => 'Our Values (#stats-section) — rows (under timeline)',
            'description' => 'Right column: each row is an orange-arrow block with a title and description (e.g. Mission, Vision, Values). Order matches the public page.',
            'fields' => [
                ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'placeholder' => 'e.g. Mission'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'placeholder' => 'Supporting paragraph'],
            ],
        ],
        [
            'page' => 'about-us',
            'section' => 'cms_repeaters',
            'key' => 'team_members',
            'label' => 'Team section (#stats-section-1) — member cards',
            'description' => 'Each row: photo, name, job title, LinkedIn profile URL. Order matches the grid on the public About page.',
            'fields' => [
                ['key' => 'name', 'label' => 'Name', 'type' => 'text', 'placeholder' => 'e.g. Jane Doe'],
                ['key' => 'position', 'label' => 'Position', 'type' => 'text', 'placeholder' => 'e.g. Founder & CEO'],
                ['key' => 'linkedin_url', 'label' => 'LinkedIn URL', 'type' => 'text', 'placeholder' => 'https://www.linkedin.com/in/…'],
                ['key' => 'image', 'label' => 'Photo', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Photo alt text', 'type' => 'text', 'placeholder' => 'Optional; defaults to name'],
            ],
        ],
        [
            'page' => 'about-us',
            'section' => 'cms_repeaters',
            'key' => 'certified_items',
            'label' => 'Certified section (#certified) — standard rows',
            'description' => 'Each row: icon (SVG/PNG), title, description. Order matches the list on the public About page.',
            'fields' => [
                ['key' => 'icon', 'label' => 'Icon', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Icon alt text', 'type' => 'text', 'placeholder' => 'Optional; defaults to title'],
                ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'placeholder' => 'e.g. ISO 9001:2015'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'placeholder' => 'Supporting paragraph'],
            ],
        ],
        [
            'page' => 'services',
            'section' => 'cms_repeaters',
            'key' => 'core_capabilities',
            'label' => 'Our Services (#our-services) — capability cards',
            'description' => 'Right column cards: index, title, image, and rich description (bold, lists, links). Left column copy is in the “Our Services section” fields above.',
            'fields' => [
                ['key' => 'title', 'label' => 'Card title', 'type' => 'text', 'placeholder' => 'e.g. National & International Freight'],
                ['key' => 'image', 'label' => 'Card image', 'type' => 'image'],
                ['key' => 'image_alt', 'label' => 'Image alt text', 'type' => 'text', 'placeholder' => 'Describe the photo'],
                ['key' => 'body', 'label' => 'Description (rich text)', 'type' => 'html', 'placeholder' => ''],
            ],
        ],
        [
            'page' => 'services',
            'section' => 'cms_repeaters',
            'key' => 'features_items',
            'label' => 'Features section (#features) — rows',
            'description' => 'Right column: icon (SVG/PNG), title, and short description per row. Left column and background image are in the “Features section” fields above.',
            'fields' => [
                ['key' => 'icon', 'label' => 'Icon', 'type' => 'image'],
                ['key' => 'alt', 'label' => 'Icon alt text', 'type' => 'text', 'placeholder' => 'Optional; defaults to title'],
                ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'placeholder' => 'e.g. Certified Reliability'],
                ['key' => 'description', 'label' => 'Short description', 'type' => 'textarea', 'placeholder' => 'One or two lines'],
            ],
        ],
        [
            'page' => 'services',
            'section' => 'cms_repeaters',
            'key' => 'process_steps',
            'label' => 'Our Process section (#process) — timeline steps',
            'description' => 'Ordered steps: odd rows (1st, 3rd, …) render on the right of the dashed line; even rows on the left. Each row: step number (e.g. 01), title, description.',
            'fields' => [
                ['key' => 'number', 'label' => 'Step number', 'type' => 'text', 'placeholder' => 'e.g. 01'],
                ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'placeholder' => 'e.g. Discovery'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'placeholder' => 'Short paragraph'],
            ],
        ],
        [
            'page' => 'our-fleet',
            'section' => 'cms_repeaters',
            'key' => 'by_the_numbers_items',
            'label' => 'By the numbers (#stats-section) — stat columns',
            'description' => 'Each row: large figure/title (center) and description below. Order left-to-right matches the public grid. Tag and subheading are edited in the “By the numbers” section above.',
            'fields' => [
                ['key' => 'title', 'label' => 'Stat value / headline', 'type' => 'text', 'placeholder' => 'e.g. 500+'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'placeholder' => 'Short line under the stat'],
            ],
        ],
        [
            'page' => 'our-fleet',
            'section' => 'cms_repeaters',
            'key' => 'fleet_category_cards',
            'label' => 'Fleet section — category cards (accordion)',
            'description' => 'Right column in the Fleet section: each row is one card (index number, title, image, rich HTML body). Order matches the stack on the public Our fleet page.',
            'fields' => [
                ['key' => 'number', 'label' => 'Index (optional)', 'type' => 'text', 'placeholder' => 'e.g. 01 — leave empty for auto 01, 02, …'],
                ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'placeholder' => 'e.g. Heavy-duty Semi-Trailers'],
                ['key' => 'image', 'label' => 'Image', 'type' => 'image'],
                ['key' => 'image_alt', 'label' => 'Image alt text', 'type' => 'text', 'placeholder' => 'Describe the photo'],
                ['key' => 'body', 'label' => 'Description (rich text)', 'type' => 'html', 'placeholder' => ''],
            ],
        ],
        [
            'page' => 'our-fleet',
            'section' => 'cms_repeaters',
            'key' => 'fleet_features_cards',
            'label' => 'Features section (#features) — telematics cards',
            'description' => '2×2 grid under “Connected Fleet, Connected You.” Each row: image, title, short description. Section heading and intro are in “Features section (#features)” above.',
            'fields' => [
                ['key' => 'image', 'label' => 'Card image', 'type' => 'image'],
                ['key' => 'title', 'label' => 'Title', 'type' => 'text', 'placeholder' => 'e.g. Live GPS Tracking'],
                ['key' => 'description', 'label' => 'Description', 'type' => 'textarea', 'placeholder' => 'One line under the title'],
                ['key' => 'alt', 'label' => 'Image alt text', 'type' => 'text', 'placeholder' => 'Optional; defaults to title'],
            ],
        ],
        [
            'page' => 'contact-us',
            'section' => 'cms_repeaters',
            'key' => 'key_contacts',
            'label' => 'Key Contacts — people (name, department, email, phone)',
            'description' => 'Rows appear as columns in the white card under “Key Contacts.” Section title is edited in Contact us → title → h5_key_contacts.',
            'fields' => [
                ['key' => 'name', 'label' => 'Name', 'type' => 'text', 'placeholder' => 'e.g. Michael Reyes'],
                ['key' => 'department', 'label' => 'Department / role', 'type' => 'text', 'placeholder' => 'e.g. US Business Development'],
                ['key' => 'email', 'label' => 'Email', 'type' => 'text', 'placeholder' => 'name@example.com'],
                ['key' => 'phone', 'label' => 'Phone', 'type' => 'text', 'placeholder' => 'e.g. +1 (832) 555-0192'],
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
        'about-us.hero.tag' => 'Hero tag (e.g. About Us)',
        'about-us.hero.banner_image' => 'Hero banner image (replaces video)',
        'about-us.hero.banner_alt' => 'Hero banner image alt text',
        'about-us.hero.intro_paragraph' => 'Intro paragraph (white strip below hero banner)',
        'about-us.our_history.heading' => 'Our History — section heading',
        'about-us.mission_values.tag' => 'Our Values — small tag (e.g. OUR MISSION, VISION & VALUES)',
        'about-us.mission_values.heading' => 'Our Values — main heading (e.g. What Drives Us.)',
        'about-us.our_locations.tag' => 'Our Locations — small tag (e.g. GLOBAL REACH. LOCAL STRENGTH.)',
        'about-us.our_locations.heading' => 'Our Locations — main heading',
        'about-us.our_locations.subheading' => 'Our Locations — line under title',
        'about-us.our_locations.card_title' => 'Location card — place name',
        'about-us.our_locations.card_subtitle' => 'Location card — subtitle (e.g. HQ & warehouse)',
        'about-us.our_locations.card_body' => 'Location card — description paragraph',
        'about-us.our_locations.card_image' => 'Location card — thumbnail image',
        'about-us.our_locations.card_image_alt' => 'Location card image — alt text',
        'about-us.our_locations.background_image' => 'Our Locations — full-width background (blurred layer)',
        'about-us.our_locations.background_alt' => 'Background image — alt text',
        'about-us.team.tag' => 'Team — small tag (e.g. THE TEAM)',
        'about-us.team.heading' => 'Team — main heading',
        'about-us.team.intro' => 'Team — intro paragraph (left column)',
        'about-us.certified.tag' => 'Certified — small tag (e.g. INDUSTRY STANDARDS)',
        'about-us.certified.heading' => 'Certified — main heading',
        'about-us.certified.intro' => 'Certified — intro paragraph (left column)',
        'contact-us.hero.title' => 'Hero — top heading (animated, split media)',
        'contact-us.hero.tag' => 'Hero — badge next to heading (e.g. OUR SERVICES)',
        'contact-us.hero.subtitle' => 'Hero — bottom heading (animated)',
        'contact-us.hero.split_image_1' => 'Hero — left split image',
        'contact-us.hero.split_image_1_alt' => 'Hero — left image alt text',
        'contact-us.hero.split_image_2' => 'Hero — right split image',
        'contact-us.hero.split_image_2_alt' => 'Hero — right image alt text',
        'contact-us.below_hero.paragraph' => 'Below hero (Desktop strip) — intro paragraph under split media',
        'services.hero.title' => 'Hero — top heading (animated)',
        'services.hero.tag' => 'Hero — small label (e.g. OUR SERVICES)',
        'services.hero.subtitle' => 'Hero — bottom heading (animated)',
        'services.hero.banner_image' => 'Hero — main image',
        'services.hero.banner_alt' => 'Hero image — alt text',
        'services.below_hero.paragraph' => 'Below hero (Desktop) — intro paragraph',
        'services.our_services.tag' => 'Our Services section — small label (e.g. KEY EXPERTISE)',
        'services.our_services.heading' => 'Our Services section — main heading',
        'services.our_services.description' => 'Our Services section — intro paragraph',
        'services.our_services.cta_label' => 'Our Services section — CTA button label',
        'services.our_services.cta_url' => 'Our Services section — CTA link (path e.g. contact-us, or full URL)',
        'services.features.tag' => 'Features section (#features) — small label (e.g. FUELING EVERY MOVE)',
        'services.features.heading' => 'Features section — main heading',
        'services.features.background_image' => 'Features section — background photo (truck)',
        'services.features.background_alt' => 'Features background — alt text',
        'our-fleet.hero.tag' => 'Hero — small label (e.g. INTRODUCING)',
        'our-fleet.hero.title' => 'Hero — main heading (animated)',
        'our-fleet.hero.banner_image' => 'Hero — main image',
        'our-fleet.hero.banner_alt' => 'Hero image — alt text',
        'our-fleet.hero.description' => 'Hero — intro paragraph (below heading)',
        'our-fleet.by_the_numbers.tag' => 'By the numbers — small label (e.g. BY THE NUMBERS)',
        'our-fleet.by_the_numbers.heading' => 'By the numbers — main line under tag',
        'our-fleet.fleet_categories.tag' => 'Fleet section — small label (e.g. VEHICLE CATEGORIES)',
        'our-fleet.fleet_categories.heading' => 'Fleet section — main heading',
        'our-fleet.fleet_categories.intro_1' => 'Fleet section — first intro paragraph',
        'our-fleet.fleet_categories.intro_2' => 'Fleet section — second intro paragraph',
        'our-fleet.fleet_categories.cta_label' => 'Fleet section — CTA button label',
        'our-fleet.fleet_categories.cta_url' => 'Fleet section — CTA link (path e.g. contact-us, or full URL)',
        'our-fleet.features_section.heading' => 'Features (#features) — main heading',
        'our-fleet.features_section.description' => 'Features (#features) — intro paragraph under the heading',
        'privacy-policy.hero.title' => 'Hero title (animated)',
        'error-404.hero.title' => '404 heading (animated)',
        'home.services_industries.heading' => 'Services (#industries-scroll) — main heading (e.g. Logistics that fit your needs.)',
        'home.services_industries.intro' => 'Services (#industries-scroll) — intro paragraph under the heading',
        'home.critical_industries.heading' => 'Industries block — main heading (e.g. Built for Critical Industries.)',
        'home.critical_industries.intro' => 'Industries block — intro paragraph under the heading (left column)',
        'home.clients_say.title' => 'Section heading (What Our Clients Say)',
        'home.clients_say.description' => 'Intro paragraph (above the review grid)',
        'home.clients_say.side_image' => 'Large side image (shown when no side video is set)',
        'home.clients_say.side_video' => 'Side video (optional — if uploaded, replaces the side image)',
        'settings.branding.logo' => 'Site logo (header; PNG, SVG, or WebP recommended)',
        'settings.branding.favicon' => 'Favicon (ICO, PNG, or SVG; shown in browser tab)',
        'settings.footer.ticker_line_1' => 'Footer ticker — first line (above “smarter?”)',
        'settings.footer.ticker_line_2' => 'Footer ticker — second line (e.g. “ve smarter?”)',
        'settings.footer.cta_get_quote' => 'Footer ticker — CTA button label (e.g. Get a Custom Quote)',
        'settings.footer.newsletter_intro' => 'Newsletter — intro text under logo column',
        'settings.footer.newsletter_placeholder' => 'Newsletter — email field placeholder',
        'settings.footer.subscribe_label' => 'Newsletter — Subscribe button label',
        'settings.footer.connect_heading' => 'Social — “Connect” heading',
        'settings.footer.social_linkedin_label' => 'Social — LinkedIn link label',
        'settings.footer.social_instagram_label' => 'Social — Instagram link label',
        'settings.footer.social_facebook_label' => 'Social — Facebook link label',
        'settings.footer.social_linkedin_url' => 'Social — LinkedIn URL (full https or path)',
        'settings.footer.social_instagram_url' => 'Social — Instagram URL',
        'settings.footer.social_facebook_url' => 'Social — Facebook URL',
        'settings.footer.contacts_heading' => 'Contacts column — heading',
        'settings.footer.contact_email_1' => 'Contacts — first email (display & mailto)',
        'settings.footer.contact_email_2' => 'Contacts — second email (display & mailto)',
        'settings.footer.phone_1' => 'Contacts — first phone (display; spaces OK for tel: link)',
        'settings.footer.phone_2' => 'Contacts — second phone',
        'settings.footer.column_services_heading' => 'Services column — heading',
        'settings.footer.services_nav_link_path' => 'Services column — first link path (e.g. services or full URL)',
        'settings.footer.services_nav_services_label' => 'Services column — first link label',
        'settings.footer.services_nav_fleet_label' => 'Services column — Our Fleet label',
        'settings.footer.services_nav_third_label' => 'Services column — third link label',
        'settings.footer.column_company_heading' => 'Company column — heading',
        'settings.footer.company_nav_about_label' => 'Company column — About Us label',
        'settings.footer.company_nav_contact_label' => 'Company column — Contact Us label',
        'settings.footer.copyright_prefix' => 'Copyright bar — text before credit link (e.g. © Copyright 2025 - Made by )',
        'settings.footer.credit_name' => 'Copyright bar — credit link text (e.g. JBStudio)',
        'settings.footer.credit_url' => 'Copyright bar — credit link URL',
        'settings.footer.legal_get_template_label' => 'Bottom bar — Get Template link label',
        'settings.footer.legal_get_template_url' => 'Bottom bar — Get Template URL',
        'settings.footer.legal_privacy_label' => 'Bottom bar — Privacy Policy link label',
    ],

    /**
     * Optional nicer section titles in admin (section slug from DB).
     */
    'section_labels' => [
        'branding' => 'Branding (site-wide logo & favicon)',
        'footer' => 'Footer (site-wide — newsletter, contacts, columns, links)',
        'hero' => 'Hero (headline, copy, CTAs, image)',
        'below_hero' => 'Below hero (white strip — intro paragraph)',
        'our_services' => 'Our Services (#our-services — left column copy; cards are in repeater below)',
        'features' => 'Features (#features — tag, heading, background; rows are in repeater below)',
        'our_process' => 'Our Process (#process — tag & heading; timeline steps are in repeater below)',
        'stats' => 'Quick facts (#stats-section, below hero)',
        'services_industries' => 'Services (#industries-scroll — heading & intro; service cards in repeater below)',
        'critical_industries' => 'Critical industries (Industries block — heading & intro; industry cards in repeater below)',
        'why_us' => 'Why Us section (label, heading, copy, CTA)',
        'clients_say' => 'What Our Clients Say (heading, intro, side image)',
        'our_history' => 'Our History (#our-history heading only; timeline is in repeaters below)',
        'mission_values' => 'Our Values (#stats-section — tag & heading left; rows in repeater below)',
        'our_locations' => 'Our Locations (map section — copy, card image, background)',
        'team' => 'Team (#stats-section-1 — tag, heading, intro; cards in repeater below)',
        'certified' => 'Certified (#certified — tag, heading, intro; rows in repeater below)',
        'by_the_numbers' => 'By the numbers (#stats-section — tag & heading; stat columns in repeater below)',
        'fleet_categories' => 'Fleet section (two columns — intro & CTA left; accordion cards in repeater below)',
        'features_section' => 'Features (#features — peach block; telematics cards in repeater below)',
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
        'home.services_industries.intro' => [
            'type' => 'textarea',
        ],
        'home.critical_industries.intro' => [
            'type' => 'textarea',
        ],
        'home.clients_say.side_image' => [
            'type' => 'image',
        ],
        'home.clients_say.side_video' => [
            'type' => 'video',
        ],
        'about-us.hero.banner_image' => [
            'type' => 'image',
        ],
        'about-us.hero.intro_paragraph' => [
            'type' => 'textarea',
        ],
        'about-us.our_history.heading' => [
            'type' => 'text',
        ],
        'about-us.mission_values.tag' => [
            'type' => 'text',
        ],
        'about-us.mission_values.heading' => [
            'type' => 'text',
        ],
        'about-us.our_locations.card_body' => [
            'type' => 'textarea',
        ],
        'about-us.our_locations.card_image' => [
            'type' => 'image',
        ],
        'about-us.our_locations.background_image' => [
            'type' => 'image',
        ],
        'about-us.team.intro' => [
            'type' => 'textarea',
        ],
        'about-us.certified.intro' => [
            'type' => 'textarea',
        ],
        'settings.branding.logo' => [
            'type' => 'image',
        ],
        'settings.branding.favicon' => [
            'type' => 'image',
        ],
        'settings.footer.newsletter_intro' => [
            'type' => 'textarea',
        ],
        'settings.footer.copyright_prefix' => [
            'type' => 'textarea',
        ],
        'services.hero.banner_image' => [
            'type' => 'image',
        ],
        'services.below_hero.paragraph' => [
            'type' => 'textarea',
        ],
        'services.our_services.description' => [
            'type' => 'textarea',
        ],
        'services.our_services.cta_url' => [
            'type' => 'text',
        ],
        'services.features.background_image' => [
            'type' => 'image',
        ],
        'services.features.background_alt' => [
            'type' => 'text',
        ],
        'our-fleet.hero.banner_image' => [
            'type' => 'image',
        ],
        'contact-us.hero.split_image_1' => [
            'type' => 'image',
        ],
        'contact-us.hero.split_image_2' => [
            'type' => 'image',
        ],
        'contact-us.below_hero.paragraph' => [
            'type' => 'textarea',
        ],
        'our-fleet.hero.description' => [
            'type' => 'textarea',
        ],
        'our-fleet.hero.banner_alt' => [
            'type' => 'text',
        ],
        'our-fleet.by_the_numbers.heading' => [
            'type' => 'textarea',
        ],
        'our-fleet.fleet_categories.intro_1' => [
            'type' => 'textarea',
        ],
        'our-fleet.fleet_categories.intro_2' => [
            'type' => 'textarea',
        ],
        'our-fleet.fleet_categories.cta_url' => [
            'type' => 'text',
        ],
        'our-fleet.features_section.description' => [
            'type' => 'textarea',
        ],
    ],

];

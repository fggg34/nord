<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

/**
 * Site-wide footer copy (Framer footer — settings.footer.*).
 */
return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            'ticker_line_1' => 'Ready to m',
            'ticker_line_2' => 've smarter?',
            'cta_get_quote' => 'Get a Custom Quote',
            'newsletter_intro' => 'Keep on track by subscribing our Newsletter.',
            'newsletter_placeholder' => 'example@email.com',
            'subscribe_label' => 'Subscribe',
            'connect_heading' => 'Connect',
            'social_linkedin_label' => 'LinkedIn',
            'social_instagram_label' => 'Instagram',
            'social_facebook_label' => 'Facebook',
            'social_linkedin_url' => 'https://www.linkedin.com/',
            'social_instagram_url' => 'https://instagram.com/',
            'social_facebook_url' => 'https://facebook.com/',
            'contacts_heading' => 'Contacts',
            'contact_email_1' => 'info@loginord.com',
            'contact_email_2' => 'houston@loginord.com',
            'phone_1' => '+31 23 732 600',
            'phone_2' => '+1 713 5976172',
            'column_services_heading' => 'Services',
            'services_nav_link_path' => 'services',
            'services_nav_services_label' => 'Services',
            'services_nav_fleet_label' => 'Our Fleet',
            'services_nav_third_label' => 'Industries',
            'column_company_heading' => 'Company',
            'company_nav_about_label' => 'About Us',
            'company_nav_contact_label' => 'Contact Us',
            'copyright_prefix' => '© Copyright 2025 - Made by ',
            'credit_name' => 'JBStudio',
            'credit_url' => 'https://uibarbosa.com/',
            'legal_get_template_label' => 'Get Template',
            'legal_get_template_url' => 'https://uibarbosa.lemonsqueezy.com/buy/aab3fbfd-c5bd-4bfc-a2e1-45ffdf4b331a',
            'legal_privacy_label' => 'Privacy Policy',
        ];

        foreach ($defaults as $key => $value) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'settings',
                    'section' => 'footer',
                    'key' => $key,
                ],
                [
                    'value' => $value,
                    'type' => null,
                ]
            );
        }
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'settings')
            ->where('section', 'footer')
            ->delete();
    }
};

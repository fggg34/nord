<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        foreach (
            [
                ['key' => 'tag', 'value' => 'THE TEAM'],
                ['key' => 'heading', 'value' => 'People You Can Rely On.'],
                ['key' => 'intro', 'value' => 'Our strength lies in our people — from dispatch operators to cross-border drivers. Meet the management team behind every successful delivery.'],
            ] as $row
        ) {
            Content::query()->updateOrCreate(
                [
                    'page' => 'about-us',
                    'section' => 'team',
                    'key' => $row['key'],
                ],
                [
                    'value' => $row['value'],
                    'type' => null,
                ]
            );
        }

        $members = [
            [
                'name' => 'Anders Smithsson',
                'position' => 'Founder & CEO',
                'linkedin_url' => 'https://www.linkedin.com/in/joaoduartebarbosa/',
                'image' => '',
                'alt' => '',
            ],
            [
                'name' => 'Sophie Van Dijk',
                'position' => 'Commercial Director',
                'linkedin_url' => 'https://www.linkedin.com/in/joaoduartebarbosa/',
                'image' => '',
                'alt' => '',
            ],
            [
                'name' => 'Michael Reyes',
                'position' => 'Head of Operations',
                'linkedin_url' => 'https://www.linkedin.com/in/joaoduartebarbosa/',
                'image' => '',
                'alt' => '',
            ],
            [
                'name' => 'Claire Fontaine',
                'position' => 'Quality & Compliance Lead',
                'linkedin_url' => 'https://www.linkedin.com/in/joaoduartebarbosa/',
                'image' => '',
                'alt' => '',
            ],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'cms_repeaters',
                'key' => 'team_members',
            ],
            [
                'value' => json_encode($members, JSON_UNESCAPED_UNICODE),
                'type' => 'repeater',
            ]
        );
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'about-us')
            ->where('section', 'team')
            ->delete();

        Content::query()
            ->where('page', 'about-us')
            ->where('section', 'cms_repeaters')
            ->where('key', 'team_members')
            ->delete();
    }
};

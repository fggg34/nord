<?php

use App\Models\Content;
use App\Support\ContentRepository;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'our_history',
                'key' => 'heading',
            ],
            [
                'value' => 'Our History',
                'type' => null,
            ]
        );

        $items = [
            [
                'year' => '2010',
                'title' => 'One Truck. One Dream.',
                'description' => 'LogiNord was founded in a small Rotterdam warehouse with just one vehicle and a clear mission: to offer reliable transport for local businesses with the kind of service larger firms couldn’t match.',
                'image' => '',
                'alt' => 'Truck parked in front of warehouse',
            ],
            [
                'year' => '2013',
                'title' => 'Cross-border growth.',
                'description' => 'We expanded scheduled lanes into neighboring markets, added dedicated account managers, and invested in tracking so customers could see every shipment in real time.',
                'image' => '',
                'alt' => '',
            ],
            [
                'year' => '2017',
                'title' => 'Scale with standards.',
                'description' => 'ISO-aligned processes, temperature-capable equipment, and a larger partner network helped us serve food, retail, and industrial clients without losing the personal touch.',
                'image' => '',
                'alt' => '',
            ],
            [
                'year' => '2021',
                'title' => 'US hub, one team.',
                'description' => 'A Houston office brought US coverage under the same operations playbook as Europe—single point of contact, shared compliance rigor, and 24/7 coordination.',
                'image' => '',
                'alt' => '',
            ],
            [
                'year' => '2025',
                'title' => 'Next-mile innovation.',
                'description' => 'Today we combine experienced planners with modern tooling: smarter routing, emissions-aware options, and the flexibility to plug into your ERP or TMS.',
                'image' => '',
                'alt' => '',
            ],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'cms_repeaters',
                'key' => 'history_timeline',
            ],
            [
                'value' => json_encode($items, JSON_UNESCAPED_UNICODE),
                'type' => 'repeater',
            ]
        );

        ContentRepository::forgetPage('about-us');
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'about-us')
            ->where(function ($q): void {
                $q->where(function ($q2): void {
                    $q2->where('section', 'our_history')->where('key', 'heading');
                })->orWhere(function ($q2): void {
                    $q2->where('section', 'cms_repeaters')->where('key', 'history_timeline');
                });
            })
            ->delete();

        ContentRepository::forgetPage('about-us');
    }
};

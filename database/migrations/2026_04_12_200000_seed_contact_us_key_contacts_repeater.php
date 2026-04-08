<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $items = [
            [
                'name' => 'Michael Reyes',
                'department' => 'US Business Development',
                'email' => 'michael@logi-nord.com',
                'phone' => '+1 (832) 555‑0192',
            ],
            [
                'name' => 'Customer Support',
                'department' => 'Global Customer Support',
                'email' => 'support@logi-nord.com',
                'phone' => '+1 (832) 555‑0192',
            ],
            [
                'name' => 'Sophie Van Dijk',
                'department' => 'Commercial Director',
                'email' => 'sophie@logi-nord.com',
                'phone' => '+1 (832) 555‑0191',
            ],
        ];

        Content::query()->updateOrCreate(
            [
                'page' => 'contact-us',
                'section' => 'cms_repeaters',
                'key' => 'key_contacts',
            ],
            [
                'value' => json_encode($items, JSON_UNESCAPED_UNICODE),
                'type' => 'repeater',
            ]
        );
    }

    public function down(): void
    {
        Content::query()
            ->where('page', 'contact-us')
            ->where('section', 'cms_repeaters')
            ->where('key', 'key_contacts')
            ->delete();
    }
};

<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private const LEGACY_KEY = 'p_from_last_mile_delivery_to_international_freight_loginord_offers_flexible_and_scalable_logistics_sol';

    private const DEFAULT_PARAGRAPH = 'From last-mile delivery to international freight, Loginord offers flexible and scalable logistics solutions designed for your operational success.';

    public function up(): void
    {
        $legacy = Content::query()
            ->where('page', 'services')
            ->where('section', 'text')
            ->where('key', self::LEGACY_KEY)
            ->first();

        $value = (string) ($legacy?->value ?? '');
        if ($value === '') {
            $value = self::DEFAULT_PARAGRAPH;
        }

        Content::query()->updateOrCreate(
            [
                'page' => 'services',
                'section' => 'below_hero',
                'key' => 'paragraph',
            ],
            [
                'value' => $value,
                'type' => null,
            ]
        );

        Content::query()
            ->where('page', 'services')
            ->where('section', 'text')
            ->where('key', self::LEGACY_KEY)
            ->delete();
    }

    public function down(): void
    {
        $current = Content::query()
            ->where('page', 'services')
            ->where('section', 'below_hero')
            ->where('key', 'paragraph')
            ->first();

        $value = (string) ($current?->value ?? self::DEFAULT_PARAGRAPH);

        Content::query()
            ->where('page', 'services')
            ->where('section', 'below_hero')
            ->where('key', 'paragraph')
            ->delete();

        Content::query()->updateOrCreate(
            [
                'page' => 'services',
                'section' => 'text',
                'key' => self::LEGACY_KEY,
            ],
            [
                'value' => $value,
                'type' => null,
            ]
        );
    }
};

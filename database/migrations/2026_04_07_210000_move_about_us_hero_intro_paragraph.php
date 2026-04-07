<?php

use App\Models\Content;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private const OLD_KEY = 'p_from_last_mile_delivery_to_international_freight_loginord_offers_flexible_and_scalable_logistics_sol';

    public function up(): void
    {
        $default = 'From last-mile delivery to international freight, Loginord offers flexible and scalable logistics solutions designed for your operational success.';

        $old = Content::query()
            ->where('page', 'about-us')
            ->where('section', 'text')
            ->where('key', self::OLD_KEY)
            ->first();

        $value = ($old !== null && trim((string) $old->value) !== '') ? $old->value : $default;

        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'hero',
                'key' => 'intro_paragraph',
            ],
            [
                'value' => $value,
                'type' => null,
            ]
        );

        if ($old !== null) {
            $old->delete();
        }
    }

    public function down(): void
    {
        $new = Content::query()
            ->where('page', 'about-us')
            ->where('section', 'hero')
            ->where('key', 'intro_paragraph')
            ->first();

        if ($new === null) {
            return;
        }

        Content::query()->updateOrCreate(
            [
                'page' => 'about-us',
                'section' => 'text',
                'key' => self::OLD_KEY,
            ],
            [
                'value' => $new->value,
                'type' => $new->type,
            ]
        );

        $new->delete();
    }
};

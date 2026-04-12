<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Contact hero: one media field (banner_image / banner_alt) instead of split_image_1 / split_image_2.
 */
return new class extends Migration
{
    public function up(): void
    {
        $table = 'contents';

        DB::table($table)
            ->where('page', 'contact-us')
            ->where('section', 'hero')
            ->whereIn('key', ['split_image_2', 'split_image_2_alt'])
            ->delete();

        $rename = [
            'split_image_1' => 'banner_image',
            'split_image_1_alt' => 'banner_alt',
        ];

        foreach ($rename as $from => $to) {
            $row = DB::table($table)
                ->where('page', 'contact-us')
                ->where('section', 'hero')
                ->where('key', $from)
                ->first();

            if (! $row) {
                continue;
            }

            $existingTo = DB::table($table)
                ->where('page', 'contact-us')
                ->where('section', 'hero')
                ->where('key', $to)
                ->first();

            if ($existingTo) {
                DB::table($table)->where('id', $row->id)->delete();
            } else {
                DB::table($table)->where('id', $row->id)->update(['key' => $to]);
            }
        }
    }

    public function down(): void
    {
        $table = 'contents';

        $rename = [
            'banner_image' => 'split_image_1',
            'banner_alt' => 'split_image_1_alt',
        ];

        foreach ($rename as $from => $to) {
            DB::table($table)
                ->where('page', 'contact-us')
                ->where('section', 'hero')
                ->where('key', $from)
                ->update(['key' => $to]);
        }
    }
};

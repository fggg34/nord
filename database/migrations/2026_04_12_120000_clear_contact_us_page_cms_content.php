<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('contents')->where('page', 'contact-us')->delete();
    }

    public function down(): void
    {
        // Intentionally empty: prior rows are not recoverable.
    }
};

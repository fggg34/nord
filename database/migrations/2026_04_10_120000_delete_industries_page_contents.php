<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('contents')->where('page', 'industries')->delete();
    }

    public function down(): void
    {
        // Intentionally empty: removed page is not restored automatically.
    }
};

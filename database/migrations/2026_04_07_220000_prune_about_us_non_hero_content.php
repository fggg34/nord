<?php

use App\Models\Content;
use App\Support\ContentRepository;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $deleted = Content::query()
            ->where('page', 'about-us')
            ->where('section', '!=', 'hero')
            ->get();

        foreach ($deleted as $row) {
            $row->delete();
        }

        ContentRepository::forgetPage('about-us');
    }

    public function down(): void
    {
        // Restoring pruned rows is not supported (content was discarded).
    }
};

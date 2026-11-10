<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // keep old descriptions, the caption is now the only description
        DB::table('images')
            ->whereNull('caption')
            ->whereNotNull('alt_text')
            ->where('alt_text', '!=', 'Testa attēls')
            ->update(['caption' => DB::raw('alt_text')]);

        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('alt_text');
        });
    }

    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->string('alt_text')->nullable()->after('path');
        });
    }
};

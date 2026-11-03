<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            // connect images to sections
            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
                // if a section is deleted its images get deleted too
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
        });
    }
};

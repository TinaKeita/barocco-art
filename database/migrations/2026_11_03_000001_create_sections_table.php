<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            // slug is used in the url so it has to be unique
            $table->string('slug')->unique();
            // label is the name in the menu
            $table->string('label');
            $table->string('title');
            $table->text('intro');
            // list of bold term + text lines, saved as json
            $table->json('items')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};

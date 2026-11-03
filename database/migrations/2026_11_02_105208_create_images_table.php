<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            // section is connected later, so it can be empty
            $table->unsignedBigInteger('section_id')->nullable();
            // path inside storage/app/public, like test/1.jpg
            $table->string('path');
            $table->string('alt_text')->nullable();
            // true = image is shown in the home page gallery
            $table->boolean('show_on_home')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};

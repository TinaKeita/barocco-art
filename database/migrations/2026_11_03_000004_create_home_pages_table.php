<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // One row only: all editable texts of the home page
    public function up(): void
    {
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();

            // Intro at the top
            $table->string('hero_title')->nullable();
            $table->text('hero_text')->nullable();

            // "Pakalpojumi" block
            $table->string('services_eyebrow')->nullable();
            $table->string('services_title')->nullable();
            $table->text('services_text')->nullable();
            $table->json('services_items')->nullable();   // the small boxes: title + text

            // "Kontakti" block
            $table->string('contact_eyebrow')->nullable();
            $table->string('contact_title')->nullable();
            $table->text('contact_text')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};

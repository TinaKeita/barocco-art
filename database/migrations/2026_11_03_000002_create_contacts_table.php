<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // letters shown in the circle, like AL
            $table->string('initials', 4);
            $table->string('role');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            // small text after the phone (gsm, WhatsApp)
            $table->string('phone_note')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

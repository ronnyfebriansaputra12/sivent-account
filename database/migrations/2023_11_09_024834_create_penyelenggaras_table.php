<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyelenggaras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyelenggara')->default('');
            $table->string('email_penyelenggara')->default('')->unique();
            $table->string('username_penyelenggara')->default('')->unique();
            $table->string('password_penyelenggara')->default();
            $table->string('contact_penyelenggara')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyelenggaras');
    }
};

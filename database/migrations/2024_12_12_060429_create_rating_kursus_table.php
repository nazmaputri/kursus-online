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
        Schema::create('rating_kursus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Relasi ke kursus
            $table->integer('stars')->unsigned()->comment('Rating bintang (1-5)');
            $table->text('comment')->nullable()->comment('Komentar dari user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_kursus');
    }
};

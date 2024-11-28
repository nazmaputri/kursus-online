<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('materi_pdf', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materi'); // Relasi ke tabel materi
            $table->string('pdf_file'); // Path atau URL file PDF
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_pdf');
    }
};

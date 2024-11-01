<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul kursus
            $table->text('description')->nullable(); // Deskripsi kursus
            $table->string('category'); // Kategori kursus
            $table->decimal('price', 8, 2)->nullable(); // Harga kursus
            $table->unsignedInteger('capacity')->nullable(); // Kapasitas peserta
            $table->string('image_path')->nullable(); // Path gambar
            $table->text('video_url')->nullable(); // URL video materi
            $table->text('pdf_path')->nullable(); // Path PDF materi
            $table->text('quiz')->nullable(); // Kolom untuk menyimpan kuis
            $table->unsignedBigInteger('mentor_id'); // Menyimpan ID mentor
            $table->timestamps(); // Kolom created_at dan updated_at
        
            // Menambahkan foreign key constraint jika tabel users sudah ada
            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

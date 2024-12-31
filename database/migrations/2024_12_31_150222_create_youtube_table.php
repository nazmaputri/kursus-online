<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYoutubeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('judul'); // Kolom untuk judul video
            $table->string('link_youtube'); // Kolom untuk link YouTube
            $table->unsignedBigInteger('materi_id'); // Foreign key ke tabel materi
            $table->unsignedBigInteger('course_id'); // Foreign key ke tabel course
            $table->timestamps(); // Kolom created_at dan updated_at

            // Relasi ke tabel materi
            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('cascade');
            // Relasi ke tabel course
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('youtube');
    }
}

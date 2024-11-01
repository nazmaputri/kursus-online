<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Kolom ID
            $table->string('name'); // Nama kategori
            $table->string('image_path')->nullable(); // Path gambar
            $table->text('description')->nullable(); // Deskripsi kursus
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->text('description'); 
            $table->unsignedBigInteger('course_id'); 
            $table->integer('duration'); 
            $table->timestamps();
            
            // Relasi ke tabel courses 
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}

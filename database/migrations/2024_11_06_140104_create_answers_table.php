<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id'); 
            $table->string('answer'); 
            $table->boolean('is_correct')->default(false); 
            $table->timestamps();

            // Relasi ke tabel questions
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}

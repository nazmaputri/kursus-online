<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // Menyimpan student yang terkait
            $table->foreignId('mentor_id')->constrained('users')->onDelete('cascade'); // Menyimpan mentor yang terkait
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('chats');
    }
    
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained('chats')->onDelete('cascade'); // Menyimpan chat terkait
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Pengirim pesan
            $table->text('message'); // Isi pesan
            $table->boolean('is_read')->default(false); // Status pesan apakah sudah dibaca
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }

};

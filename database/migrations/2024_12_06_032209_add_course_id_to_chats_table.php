<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseIdToChatsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            // Tambahkan kolom course_id setelah mentor_id
            $table->foreignId('course_id')
                  ->nullable()
                  ->after('mentor_id') // Menentukan posisi kolom
                  ->constrained('courses') // Relasi dengan tabel courses
                  ->cascadeOnDelete(); // Hapus otomatis jika data terkait dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {
            $table->dropForeign(['course_id']); // Hapus foreign key
            $table->dropColumn('course_id'); // Hapus kolom
        });
    }
}

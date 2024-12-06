<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseIdToMateriPdf extends Migration
{
    public function up()
    {
        Schema::table('materi_pdf', function (Blueprint $table) {
            // Menambahkan kolom course_id sebagai foreign key
            $table->unsignedBigInteger('course_id')->nullable()->after('materi_id'); // pastikan urutannya sesuai

            // Jika Anda ingin menjadikan course_id sebagai foreign key yang terhubung dengan tabel courses
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('materi_pdf', function (Blueprint $table) {
            // Menghapus foreign key dan kolom course_id
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        });
    }
}

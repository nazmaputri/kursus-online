<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_materi_id_to_quiz_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMateriIdToQuizTable extends Migration
{
    public function up()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->unsignedBigInteger('materi_id'); // menambahkan kolom materi_id
            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('cascade'); // relasi ke tabel materi
        });
    }

    public function down()
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign(['materi_id']); // menghapus relasi
            $table->dropColumn('materi_id'); // menghapus kolom materi_id
        });
    }
}


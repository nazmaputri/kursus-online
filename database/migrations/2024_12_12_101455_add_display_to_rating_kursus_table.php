<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('rating_kursus', function (Blueprint $table) {
            $table->boolean('display')->default(true)->after('comment'); // Menambahkan kolom display
        });
    }
    
    public function down()
    {
        Schema::table('rating_kursus', function (Blueprint $table) {
            $table->dropColumn('display'); // Menghapus kolom display
        });
    }
    
};

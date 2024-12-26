<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('nilais', function (Blueprint $table) {
        $table->string('id_member', 20); // Menyimpan nisn dari siswas
        $table->unsignedBigInteger('id_mapel'); // ID Mata Pelajaran
        $table->integer('nilai'); // Nilai yang diberikan
        $table->primary(['id_member', 'id_mapel']); // Primary key berupa kombinasi id_member dan id_mapel
        $table->foreign('id_member')->references('nisn')->on('siswas')->onDelete('cascade'); // Menghubungkan id_member dengan nisn
        $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('cascade'); // Menghubungkan id_mapel dengan tabel mapels
        $table->timestamps();
    });
    
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
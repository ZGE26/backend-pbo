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
        // Menambahkan kolom gender pada tabel gurus
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('gender')->nullable();
        });

        // Menambahkan kolom gender pada tabel siswas
        Schema::table('siswas', function (Blueprint $table) {
            $table->string('gender')->nullable();
        });

        // Menambahkan kolom gender pada tabel tus
        Schema::table('t_u_s', function (Blueprint $table) {
            $table->string('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus kolom gender dari tabel gurus
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        // Menghapus kolom gender dari tabel siswas
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        // Menghapus kolom gender dari tabel tus
        Schema::table('t_u_s', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
};
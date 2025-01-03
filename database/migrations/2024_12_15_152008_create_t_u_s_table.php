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
        Schema::create('t_u_s', function (Blueprint $table) {
            $table->id('id_member');
            $table->string('nama');
            $table->string('nip', 20)->unique();
            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('id_sekolah')->nullable();
            $table->foreign('id_sekolah')->references('id_sekolah')->on('sekolahs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_u_s');
    }
};

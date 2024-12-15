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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id('id_member');
            $table->string('nama');
            $table->string('nip', 20)->unique();
            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('id_mapel')->nullable();
            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};

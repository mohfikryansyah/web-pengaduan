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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengadu_id');
            $table->string('kategori');
            $table->string('status');
            $table->string('judul');
            $table->string('pesan');
            $table->date('tanggal');
            $table->date('tanggal_selesai')->nullable();
            $table->integer('durasi')->nullable();
            $table->string('lokasi');
            $table->string('file_input');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};

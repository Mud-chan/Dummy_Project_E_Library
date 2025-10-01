<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->string('id_buku')->primary();
            $table->unsignedBigInteger('id_petugas');
            $table->string('judul');
            $table->string('penulis')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('thumb')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamp('date_created')->nullable();

            $table->foreign('id_petugas')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};

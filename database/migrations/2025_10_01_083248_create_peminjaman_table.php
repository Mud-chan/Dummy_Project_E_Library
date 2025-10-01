<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('id_peminjaman')->primary();
            $table->unsignedBigInteger('id_pengunjung');
            $table->string('id_buku');
            $table->enum('status', ['dipinjam', 'dikembalikan'])->default('dipinjam');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable();

            $table->foreign('id_pengunjung')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};

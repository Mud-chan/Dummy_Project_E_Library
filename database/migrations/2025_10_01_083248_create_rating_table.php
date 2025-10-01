<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rating', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pengunjung');
            $table->string('id_buku');
            $table->integer('rating');

            $table->primary(['id_pengunjung', 'id_buku']);

            $table->foreign('id_pengunjung')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('rating');
    }
};


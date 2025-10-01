<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('detail_buku', function (Blueprint $table) {
            $table->string('id_buku');
            $table->string('id_genre');

            $table->primary(['id_buku', 'id_genre']);

            $table->foreign('id_buku')->references('id_buku')->on('buku')->onDelete('cascade');
            $table->foreign('id_genre')->references('id_genre')->on('genre')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('detail_buku');
    }
};


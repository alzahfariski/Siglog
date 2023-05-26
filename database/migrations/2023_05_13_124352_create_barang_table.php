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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang');
            $table->bigInteger('jumlah')->default(0);

            $table->unsignedBigInteger('id_jenis');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_barang')->onDelete('cascade');
            $table->unsignedBigInteger('id_gudang');
            $table->foreign('id_gudang')->references('id_gudang')->on('gudang')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
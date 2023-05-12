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
        Schema::create('gudang', function (Blueprint $table) {
            $table->id('id_gudang');
            $table->string('nama_gudang');
            $table->string('keterangan');

            $table->unsignedBigInteger('id_lokasi');
 
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gudang');
    }
};

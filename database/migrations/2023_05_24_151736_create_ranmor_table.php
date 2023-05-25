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
        Schema::create('ranmor', function (Blueprint $table) {
            $table->id('id_ranmor');
            $table->bigInteger('tahun');
            $table->string('nosin');
            $table->string('noka');
            $table->string('nopol');
            $table->string('bagian');
            $table->enum('kondisi', ['BB', 'RR', 'RB']);
            $table->string('pemakai');
            $table->unsignedBigInteger('id_jenisranmor');
            $table->foreign('id_jenisranmor')->references('id_jenisranmor')->on('jenis_ranmor')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranmor');
    }
};

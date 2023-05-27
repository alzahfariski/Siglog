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
            $table->string('nosin')->nullable();
            $table->string('noka')->nullable();
            $table->string('nopol')->nullable();
            $table->string('bagian');
            $table->enum('kondisi', ['B', 'RR', 'RB']);
            $table->string('pemakai')->nullable();
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

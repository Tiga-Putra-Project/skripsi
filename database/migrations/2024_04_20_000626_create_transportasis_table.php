<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transportasis', function (Blueprint $table) {
            $table->id('id_driver');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('kota_id')->references('id')->on('kotas')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_kendaraan');
            $table->string('plat_kendaraan');
            $table->integer('kapasitas_penumpang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportasis');
    }
};

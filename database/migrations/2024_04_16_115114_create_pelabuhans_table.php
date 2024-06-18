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
        Schema::create('pelabuhans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kota');
            $table->string('nama_provinsi');
            $table->string('tempat_pelabuhan');
            $table->string('kode_pelabuhan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelabuhans');
    }
};

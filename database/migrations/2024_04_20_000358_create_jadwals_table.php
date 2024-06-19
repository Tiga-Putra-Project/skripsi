<?php

use App\Models\Kapal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('kapal_id')->references('id_kapal')->on('kapals')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('pelabuhan_asal_id')->references('id')->on('pelabuhans')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('pelabuhan_tujuan_id')->references('id')->on('pelabuhans')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('deck_id')->references('id_deck')->on('decks')->onUpdate('cascade')->onDelete('restrict');
            $table->date('tanggal_keberangkatan');
            $table->string('jam_keberangkatan');
            $table->string('jumlah_tiket');
            $table->tinyInteger('tipe_tiket')->comment('1 => "pejalan_kaki", 2 => "Sepeda", 3 => "Sepeda Motor", 4 => "Mobil"');
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};

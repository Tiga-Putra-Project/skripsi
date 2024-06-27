<?php

use App\Models\User;
use App\Models\Jadwal;
use App\Models\Tiket_Kapal;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('jadwal_id')->references('id_jadwal')->on('jadwals')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->dateTime('tanggal_expired');
            $table->tinyInteger('status')->comment('[1] => Belum dibayar, [2] => Sudah dibayar, [3] => Expired');
            $table->integer('jumlah_tiket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

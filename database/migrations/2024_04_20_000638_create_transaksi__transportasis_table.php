<?php

use App\Models\Transportasi;
use App\Models\User;
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
        Schema::create('transaksi_transportasis', function (Blueprint $table) {
            $table->id('id_transaksi_transportasi');
            $table->foreignId('user_id')->references('user_id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('transportasi_id')->references('id_driver')->on('transportasis')->onDelete('restrict')->onUpdate('cascade');
            $table->string('transaksi_transportasi_unique_id')->unique()->nullable();
            $table->text('alamat_jemput');
            $table->text('alamat_tujuan');
            $table->date('tanggal_keberangkatan');
            $table->string('jam_keberangkatan');
            $table->string('jumlah_penumpang');
            $table->string('harga');
            $table->string('status')->comment('[1] => Belum dibayar, [2] => Sudah dibayar, [3] => Dibatalkan, [4] => Selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_transportasis');
    }
};

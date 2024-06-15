<?php

use App\Models\Jadwal;
use App\Models\Tiket_Kapal;
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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi')->nullable();
            $table->foreignIdFor(Tiket_Kapal::class);
            $table->foreignIdFor(Jadwal::class);
            $table->dateTime('tanggal_transaksi')->nullable();
            $table->string('username')->nullable();
            $table->string('harga')->nullable();
            $table->integer('no_wa')->nullable();
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

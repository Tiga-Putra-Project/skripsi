<?php

use App\Models\Deck;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tiket_kapals', function (Blueprint $table) {
            $table->id('tiket_id');
            $table->string('tiket_unique_id')->unique()->nullable();
            $table->foreignId('transaksi_id')->references('id_transaksi')->on('transaksis')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket__kapals');
    }
};

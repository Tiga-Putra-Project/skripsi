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
        Schema::create('transaksi__transportasis', function (Blueprint $table) {
            $table->id('id_transaksi_transportasi')->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Transportasi::class);
            $table->string('harga')->nullable();
            $table->dateTime('tanggal_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi__transportasis');
    }
};

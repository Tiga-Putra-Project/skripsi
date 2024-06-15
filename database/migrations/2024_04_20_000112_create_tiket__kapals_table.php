<?php

use App\Models\Deck;
use App\Models\Jadwal;
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
        Schema::create('tiket__kapals', function (Blueprint $table) {
            $table->id('tiket_id');
            $table->string('tiket_unique_id')->unique()->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Jadwal::class);
            $table->foreignIdFor(Deck::class);
            $table->string('asal')->nullable();
            $table->string('tujuan')->nullable();
            $table->dateTime('waktu_booking')->nullable();
            $table->string('harga')->nullable();
            $table->integer('kuota')->nullable();
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

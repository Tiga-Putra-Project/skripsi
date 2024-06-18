<?php

namespace App\Models;

use App\Models\Deck;
use App\Models\Kapal;
use App\Models\Pelabuhan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    protected $guarded = [];
    protected $table = 'jadwals';
    protected $primaryKey = 'id_jadwal';
    use HasFactory;

    public function kapal()
    {
        return $this->hasOne(Kapal::class, 'id_kapal', 'kapal_id');
    }

    public function deck()
    {
        return $this->hasOne(Deck::class, 'id_deck', 'deck_id');
    }

    public function kotaAsal()
    {
        return $this->hasOne(Pelabuhan::class, 'id', 'pelabuhan_asal_id');
    }

    public function kotaTujuan()
    {
        return $this->hasOne(Pelabuhan::class, 'id', 'pelabuhan_tujuan_id');
    }
}

<?php

namespace App\Models;

use App\Models\Deck;
use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kapal extends Model
{
    protected $guarded = [];
    protected $table = 'kapals';
    protected $primaryKey = 'id_kapal';
    use HasFactory;

    public function deck()
    {
        return $this->belongsTo(Deck::class, 'kapal_id', 'id_kapal');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'kapal_id', 'id_kapal');
    }
}

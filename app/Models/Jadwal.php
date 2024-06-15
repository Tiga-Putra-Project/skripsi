<?php

namespace App\Models;

use App\Models\Kapal;
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
}

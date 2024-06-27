<?php

namespace App\Models;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tiket_Kapal extends Model
{
    protected $guarded = [];
    protected $table = 'tiket_kapals';
    protected $primaryKey = 'tiket_id';
    use HasFactory;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id_transaksi');
    }
}

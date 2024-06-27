<?php

namespace App\Models;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'id_transaksi';
    protected $table = 'transaksis';
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id', 'id_jadwal');
    }
}

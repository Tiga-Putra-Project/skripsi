<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi_Transportasi extends Model
{
    protected $guarded=[];
    protected $table = 'transaksi_transportasis';
    protected $primaryKey = 'id_transaksi_transportasi';
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function transportasi(){
        return $this->hasOne(Transportasi::class, 'id_driver', 'transportasi_id');
    }
}

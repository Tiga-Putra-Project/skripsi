<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'transportasis';
    protected $primaryKey = 'id_driver';

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function kota()
    {
        return $this->hasOne(Kota::class, 'id', 'kota_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $guarded=[];
    protected $primaryKey = 'id_deck';
    use HasFactory;

    public function kapal(){
        return $this->hasOne(Kapal::class,'kapal_id');
    }
}

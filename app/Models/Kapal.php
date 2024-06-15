<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kapal extends Model
{
    protected $guarded = [];
    protected $table = 'kapals';
    protected $primaryKey = 'id_kapal';
    use HasFactory;
}

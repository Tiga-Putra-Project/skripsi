<?php

namespace App\Models;

use App\Models\Deck;
use App\Models\Kapal;
use App\Models\Pelabuhan;
use App\Models\Transaksi;
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

    public function tipeTiket()
    {
        switch ($this->tipe_tiket) {
            case 1:
                return 'Pejalan Kaki';
                break;
            case 2:
                return 'Sepeda';
                break;
            case 3:
                return 'Sepeda Motor';
                break;
            case 4:
                return 'Mobil';
                break;
            default:
                return 'Tidak Ada';
                break;
        }
    }

    public function totalTiketTransaksi()
    {
        $tiket = Transaksi::where('jadwal_id', $this->id_jadwal)->where(function ($query) {
            return $query->where('status', 'Sudah Dibayar')
                ->orWhere('status', 'Belum Dibayar');
        })->get();
        $total_tiket = 0;
        foreach ($tiket as $t) {
            $total_tiket += $t->jumlah_tiket;
        }
        return $this->jumlah_tiket - $total_tiket;
    }
}

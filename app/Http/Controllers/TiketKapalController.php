<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Transaksi;
use App\Models\Tiket_Kapal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TiketKapalController extends Controller
{
    public function index(Request $request)
    {
        $tikets = Tiket_Kapal::where('user_id', $request->user()->id)->orderBy('created_at', 'DESC')->get();
        if ($request->user()->hasRole('admin')) {
            $tikets = Tiket_Kapal::all();
        }
        return view('tiket_kapal.index', compact('tikets'));
    }

    public function transaksi(Request $request)
    {
        if (!auth()->check()) {
            toastr()->error('Silahkan Login Terlebih Dahulu');
            return redirect()->route('login.index');
        }

        Transaksi::create([
            'jadwal_id' => $request->jadwal_id,
            'user_id' => $request->user()->user_id,
            'jumlah_tiket' => $request->jumlah_tiket,
            'tanggal_expired' => date("Y-m-d H:i:s", strtotime('+2 hours')),
            'status' => 1
        ]);

        if ($request->user()->hasRole('admin')) {
            $transaksis = Transaksi::orderBy('created_at', 'desc')->paginate(5);
        } else {
            $transaksis = Transaksi::where('user_id', $request->user()->user_id)->orderBy('created_at', 'desc')->paginate(5);
        }
        $search = '';
        return redirect()->route('transaksi.index', compact('transaksis', 'search'));
    }
}

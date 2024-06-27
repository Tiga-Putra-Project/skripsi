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
        $search = '';
        if ($request->has('search')) {
            $search = $request->search;
            if ($request->user()->hasRole('admin')) {
                $tiketkapals = Tiket_Kapal::where(function ($query) use ($request) {
                    return $query->where('tiket_unique_id', 'LIKE', '%' . $request->search . '%')
                        ->orwhereHas('transaksi', function ($pass_query) use ($request) {
                            return $pass_query->whereHas('jadwal', function ($second_query) use ($request) {
                                return $second_query->where('tanggal_keberangkatan', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('jam_keberangkatan', 'LIKE', '%' . $request->search . '%')
                                    ->orWhereHas('kotaAsal', function ($third_query) use ($request) {
                                        return $third_query->where('tempat_pelabuhan', 'LIKE', '%' . $request->search . '%')
                                            ->orWhere('kode_pelabuhan', 'LIKE', '%' . $request->search . '%');
                                    })->orWhereHas('kotaTujuan', function ($fourth_query) use ($request) {
                                        return $fourth_query->where('tempat_pelabuhan', 'LIKE', '%' . $request->search . '%')
                                            ->orWhere('kode_pelabuhan', 'LIKE', '%' . $request->search . '%');
                                    });
                            });
                        });
                })->orderBy('created_at', 'desc')->paginate(5);
            } else {
                $tiketkapals = Tiket_Kapal::where(function ($query) use ($request) {
                    return $query->where('tiket_unique_id', 'LIKE', '%' . $request->search . '%')
                        ->orwhereHas('transaksi', function ($pass_query) use ($request) {
                            return $pass_query->whereHas('jadwal', function ($second_query) use ($request) {
                                return $second_query->where('tanggal_keberangkatan', 'LIKE', '%' . $request->search . '%')
                                    ->orWhere('jam_keberangkatan', 'LIKE', '%' . $request->search . '%')
                                    ->orWhereHas('kotaAsal', function ($third_query) use ($request) {
                                        return $third_query->where('tempat_pelabuhan', 'LIKE', '%' . $request->search . '%')
                                            ->orWhere('kode_pelabuhan', 'LIKE', '%' . $request->search . '%');
                                    })->orWhereHas('kotaTujuan', function ($fourth_query) use ($request) {
                                        return $fourth_query->where('tempat_pelabuhan', 'LIKE', '%' . $request->search . '%')
                                            ->orWhere('kode_pelabuhan', 'LIKE', '%' . $request->search . '%');
                                    });
                            });
                        });
                })->where('user_id', $request->user()->user_id)->orderBy('created_at', 'desc')->paginate(5);
            }
        } else {
            if ($request->user()->hasRole('admin')) {
                $tiketkapals = Tiket_Kapal::orderBy('created_at', 'DESC')->paginate(5);
            } else {
                $tiketkapals = Tiket_Kapal::whereHas('transaksi', function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->user_id);
                })->orderBy('created_at', 'DESC')->paginate(5);
            }
        }


        return view('tiket_kapal.index', compact('tiketkapals', 'search'));
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
            'status' => 'Belum Dibayar'
        ]);
        return redirect()->route('transaksi.index');
    }
}

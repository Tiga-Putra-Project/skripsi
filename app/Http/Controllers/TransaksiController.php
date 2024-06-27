<?php

namespace App\Http\Controllers;

use App\Models\Tiket_Kapal;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Models\Teansaksi;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        if ($request->has('search')) {
            $search = $request->search;
            if ($request->user()->hasRole('admin')) {
                $transaksis = Transaksi::where(function ($query) use ($request) {
                    return $query->where('created_at', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('jumlah_tiket', 'LIKE', '%' . $request->search . '%')
                        ->orWhereHas('user', function ($second_query) use ($request) {
                            return $second_query->where('fullname', 'LIKE', '%' . $request->search . '%');
                        });
                })->orderBy('created_at', 'desc')->paginate(5);
            } else {
                $transaksis = Transaksi::where(function ($query) use ($request) {
                    return $query->where('created_at', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('jumlah_tiket', 'LIKE', '%' . $request->search . '%');
                })->where('user_id', $request->user()->user_id)->orderBy('created_at', 'desc')->paginate(5);
            }
        } else {
            if ($request->user()->hasRole('admin')) {
                $transaksis = Transaksi::orderBy('created_at', 'desc')->paginate(5);
            } else {
                $transaksis = Transaksi::where('user_id', $request->user()->user_id)->orderBy('created_at', 'desc')->paginate(5);
            }
        }
        return view('transaksi_tiket.index', compact('transaksis', 'search'));
    }

    public function expired(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->id);
        $transaksi->status = 'Expired';
        $transaksi->save();
        return response('success');
    }

    public function cancel($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'Dibatalkan';
        $transaksi->save();
        return redirect()->route('transaksi.index');
    }

    public function bayar(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->id_transaksi);
        $transaksi->status = 'Sudah Dibayar';
        $transaksi->save();

        for ($i = 1; $i <= $transaksi->jumlah_tiket; $i++) {
            $tiket = Tiket_Kapal::create([
                'transaksi_id' => $transaksi->id_transaksi,
            ]);

            $tiket->tiket_unique_id = 'TPT' . date('d') . date('m') . date('Y') . $transaksi->jadwal->kapal_id . sprintf('%04d', $tiket->tiket_id);
            $tiket->save();
        }

        toastr()->success('Pembayaran Berhasil');
        return redirect()->route('tiket.index');
    }
}

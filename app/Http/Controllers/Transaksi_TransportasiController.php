<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi_Transportasi;
use App\Models\Transportasi;

class Transaksi_TransportasiController extends Controller
{
    public function index(Request $request){
        $search = "";
        $isDriver = false;
        $transportasis = Transportasi::where('user_id', auth()->user()->user_id)->get();
        if ($request->has('search')) {
            $transaksis = Transaksi_Transportasi::where(function ($query) use ($request) {
                return $query->where('transaksi_transportasi_unique_id', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('alamat_jemput', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('alamat_tujuan', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('tanggal_keberangkatan', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('jumlah_penumpang', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('harga', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('status', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas('transportasi', function($second_query) use ($request){
                        return $second_query->where('nama_kendaraan', 'LIKE', '%' . $request->search . '%')
                                        ->orWhere('plat_kendaraan', 'LIKE', '%' . $request->search . '%');
                    });
            })->paginate(5);
            $search = $request->search;
        } else {
            if($request->user()->hasRole('admin')){
                $transaksis = Transaksi_Transportasi::orderBy('tanggal_keberangkatan', 'asc')->paginate(5);
            } else if(!$transportasis->isEmpty()){
                $isDriver = true;
                $id = [];
                foreach($transportasis as $transportasi){
                    array_push($id, $transportasi->id_driver);
                }
                $transaksis = Transaksi_Transportasi::where(function($query) use ($id){
                    return $query->where('user_id', auth()->user()->user_id)->orWhereIn('transportasi_id', $id);
                })->whereIn('status', ['Sudah Dibayar', 'Selesai'])->orderBy('tanggal_keberangkatan', 'asc')->paginate(5);
            } else {
                $transaksis = Transaksi_Transportasi::where('user_id', auth()->user()->user_id)->orderBy('tanggal_keberangkatan', 'asc')->paginate(5);
            }
        }
        return view('transaksi_transportasi.index', compact('transaksis', 'search', 'isDriver'));
    }

    public function bayar(Request $request){
        $transaksi_transportasi = Transaksi_Transportasi::find($request->id_transaksi_transportasi);
        $transaksi_transportasi->status = 'Sudah Dibayar';
        $transaksi_transportasi->save();
        toastr()->success('Berhasil Membayar Travel');
        return redirect()->back();
    }

    public function cancel($id){
        $transaksi_transportasi = Transaksi_Transportasi::find($id);
        $transaksi_transportasi->status = 'Dibatalkan';
        $transaksi_transportasi->save();
        toastr()->success('Travel Telah Dibatalkan');
        return redirect()->back();
    }

    public function selesai(Request $request){
        $transaksi_transportasi = Transaksi_Transportasi::find($request->id_transaksi_transportasi);
        $transaksi_transportasi->status = 'Selesai';
        $transaksi_transportasi->save();
        toastr()->success('Travel Telah Selesai');
        return redirect()->back();
    }

    public function transaksi(Request $request){
        $transaksi_transportasi = Transaksi_Transportasi::create([
            'user_id' => $request->user()->user_id,
            'transportasi_id' => $request->id_driver,
            'alamat_jemput' => $request->alamat_jemput,
            'alamat_tujuan' => $request->alamat_tujuan,
            'tanggal_keberangkatan' => date('Y-m-d', strtotime($request->tanggal_keberangkatan)),
            'jam_keberangkatan' => $request->jam_keberangkatan,
            'jumlah_penumpang' => $request->jumlah_penumpang,
            'harga' => 250000,
            'status' => 'Belum Dibayar'
        ]);

        $transaksi_transportasi->transaksi_transportasi_unique_id = 'TPTR' . date('d') . date('m') . date('Y') . sprintf('%04d', $transaksi_transportasi->id_transaksi_transportasi);
        $transaksi_transportasi->save();
        return redirect()->route('transportasi.index');
    }
}

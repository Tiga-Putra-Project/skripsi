<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Teansaksi;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        if ($request->user()->hasRole('admin')) {
            $transaksis = Transaksi::orderBy('created_at', 'desc')->paginate(5);
        } else {
            $transaksis = Transaksi::where('user_id', $request->user()->user_id)->orderBy('created_at', 'desc')->paginate(5);
        }
        return view('transaksi_tiket.index', compact('transaksis', 'search'));
    }

    public function expired(Request $request)
    {
        $transaksi = Transaksi::findOrFail($request->id);
        $transaksi->status = 3;
        $transaksi->save();
        return response('success');
    }
}

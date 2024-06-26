<?php

namespace App\Http\Controllers;

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

        dd(Auth::user()->user_id);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket_Kapal;

class TiketKapalController extends Controller
{
    public function index(Request $request){
        $tikets = Tiket_Kapal::where('user_id',$request->user()->id)->orderBy('created_at', 'DESC')->get();
        if($request->user()->hasRole('admin')){
            $tikets = Tiket_Kapal::all();
        }
        return view('tiket_kapal.index', compact('tikets'));
    }
}

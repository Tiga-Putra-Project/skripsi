<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        $kotas = Kota::all();
        return view('homepage.pages.pesan_travel', compact('kotas'));
    }
}

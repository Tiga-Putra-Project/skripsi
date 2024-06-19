<?php

namespace App\Http\Controllers\Landing;

use App\Models\Pelabuhan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TiketController extends Controller
{
    public function index()
    {
        $pelabuhans = Pelabuhan::all();
        return view('homepage.pages.pesan_tiket', compact('pelabuhans'));
    }
}

<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        return view('homepage.pages.pesan_tiket');
    }
}

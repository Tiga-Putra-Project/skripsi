<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    public function index()
    {
        return view('homepage.pages.pesan_travel');
    }
}

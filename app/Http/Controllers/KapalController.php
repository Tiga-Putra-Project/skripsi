<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kapal;

class KapalController extends Controller
{
    public function index()
    {
        $search = '';
        $kapals = Kapal::orderBy('created_at', 'desc')->paginate(5);
        return view('kapal.index', compact('kapals', 'search'));
    }
}

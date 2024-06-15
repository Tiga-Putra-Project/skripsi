<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deck;

class DeckController extends Controller
{
    public function index(){
        $search = '';
        $decks = Deck::orderBy('created_at', 'desc')->paginate(5);
        return view('deck.index', compact('decks', 'search'));
    }
}

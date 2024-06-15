<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deck;
use App\Models\Kapal;

class DeckController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        if ($request->search) {
            $decks = Deck::where(function ($query) use ($request) {
                return $query->where('kelas', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas('kapal', function ($subquery) use ($request) {
                        $subquery->where('nama_kapal', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('kode_kapal', 'LIKE', '%' . $request->search . '%');
                    });
            })->orderBy('created_at', 'DESC')->paginate(5);
            $search = $request->search;
        } else {
            $decks = Deck::orderBy('created_at', 'desc')->paginate(5);
        }
        $kapals = Kapal::all();
        return view('deck.index', compact('decks', 'search', 'kapals'));
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'kapal_id' => 'required',
            'kelas' => 'required',
        ]);
        Deck::create($data);
        toastr()->success('Data Deck Behasil Ditambahkan');
        return redirect()->route('deck.index');
    }

    public function destroy($id)
    {
        Deck::destroy($id);
        toastr()->success('Data Deck Berhasil Dihapus');
        return redirect()->route('deck.index');
    }

    public function edit(Request $request, $id)
    {
        $deck = Deck::findOrFail($id);
        $deck->kapal_id = $request->kapal_id;
        $deck->kelas = $request->kelas;
        $deck->save();
        toastr()->success('Data Deck Berhasil Diedit');
        return redirect()->route('deck.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Models\Kapal;
use Illuminate\Http\Request;

class KapalController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        if ($request->has('search')) {
            $search = $request->search;
            $kapals = Kapal::where('nama_kapal', 'LIKE', '%' . $request->search . '%')
                ->orWhere('kapasitas', 'LIKE', '%' . $request->search . '%')
                ->orWhere('kode_kapal', 'LIKE', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        } else {
            $kapals = Kapal::orderBy('created_at', 'desc')->paginate(5);
        }
        return view('kapal.index', compact('kapals', 'search'));
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'nama_kapal' => 'required',
            'kapasitas' => 'required',
        ]);
        $kapal = Kapal::create($data);
        $kapal->kode_kapal = 'TPK' . sprintf('%04d', $kapal->id_kapal);
        $kapal->save();
        toastr()->success('Data Kapal Behasil Ditambahkan');
        return redirect()->route('kapal.index');
    }

    public function destroy($id)
    {
        try {
            Kapal::destroy($id);
            toastr()->success('Data Kapal Berhasil Dihapus');
            return redirect()->route('kapal.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 19) {
                $kapal = Kapal::find($id);
                toastr()->error('Data Kapal Dengan Kode ' . $kapal->kode_kapal . ' Sedang Digunakan Pada Data Lain (Gagal Menghapus)');
                return redirect()->route('kapal.index');
            } else {
                return abort(404);
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $kapal = Kapal::findOrFail($id);
        $kapal->nama_kapal = $request->nama_kapal;
        $kapal->kapasitas = $request->kapasitas;
        $kapal->save();
        toastr()->success('Data Kapal Berhasil Diedit');
        return redirect()->route('kapal.index');
    }

    public function get_data(Request $request)
    {
        if ($request->has('id')) {
            $kapal = Kapal::find($request->id);
            $decks = Deck::where('kapal_id', $request->id)->get();
            $kelas = collect([]);
            if (!$decks->isEmpty()) {
                foreach ($decks as $deck) {
                    $kelas->push([
                        'id' => $deck->id_deck,
                        'text' => $deck->kelas,
                    ]);
                }
            }
            $data = [
                'kapal' => $kapal,
                'deck' => $kelas
            ];
            return response()->json($data);
        } else {
            return abort(404);
        }
    }
}

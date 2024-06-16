<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kapal;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $search = '';
        if ($request->has('search')) {
            $search = $request->search;
            $jadwals = Jadwal::where(function ($query) use ($request) {
                return $query->where('tanggal_keberangkatan', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('jam_keberangkatan', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas('kapal', function ($second_query) use ($request) {
                        return $second_query->where('nama_kapal', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('kode_kapal', 'LIKE', '%' . $request->search . '%');
                    });
            })->orderBy('created_at', 'desc')->paginate(5);
        } else {
            $jadwals = Jadwal::orderBy('created_at', 'desc')->paginate(5);
        }
        $kapals = Kapal::all();
        return view('jadwal.index', compact('jadwals', 'search', 'kapals'));
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'tanggal_keberangkatan' => 'required',
            'jam_keberangkatan' => 'required',
            'kapal_id' => 'required',
        ]);
        Jadwal::create($data);
        toastr()->success('Data Jadwal Behasil Ditambahkan');
        return redirect()->route('jadwal.index');
    }

    public function destroy($id)
    {
        Jadwal::destroy($id);
        toastr()->success('Data Jadwal Berhasil Dihapus');
        return redirect()->route('jadwal.index');
    }

    public function edit(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->jadwal_keberangkatan = $request->jadwal_keberangkatan;
        $jadwal->kapal_id = $request->kapal_id;
        $jadwal->save();
        toastr()->success('Data Jadwal Berhasil Diedit');
        return redirect()->route('jadwal.index');
    }
}

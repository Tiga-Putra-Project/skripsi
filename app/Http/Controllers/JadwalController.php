<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Jadwal;
use App\Models\Kapal;
use App\Models\Pelabuhan;

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
                    })
                    ->orWhereHas('kotaAsal', function ($third_query) use ($request) {
                        return $third_query->where('nama_kota', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('kode_pelabuhan', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('nama_provinsi', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('tempat_pelabuhan', 'LIKE', '%' . $request->search . '%');
                    })
                    ->orWhereHas('kotaTujuan', function ($fourth_query) use ($request) {
                        return $fourth_query->where('nama_kota', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('kode_pelabuhan', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('nama_provinsi', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('tempat_pelabuhan', 'LIKE', '%' . $request->search . '%');
                    });
            })->orderBy('created_at', 'desc')->paginate(5);
        } else {
            $jadwals = Jadwal::orderBy('created_at', 'desc')->paginate(5);
        }
        $kapals = Kapal::all();
        $pelabuhans = Pelabuhan::all();
        return view('jadwal.index', compact('jadwals', 'search', 'kapals', 'pelabuhans'));
    }

    public function submit(Request $request)
    {
        $data = Validator::make($request->all(), [
            'tanggal_keberangkatan' => 'required',
            'jam_keberangkatan' => 'required',
            'kapal_id' => 'required',
            'jumlah_tiket' => 'required',
            'pelabuhan_asal_id' => 'required',
            'pelabuhan_tujuan_id' => 'required',
            'deck_id' => 'required'
        ]);
        if ($data->fails()) {
            toastr()->error('Data Jadwal Gagal Ditambahkan');
            return redirect()->route('jadwal.index')->withErrors($data)->withInput($request->all());
        }
        Jadwal::create($data->validated());
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Jadwal;
use App\Models\Kapal;
use App\Models\Pelabuhan;
use Illuminate\Support\Str;

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
            'deck_id' => 'required',
            'tipe_tiket' => 'required',
            'harga' => 'required'
        ]);
        if ($data->fails()) {
            toastr()->error('Data Jadwal Gagal Ditambahkan');
            return redirect()->route('jadwal.index')->withErrors($data)->withInput($request->all());
        }
        $data_arr = $data->validated();
        $data_arr['harga'] = Str::replace('Rp. ', '', $data_arr['harga']);
        $data_arr['harga'] = Str::replace('.', '', $data_arr['harga']);
        Jadwal::create($data_arr);
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
        $jadwal->tanggal_keberangkatan = $request->tanggal_keberangkatan;
        $jadwal->jam_keberangkatan = $request->jam_keberangkatan;
        $jadwal->kapal_id = $request->kapal_id;
        $jadwal->jumlah_tiket = $request->jumlah_tiket;
        $jadwal->pelabuhan_asal_id = $request->pelabuhan_asal_id;
        $jadwal->pelabuhan_tujuan_id = $request->pelabuhan_tujuan_id;
        $jadwal->deck_id = $request->deck_id;
        $jadwal->tipe_tiket = $request->tipe_tiket;
        $harga = Str::replace('Rp. ', '', $request->harga);
        $harga = Str::replace('.', '', $harga);
        $jadwal->harga = $harga;
        $jadwal->save();
        toastr()->success('Data Jadwal Berhasil Diubah');
        return redirect()->route('jadwal.index');
    }

    public function get_data(Request $request)
    {
        if ($request->pelabuhan_asal_id != 0 && $request->pelabuhan_tujuan_id != 0) {
            $jadwal = Jadwal::where(function ($query) use ($request) {
                if ($request->has('tanggal_keberangkatan')) {
                    $query->where('tanggal_keberangkatan', $request->tanggal_keberangkatan);
                }
                if ($request->has('tipe_tiket')) {
                    $query->where('tipe_tiket', $request->tipe_tiket);
                }
                if ($request->has('deck_id')) {
                    $query->where('deck_id', $request->deck_id);
                }
                return $query->where('pelabuhan_asal_id', $request->pelabuhan_asal_id)
                    ->where('pelabuhan_tujuan_id', $request->pelabuhan_tujuan_id);
            })->orderBy('tipe_tiket', 'asc')->get();
            if ($jadwal->count() > 0) {
                $i = 0;
                foreach ($jadwal as $item) {
                    if ($item->totalTiketTransaksi() <= 0) {
                        unset($jadwal[$i]);
                    }
                    $i++;
                }
            }
            if ($jadwal->count() > 0) {
                foreach ($jadwal as $item) {
                    $item->kelas_name = $item->deck->kelas;
                    $item->nama_kapal = $item->kapal->nama_kapal;
                    $item->kode_kapal = $item->kapal->kode_kapal;
                    $item->harga = 'Rp. ' . number_format($item->harga, 0, ',', '.');
                }
            }
            return response()->json($jadwal);
        } else {
            return abort(404);
        }
    }

    public function get_total_tiket(Request $request)
    {
        if ($request->has('jadwal_id')) {
            $jadwal = Jadwal::findOrFail($request->jadwal_id);
            $total_tiket = $jadwal->totalTiketTransaksi();
            return response()->json($total_tiket);
        } else {
            return response()->json(['error' => 'Page Not Found'], 404);
        }
    }
}

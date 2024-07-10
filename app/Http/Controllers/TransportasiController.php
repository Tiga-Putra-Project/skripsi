<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\User;
use App\Models\Transportasi;
use Illuminate\Http\Request;

class TransportasiController extends Controller
{
    public function index(Request $request)
    {
        $kotas = Kota::all();
        $users = User::all()->diff(User::where('role', 'admin')->get());
        $search = '';
        if ($request->has('search')) {
            $transportasis = Transportasi::where(function ($query) use ($request) {
                return $query->where('nama_kendaraan', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('plat_kendaraan', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('kapasitas_penumpang', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas('user', function ($second_query) use ($request) {
                        return $second_query->where('fullname', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('user_unique_id', 'LIKE', '%' . $request->search . '%');
                    })
                    ->orWhereHas('kota', function ($third_query) use ($request) {
                        return $third_query->where('name', 'LIKE', '%' . $request->search . '%');
                    });
            })->paginate(5);
            $search = $request->search;
        } else {
            $transportasis = Transportasi::orderBy('created_at', 'desc')->paginate(5);
        }
        return view('transportasi_travel.index', compact('transportasis', 'kotas', 'users', 'search'));
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'nama_kendaraan' => 'required',
            'plat_kendaraan' => 'required',
            'kapasitas_penumpang' => 'required|min:1',
            'user_id' => 'required',
            'kota_id' => 'required',
        ]);
        Transportasi::create($data);
        toastr()->success('Data Transportasi Behasil Ditambahkan');
        return redirect()->route('admin.transportasi.index');
    }

    public function destroy($id)
    {
        Transportasi::destroy($id);
        toastr()->success('Data Transportasi Berhasil Dihapus');
        return redirect()->route('admin.transportasi.index');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'nama_kendaraan' => 'required',
            'plat_kendaraan' => 'required',
            'kapasitas_penumpang' => 'required|min:1',
            'user_id' => 'required',
            'kota_id' => 'required',
        ]);
        $transportasi = Transportasi::findOrFail($request->id);
        $transportasi->nama_kendaraan = $request->nama_kendaraan;
        $transportasi->plat_kendaraan = $request->plat_kendaraan;
        $transportasi->kapasitas_penumpang = $request->kapasitas_penumpang;
        $transportasi->user_id = $request->user_id;
        $transportasi->kota_id = $request->kota_id;
        $transportasi->save();
        toastr()->success('Data Transportasi Berhasil Diedit');
        return redirect()->route('admin.transportasi.index');
    }

    public function get_data(Request $request){
        if($request->has('kota_id')){
            $transportasis = Transportasi::where('kota_id', $request->kota_id)->where('kapasitas_penumpang','>=', $request->jumlah_penumpang)->get();
            foreach($transportasis as $transportasi){
                $transportasi->nama_lengkap = $transportasi->user->fullname;
            }
            return response()->json($transportasis);
        } else {
            return abort(404);
        }
    }
}

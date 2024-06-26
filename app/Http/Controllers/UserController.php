<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([
            $field => $request->email
        ]);

        $credentials = $request->only($field, 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            toastr()->success('Login Berhasil');
            return redirect()->intended('/home');
        }

        toastr()->error('Username atau Password Salah');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        toastr()->success('Logout Berhasil');
        return redirect()->route('homepage.landing');
    }

    public function form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'alamat' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
            'fullname' => 'required'
        ]);

        if ($request->password != $request->password_confirmation) {
            toastr()->error('Password Tidak Sama');
            return redirect()->back();
        }

        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_daftar' => Carbon::now(),
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
        $user->user_unique_id = 'TP' . sprintf('%04d', $user->user_id);
        $user->save();
        toastr()->success('Akun Berhasil Dibuat');
        return redirect()->route('login.index');
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        return view('user.profile', compact('user'));
    }

    public function edit_profile(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'alamat' => 'required'
        ]);
        $user = $request->user();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->save();
        toastr()->success('Profile Berhasil Diedit');
        return redirect()->back();
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8'
        ]);

        if (!Hash::check($request->old_password, $request->user()->password)) {
            toastr()->error('Password Lama Salah');
            return redirect()->back();
        } else if ($request->new_password != $request->confirm_password) {
            toastr()->error('Konfirmasi Password Tidak Sama Dengan Password Baru');
            return redirect()->back();
        } else if ($request->old_password == $request->new_password) {
            toastr()->error('Password Baru Sama Dengan Password Lama');
            return redirect()->back();
        }

        $user = $request->user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        toastr()->success('Password Berhasil Diubah');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();
            toastr()->success('User Berhasil Dihapus');
            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 19) {
                $user = User::find($id);
                toastr()->error('Data User Dengan Kode ' . $user->user_unique_id . ' Sedang Digunakan Pada Data Lain (Gagal Menghapus)');
                return redirect()->route('admin.user.index');
            } else {
                return abort(404);
            }
        }
    }

    public function userListIndex(Request $request)
    {
        toastr()->warning('atmin murka');
        $search = '';
        if ($request->has('search')) {
            $users = User::where(function ($query) use ($request) {
                $query->where('username', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('user_unique_id', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('alamat', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('tanggal_daftar', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('tanggal_konfirmasi', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('role', 'LIKE', '%' . $request->search . '%');
            })->paginate(5);
            $search = $request->search;
        } else {
            $users = User::orderBy('created_at', 'desc')->paginate(5);
        }
        return view('user.index', ['users' => $users, 'search' => $search]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'alamat' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8'
        ]);
        if ($request->password != $request->confirm_password) {
            toastr()->error('Password Tidak Sama');
            return redirect()->back();
        }
        $role = 'user';
        if ($request->role == 'admin') {
            $role = 'admin';
        }
        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_daftar' => Carbon::now(),
            'password' => Hash::make($request->password),
            'role' => $role
        ]);
        $user->user_unique_id = 'TP' . sprintf('%04d', $user->user_id);
        $user->save();
        toastr()->success('Akun Berhasil Dibuat');
        return redirect()->route('admin.userlist.index');
    }
}

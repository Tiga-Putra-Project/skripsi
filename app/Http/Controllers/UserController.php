<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(){
        return view('auth.login');
    }

    public function auth(Request $request){
        $request->validate([
            'email' =>'required|email',
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            toastr()->success('Login Berhasil');
            return redirect()->intended('/home');
        }

        toastr()->error('Username atau Password Salah');
        return redirect()->back();
    }

    public function logout(){
        Auth::logout();
        toastr()->success('Logout Berhasil');
        return redirect()->route('homepage.landing');
    }

    public function form(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' =>'required|unique:users',
            'email' =>'required|email|unique:users',
            'alamat' =>'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8'
        ]);

        if($request->password != $request->password_confirmation){
            toastr()->error('Password Tidak Sama');
            return redirect()->back();
        }

        $user = User::create([
            'username' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_daftar' => Carbon::now(),
            'password' =>  Hash::make($request->password),
            'role' => 'user'
        ]);
        $user->user_unique_id = 'TP'.sprintf('%04d', $user->id);
        $user->save();
        toastr()->success('Akun Berhasil Dibuat');
        return redirect()->route('login.index');
    }

    public function destroy($id){
        User::findOrFail($id)->delete();
        toastr()->success('User Berhasil Dihapus');
        return redirect()->back();
    }

    public function userListIndex(Request $request){
        toastr()->warning('atmin murka');
        $search = '';
        if($request->has('search')){
            $users = User::where(function($query) use ($request){
                $query->where('username', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('user_unique_id', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('email', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('alamat', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('tanggal_daftar', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('tanggal_konfirmasi', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('role', 'LIKE', '%'.$request->search.'%');
            })->paginate(5);
            $search = $request->search;
        } else {
            $users = User::orderBy('created_at', 'desc')->paginate(5);
        }
        return view('user.index', ['users' => $users, 'search' => $search]);
    }

    public function submit(Request $request){
        $request->validate([
            'username' =>'required|unique:users',
            'email' =>'required|email|unique:users',
            'alamat' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8'
        ]);
        if($request->password != $request->confirm_password){
            toastr()->error('Password Tidak Sama');
            return redirect()->back();
        }
        $role = 'user';
        if($request->role == 'admin'){
            $role = 'admin';
        }
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tanggal_daftar' => Carbon::now(),
            'password' =>  Hash::make($request->password),
            'role' => $role
        ]);
        $user->user_unique_id = 'TP'.sprintf('%04d', $user->user_id);
        $user->save();
        toastr()->success('Akun Berhasil Dibuat');
        return redirect()->route('admin.userlist.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function user(Request $request){
        if ($request->ajax()){
            $user = User::where(function($query) use ($request){
                $query->where("username","like","%",  $request->search)
                    ->orWhere("email","like","%", $request->search)
                    ->orWhere("alamat","like","%", $request->search)
                    ->orWhere("created_at","like","%", $request->search);
            })->get();
        }
    }
}

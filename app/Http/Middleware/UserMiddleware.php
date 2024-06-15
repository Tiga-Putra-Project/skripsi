<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = null)
    {
        if(auth()->check()){
            if($role){
                if($request->user()->hasRole($role)){
                    return $next($request);
                } else {
                    abort(404);
                }
            } else {
                return $next($request);
            }
        } else {
            auth()->logout();
            toastr()->info('Silahkan Login Terlebih Dahulu');
            return redirect()->route('login.index');
        }

    }
}

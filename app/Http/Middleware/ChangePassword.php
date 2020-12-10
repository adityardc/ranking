<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChangePassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cek = DB::table('users')->where('id', Auth::user()->id)->first();
        if($cek->created_at === $cek->updated_at){
            return redirect('/change_password');
        }
        
        return $next($request);
    }
}

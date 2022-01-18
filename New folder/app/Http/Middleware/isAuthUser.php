<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use DB;
class isAuthUser
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
        if(Session::has('authId') && Session::has('isAuthenticated')){
            $user = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', Session::get('authId'))
            ->select('users.*', 'roles.role')
            ->first();

            if ($user->role === 'admin') {
                return $next($request);
            }
        }else{
            return redirect('/');
        }
    }
}

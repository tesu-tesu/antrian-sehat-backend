<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role1 = null, $role2 = null, $role3 = null)
    {
        if(Auth::check()){
            $role_db = auth()->user()->role;

            if($role_db != $role1 && $role_db != $role2 && $role_db != $role3)
                return response()->json([
                    'error' => 'Not authorized.',
//                    'message' => 'you must be an patient to access this route'
                    'message' => 'Access Denied'
                ],403);
        }

        return $next($request);
    }
}

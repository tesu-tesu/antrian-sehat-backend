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
    public function handle($request, Closure $next, $role)
    {
        if(Auth::check()){
            $roles = is_array($role)
                ? $role
                : explode('|', $role);

            if (! in_array(auth()->user()->role, $roles)) {
                return response()->json([
                    'error' => 'Not authorized.',
                    'message' => 'Access Denied'
                ],403);
            }
        }

        return $next($request);
    }
}

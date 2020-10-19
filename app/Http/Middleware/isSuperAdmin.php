<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class isSuperAdmin
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
        if (@Auth::user()->role != "Super Admin") {
            return response()->json([
                'error' => 'Not authorized.',
                'message' => 'you must be a super admin to access this route'
            ],403);
        }
        return $next($request);
    }
}

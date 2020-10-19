<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
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
        if (@Auth::user()->role != "Admin") {
            return response()->json([
                'error' => 'Not authorized.',
                'message' => 'you must be an admin to access this route'
            ],403);
        }
        return $next($request);
    }
}

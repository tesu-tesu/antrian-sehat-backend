<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class isPasien
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
        if (@Auth::user()->role != "Pasien") {
            return response()->json([
                'error' => 'Not authorized.',
                'message' => 'you must be an patient to access this route'
            ],403);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsLogin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if (auth()->check()) {
            return $next($request);
        } else {
            return response()->json(['message' => $request, 'code' => 400], 400);
            abort(518, 'Error. Permiso denegado el usuario no esta logueado ');
        }
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class notPersona
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Persona::where('dni', $request->input('dni'))->count() == 0) {
            return $next($request);
        } else {
            abort(518);
        }
    }
}

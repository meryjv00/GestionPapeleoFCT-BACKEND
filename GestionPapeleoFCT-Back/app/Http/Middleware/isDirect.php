<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\RolUsuario;

class isDirect
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
        $user = auth()->user();
        $rol = RolUsuario::where("user_dni", "=", $user->dni)->get();
        if ($rol[0]->role_id == 1) {
            return $next($request);
        } else {
            abort(518, 'Error el usuario no es Director');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

use App\Models\User;

class notUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        $data = $request->validate([
            'email' => 'email|required'
        ]);
        if (User::where('email', $data['email'])->count() == 0) {
            return $next($request);
        } else {
            abort(518, 'Error el usuario ya existe');
        }
    }
}
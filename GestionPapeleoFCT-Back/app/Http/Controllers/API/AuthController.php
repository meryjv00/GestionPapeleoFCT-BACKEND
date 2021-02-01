<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller {

    public function register(Request $request) {
        //return response()->json([$request->all()]);
//        $validatedData = $request->validate([
//            'dni' => 'required|unique:users',
//            'email' => 'email|required|unique:users',
//            'password' => 'required|confirmed'
//        ]);

        if (User::where('email', $request->input('email'))->count() == 1) {
            return response()->json(['message' => 'Registro incorrecto. Revise las credenciales.', 'code' => 400], 400);
        }

        $validatedData = [
            'dni' => $request->input("dni"),
            'email' => $request->input("email"),
            'password' => $request->input("password"),
        ];

        $validatedData['password'] = \Hash::make($request->input("password"));
        $user = User::create($validatedData);
        $user->roles()->attach($request->input("rol"));
        $accessToken = $user->createToken('authToken')->accessToken;
        return response()->json(['message' => ['user' => $user, 'access_token' => $accessToken], 'code' => 201], 201);
    }

    public function login(Request $request) {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            //return response(['message' => 'Login incorrecto. Revise las credenciales.'], 400);
            return response()->json(['message' => 'Login incorrecto. Revise las credenciales.', 'code' => 400], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        //return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        return response()->json(['message' => ['user' => auth()->user(), 'access_token' => $accessToken], 'code' => 200], 200);
    }

}

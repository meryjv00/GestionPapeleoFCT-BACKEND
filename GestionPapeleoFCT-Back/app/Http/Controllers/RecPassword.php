<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RecPassword extends Controller {

    public function isUser(Request $request) {
        $email = $request->input('email');
        $res = false;
        if (User::where('email', '=', $email)->count() != 1) {
            return response()->json(['menssage' => 'Enviado', 'code' => 200], 200);
        }
        $token = DB::table('password_resets')->where('email', $email)->first();

        if (\Hash::check($request->input("token"), $token->token)) {
            $res = true;
        }

        return response()->json(['menssage' => ['res' => $res], 'code' => 200], 200);
    }

    public function modPass(Request $request) {
        $user = User::where('email', $request->input('email'))->first();

        if (\Hash::check($request->input("password"), $user->password)) {
            return response()->json(['menssage' => 'Contraseña incorrectas. Revise las credenciales.', 'code' => 400], 400);
        }

        $user->password = \Hash::make($request->input("newpassword"));
        $user->save();
        DB::table('password_resets')->where('email', $request->input('email'))->delete();
        
        return response()->json(['menssage' => 'Contraseña modificada', 'code' => 201], 201);
    }

}

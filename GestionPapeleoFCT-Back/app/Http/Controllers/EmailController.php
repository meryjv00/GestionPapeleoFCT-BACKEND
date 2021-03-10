<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class EmailController extends Controller {

    public function enviar(Request $request) {
        $datos = [
            'nombreUsuario' => $request->input('nombreUsuario'),
            'asunto' => $request->input('asunto'),
            'email' => $request->input('email')
        ];

        $email = 'sergiosusin.ssc@gmail.com';

        //Le mando la vista 'Mensahe' como cuerpo del correo.
        \Mail::send('Mensaje', $datos, function($message) use ($email) {
            $message->to($email)->subject('Correo de información');
            $message->from('auxiliardaw2@gmail.com', 'Modificación cuenta.');
        });
        return 'Enviado';
    }

    public function RecPass(Request $request) {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');
        if  (User::where('email','=',$email)->count() != 1) {
            return response()->json(['message' => 'User does not exist', 'code' => 200], 200);
        }
        $tok=Str::random(60);
        
        DB::table('password_resets')->updateOrInsert(
                ['email' =>$email],
                ['token' => \Hash::make($tok)],
                ['created_at' => Carbon::now()]
        );
        
        //Get the token just created above
        $datos = [
            'asunto' => 'Recuperar contraseña',
            'email' => $email,
            'link' => $request->input('link') . '?email=' . $email . '&token=' . $tok
        ];

        //Le mando la vista 'ResetPassMensaje' como cuerpo del correo.
        \Mail::send('ResetPassMensaje', $datos, function($message) use ($email) {
            $message->to($email)->subject('Recuperar contraseña.');
            $message->from('auxiliardaw2@gmail.com', 'Recuperar contraseña.');
        });
        return response()->json(['message' => 'Enviado', 'code' => 200], 200);
    }

}

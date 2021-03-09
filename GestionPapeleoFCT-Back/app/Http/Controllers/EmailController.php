<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function enviar(Request $request)
    {
        $datos = [
            'nombreUsuario' => $request->input('nombre'),
            'asunto' => $request->input('asunto'),
            'email' => $request->input('email')
        ];

        $email = $request->input('email');
        $asunto = $request->input('asunto');

        //Le mando la vista 'welcome' como cuerpo del correo.
        \Mail::send('Mensaje', $datos, function($message) use ($email)
        {
            $message->to($email)->subject('Correo de información');
            $message->from('auxiliardaw2@gmail.com', $asunto);
        });
        return 'Enviado';
    }
}

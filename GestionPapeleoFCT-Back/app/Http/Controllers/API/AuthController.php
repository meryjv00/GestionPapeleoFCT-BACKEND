<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use App\Models\RolUsuario;

class AuthController extends Controller {

    public function register(Request $request) {

        if (User::where('email', $request->input('email'))->where('dni', $request->input('dni'))->count() == 1) {
            return response()->json(['message' => 'Registro incorrecto. Revise las credenciales.', 'code' => 400], 400);
        }

        $validatedData = $request->validate([
            'dni' => 'required|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required'
        ]);

        $validatedData['password'] = \Hash::make($request->input("password"));

        $user = User::create($validatedData);
        $user->roles()->attach($request->input("rol"));

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['message' => ['user' => $user, 'access_token' => $accessToken], 'code' => 201], 201);
    }

    /**
     * Registro profesor dirigido a la tabla persona
     * @param Request $request
     * @return json
     */
    public function register_persona(Request $request) {
        if (Persona::where('correo', $request->input('email'))->count() == 1) {
            $persona = Persona::where('correo', $request->input('email'))->first();
            $persona->dni = $request->input("dni");
            $persona->nombre = $request->input("nombre");
            $persona->apellidos = $request->input("apellidos");
            $persona->localidad = $request->input("localidad");
            $persona->residencia = $request->input("residencia");
            $persona->tlf = $request->input("tlf");
            $persona->save();
            return response()->json(['message' => ['user' => $persona], 'code' => 201], 201);
        }
        $validatedData = [
            'correo' => $request->input("email"),
            'dni' => $request->input("dni"),
            'nombre' => $request->input("nombre"),
            'apellidos' => $request->input("apellidos"),
            'localidad' => $request->input("localidad"),
            'residencia' => $request->input("residencia"),
            'tlf' => $request->input("tlf"),
        ];
        $persona = Persona::create($validatedData);

        return response()->json(['message' => ['user' => $persona], 'code' => 201], 201);
    }

    /**
     * funcion para comprobar si una persona existe, si existe devuelve los datos si no null.
     * @param Request $request
     * @return type
     */
    public function isPersona(Request $request) {
        if (Persona::where('correo', $request->input('email'))->count() == 1) {
            $persona = Persona::where('correo', $request->input('email'))->first();
            return response()->json(['message' => ['persona' => $persona], 'code' => 201], 201);
        } else {
            return response()->json(['message' => ['persona' => null], 'code' => 201], 201);
        }
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
        //Obtener todos los datos del usuario
        $persona = Persona::where("correo", "=", $request->input('email'))->first();

        //Obtener el rol del usuario

        $rol = RolUsuario::where("user_id", "=", auth()->user()->id)->get();
        if ($rol[0]->role_id == 2) {
            $rolDescripcion = "Jefe de estudios";
        } else {
            $rolDescripcion = "Tutor";
        }
        //return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        return response()->json(['message' => ['user' => auth()->user(), 'access_token' => $accessToken, 'datos_user' => $persona, 'rol' => $rolDescripcion], 'code' => 200], 200);
    }

}

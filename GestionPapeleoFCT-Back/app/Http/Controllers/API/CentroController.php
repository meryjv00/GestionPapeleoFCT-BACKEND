<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Centro;
use App\Models\RolUsuario;
use App\Models\User;
use App\Models\Persona;
use Illuminate\Http\Request;

class CentroController extends Controller {

    public function getCentro() {
        if (Centro::first()->count() == 0) {
            return response()->json(['message' => 'error no se encuentra el centro', 'code' => 201], 201);
        }
        $centro = Centro::first();
        return response()->json(['message' => ['centro' => $centro], 'code' => 201], 201);
    }

    public function updateCentro(Request $request) {
        if (Centro::first()->count() == 0) {
            return response()->json(['message' => 'error no se encuentra el centro', 'code' => 201], 201);
        }

        $validatedData = $request->validate([
            'cif' => 'required|primary:centro',
            'email' => 'email|required|unique:centro',
            'tlf' => 'required|unique:centro'
        ]);

        $centro = Centro::first();
        $centro->cif = $validatedData->cif;
        $centro->codigo = $validatedData->codigo;
        $centro->nombre = $validatedData->nombre;
        $centro->localidad = $validatedData->localidad;
        $centro->provincia = $validatedData->provincia;
        $centro->cp = $validatedData->cp;
        $centro->calle = $validatedData->calle;
        $centro->email = $validatedData->email;
        $centro->tlf = $validatedData->tlf;
        $centro->save();

        return response()->json(['message' => 'update correcto', 'code' => 201], 201);
    }

    public function getDirector() {
        if (RolUsuario::where('role_id', 1)->count() == 0) {
            return response()->json(['message' => 'error no se encuentra el director', 'code' => 201], 201);
        }
        $id = RolUsuario::where('role_id', 1)->first();
        $user = User::where('dni', $id->user_dni)->first();
        $nombre = Persona::where('correo', $user->email)->first();
        return response()->json(['message' => ['nombre' => $nombre->nombre . ' ' . $nombre->apellidos, 'email' => $nombre->correo], 'code' => 201], 201);
    }

    public function addJefeEstudios(Request $req) {
        RolUsuario::create([
            'role_id' => 2,
            'user_dni' => $req->input("dniProf")
        ]);
        RolUsuario::where('role_id', 3)->where('user_dni', $req->input("dniProf"))->delete();

        return response()->json(['message' => ['Se ha añadido rol jefe de estudios correctamente'], 'code' => 201], 201);
    }

    /**
     * Obtiene todas las cuentas desactivadas y sin denegar
     * @return type
     */
    public function getCuentasAdministrar() {
        $jefes = \DB::select('SELECT * FROM personas WHERE dni IN (SELECT user_dni FROM role_user WHERE role_id=2)  AND dni IN (SELECT dni from users where activado = 0 and denegado = 0 )');
        $tutores = \DB::select('SELECT * FROM personas WHERE dni IN (SELECT user_dni FROM role_user WHERE role_id=3) AND dni IN (SELECT dni from users where activado = 0 and denegado = 0 )');

        return response()->json(['code' => 200, 'message' => [$jefes, $tutores]]);
    }

    /**
     * Obtiene los tutores con cuentas activas
     * @return type
     */
    public function getTutores() {
        $jefesEstudio = \DB::select('SELECT * FROM personas WHERE dni IN (SELECT user_dni FROM role_user WHERE role_id=3) AND dni IN (SELECT dni from users where activado = 1 )');
        return response()->json(['code' => 200, 'message' => $jefesEstudio]);
    }

    public function cambiarRol(Request $request) {
        if ($request->input('rol') == 2) {
            RolUsuario::where('role_id', 2)->where('user_dni', $request->input('dni'))->delete();
            RolUsuario::create([
                'role_id' => 3,
                'user_dni' => $request->input('dni')
            ]);
        } else {
            RolUsuario::where('role_id', 3)->where('user_dni', $request->input('dni'))->delete();
            RolUsuario::create([
                'role_id' => 2,
                'user_dni' => $request->input('dni')
            ]);
        }
        return response()->json(['code' => 200, 'message' => 'Jefe de estudios deasignado correctamente'], 200);
    }

    public function activarCuenta($dni) {
        $user = User::where('dni', '=', $dni)
                ->get();

        // Si no existe ese curso devolvemos un error.
        if (count($user) == 0) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra usuario con este dni.'])], 404);
        }

        $user[0]->activado = 1;
        $user[0]->save();
        return response()->json($user, 200);
    }

    public function denegarAccesoCuenta($dni) {
        $user = User::where('dni', '=', $dni)
                ->get();

        // Si no existe ese curso devolvemos un error.
        if (count($user) == 0) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra usuario con este dni.'])], 404);
        }

        $user[0]->denegado = 1;
        $user[0]->save();
        return response()->json($user, 200);
    }

}

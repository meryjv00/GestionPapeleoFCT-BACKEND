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

    public function getJefesEstudio() {
        $jefesEstudio = \DB::select('SELECT * FROM personas WHERE dni IN (SELECT user_dni FROM role_user WHERE role_id=2)');
        return response()->json(['code' => 200, 'message' => $jefesEstudio]);
    }

    public function getTutores() {
        $jefesEstudio = \DB::select('SELECT * FROM personas WHERE dni IN (SELECT user_dni FROM role_user WHERE role_id=3)');
        return response()->json(['code' => 200, 'message' => $jefesEstudio]);
    }

    public function deleteJefeEstudio($dniJefe) {
        RolUsuario::where('role_id', 2)->where('user_dni', $dniJefe)->delete();
        RolUsuario::create([
            'role_id' => 3,
            'user_dni' => $dniJefe
        ]);
        return response()->json(['code' => 200, 'message' => 'Jefe de estudios deasignado correctamente'], 200);
    }

}

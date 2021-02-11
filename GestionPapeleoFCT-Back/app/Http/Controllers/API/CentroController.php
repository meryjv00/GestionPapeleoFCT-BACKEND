<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Centro;
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
        $centro = Centro::first();
        $centro->cif = $request->input("cif");
        $centro->codigo = $request->input("codigo");
        $centro->nombre = $request->input("nombre");
        $centro->localidad = $request->input("localidad");
        $centro->provincia = $request->input("provincia");
        $centro->cp = $request->input("cp");
        $centro->calle = $request->input("calle");
        $centro->email = $request->input("email");
        $centro->tlf = $request->input("tlf");
        $centro->save();
        return response()->json(['message' => 'update correcto', 'code' => 201], 201);
    }

}

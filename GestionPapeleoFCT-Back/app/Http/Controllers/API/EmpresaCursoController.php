<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\EmpresaCurso;

class EmpresaCursoController extends Controller
{

    // Método para añadir una nueva empresa a las practicas de un curso
    public function store(Request $request) {
        $empresaCurso = EmpresaCurso::create($request->all());
        if (!$empresaCurso) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido registrar la empresa' . $empresaCurso])], 404);
        }
        return response()->json(['code' => 201, 'message' => 'Datos insertados correctamente'], 201);
    }

    // Método para eliminar una empresa de las practicas de un curso
    public function destroy($idEmpresa,$idCurso){
        $empresaCurso = EmpresaCurso::where('idEmpresa','=',$idEmpresa)->where('idCurso','=',$idCurso)->get();
        
        if (count($empresaCurso) == 0) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra ninguna empresa asociada a ese curso'])], 404);
        }
        $empresaCurso[0]->delete();
        return response()->json(['code' => 200, 'message' => 'La empresa ha sido eliminado del curso'], 200);
    }

}

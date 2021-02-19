<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fct;

class FctController extends Controller
{
    // Método para guardar un alumnos en sus practicas
    public function store(Request $request) {
        $offer = Fct::create($request->all());
    }

    // Método para eliminar un alumno de las practicas
    public function destroy($dniAlumno) {
        $practicas = Fct::where('dniAlumno', $dniAlumno);
        if (!$practicas) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha encontrado ninguna practica relacionada ' . $dniAlumno])], 404);
        }
        $practicas->delete();
        return response()->json(['code' => 200, 'message' => $practicas], 200);
    }
}

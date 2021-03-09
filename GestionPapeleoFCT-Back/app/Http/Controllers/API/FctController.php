<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fct;

class FctController extends Controller
{
    // Método para guardar un alumnos en sus practicas
    public function store(Request $request) {
        $practicas = Fct::create($request->all());
        return response()->json(['code' => 200, 'message' => $practicas]);
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


    // Método para eliminar todos los alumnos con practicas en una empresa
    public static function destroyAlumnosCurso($idEmpresa, $idCurso){
        // DELETE FROM `fct_alumno` WHERE idEmpresa = $idEmpresa AND dniAlumno IN (SELECT dniAlumno FROM `curso_alumno` WHERE idCurso = $idCurso);
        $deleteAlumno = Fct::where('idEmpresa', $idEmpresa)
                            ->whereIn('dniAlumno', function($query) use ($idCurso){
                                $query->select('dniAlumno')
                                      ->from('curso_alumno')
                                      ->where('idCurso', $idCurso);
                        })->delete();
    }

    // Método para ver los datos de las practicas del alumno
    public function getAlumntoFct($dniAlumno){
        $alumnoFct = Fct::where('dniAlumno', '=', $dniAlumno)
                          ->get();
        return response()->json(['code' => 200, 'message' => $alumnoFct]);
    }

    // Método para actualizar las practicas de un alumno
    public function updateAlumnoFct(Request $request, $dniAlumno){
        //Compruebo si existen las practicas
        $Fct = Fct::where('dniAlumno',$dniAlumno)
                    ->get();

        // Si no existe devolvemos un error.
        if (!$Fct) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentran las practicas relacionadas con el alumno.'])], 404);
        }

        // Se actualiza el alumno
        Fct::where('dniAlumno', $dniAlumno)->update($request->all());

        // // // // Se actualizan las practicas
        // $Fct[0]->update([
        //     'dniResponsable' => $request->get('dniResponsable'),
        //     'dniAlumno' => $request->get('dniAlumno'),
        //     'idEmpresa' => $request->get('idEmpresa'),
        //     'horarioDiario' => $request->get('horarioDiario'),
        //     'nHoras' => $request->get('nHoras'),
        //     'fechaComienzo' => $request->get('fechaComienzo'),
        //     'fechaFin' => $request->get('fechaFin'),
        //     'desplazamiento' => $request->get('desplazamiento'),
        //     'semiPresencial' => $request->get('semiPresencial')
        // ]);

        // // //Se actualizan las practicas

        // $Fct[0]->dniResponsable = $request->get('dniResponsable');
        // $Fct[0]->horarioDiario = $request->get('horarioDiario');
        // $Fct[0]->nHoras = $request->get('nHoras');
        // $Fct[0]->fechaComienzo = $request->get('fechaComienzo');
        // $Fct[0]->fechaFin = $request->get('fechaFin');
        // $Fct[0]->desplazamiento = $request->get('desplazamiento');
        // $Fct[0]->semiPresencial = $request->get('semiPresencial');
        // $Fct[0]->save();

        return response()->json($request, 200);
    }

}

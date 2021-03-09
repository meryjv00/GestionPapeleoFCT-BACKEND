<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\CursoAlumno;

class CursosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Todos los cursos incluyendo los datos del tutor
        $cursos = Curso::with('cursos')->get();
        return response()->json(['code' => 200, 'message' => $cursos]);
    }

    public function index2($dniTutor) {
        //Los cursos pertenecientes a un tutor incluyendo los datos del tutor
        $cursos = Curso::where('dniTutor', '=', $dniTutor)
                ->with('cursos')
                ->get();
        return response()->json(['code' => 200, 'message' => $cursos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $curso = Curso::create($request->all());
        if (!$curso) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido registrar la empresa ' . $curso])], 404);
        }
        return response()->json(['code' => 201, 'message' => 'Datos insertados correctamente'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //Compruebo si el curso ya existe
        $curso = Curso::find($id);

        // Si no existe ese curso devolvemos un error.
        if (!$curso) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra ese curso con ese código.'])], 404);
        }

        // Se actualiza el curso
        $curso->update([
            'cicloFormativo' => $request->input('curso')['cicloFormativo'],
            'cicloFormativoA' => $request->input('curso')['cicloFormativoA'],
            'familiaProfesional' => $request->input('curso')['familiaProfesional'],
            'cursoAcademico' => $request->input('curso')['cursoAcademico'],
            'nHoras' => $request->input('curso')['nHoras']
        ]);
        return response()->json($curso, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $destroy = Curso::destroy($id);
        if (!$destroy) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido eliminar el curso ' . $id])], 404);
        } else {
            return response()->json(['code' => 201, 'message' => 'Curso eliminado correctamente'], 201);
        }
    }

    /**
     * Metodo para obtener las familias profesionales de los cursos
     */
    public function getFamilies() {
        $families = Curso::select('familiaProfesional')
                ->distinct()
                ->get();
        return response()->json(['code' => 200, 'message' => $families]);
    }

    public function addTutorCurso(Request $request, $idCurso) {
        $curso = Curso::find($idCurso);

        // Si no existe ese curso devolvemos un error.
        if (!$curso) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra ese curso con ese código.'])], 404);
        }

        $curso->update([
            'cicloFormativo' => $request->input('curso')['cicloFormativo'],
            'cicloFormativoA' => $request->input('curso')['cicloFormativoA'],
            'dniTutor' => $request->input('dniProfesor'),
            'familiaProfesional' => $request->input('curso')['familiaProfesional'],
            'cursoAcademico' => $request->input('curso')['cursoAcademico'],
            'nHoras' => $request->input('curso')['nHoras']
        ]);

        return response()->json($curso, 200);
    }

    public function cursosSinTutor() {
        $director = \DB::select('SELECT * FROM personas WHERE dni IN (SELECT user_dni FROM role_user WHERE role_id=1)');
        $cursos = Curso::with('cursos')
                ->where('dniTutor', '=', $director[0]->dni)
                ->get();
        return response()->json(['code' => 200, 'message' => $cursos]);
    }

    public function cursosSinAlumnos() {
        $cursos = \DB::select('SELECT * FROM cursos where id not in(select DISTINCT idCurso FROM curso_alumno)');
        return response()->json(['code' => 200, 'message' => $cursos]);
    }

    public function reiniciarAlumnos() {
        \DB::delete('delete from personas  where dni in (select user_dni from role_user where role_id=?)', [4]);
        return response()->json(['code' => 200, 'message' => 'Alumnos borrados correctamente']);
    }

    public function updateAnio(Request $request) {
        \DB::table('cursos')
                ->update(['cursoAcademico' => $request->get('anio')]);
        
        return response()->json(['code' => 200, 'message' => 'Año actualizado correctamente']);
    }

}

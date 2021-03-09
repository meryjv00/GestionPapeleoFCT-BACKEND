<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\CursoAlumno;
use App\Models\Fct;

class PersonaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req) {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idCurso) {
        //Personas de un curso
        //$personas = Persona::all();
        $personas = CursoAlumno::with(['cursos', 'alumnos'])
                ->where('idCurso', '=', $idCurso)
                ->get();

        return response()->json(['code' => 200, 'message' => $personas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $idCurso = $request->input('curso');
        $persona = $request->input('alumno');

        //return response()->json(['code' => 201, 'message' => $persona['apellidos']], 201);
        //Crear alumno
        $personaBD = Persona::create([
                    'dni' => $persona['dni'],
                    'apellidos' => $persona['apellidos'],
                    'nombre' => $persona['nombre'],
                    'localidad' => $persona['localidad'],
                    'residencia' => $persona['residencia'],
                    'correo' => $persona['correo'],
                    'tlf' => $persona['telefono'],
                    'foto' => 0,
        ]);
        if (!$personaBD) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido registrar al usuario ' . $persona])], 404);
        }
        //Asignar alumno a curso
        $cursoAlumno = new CursoAlumno();
        $cursoAlumno->idCurso = $idCurso;
        $cursoAlumno->dniAlumno = $persona['dni'];
        $cursoAlumno->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados correctamente', 'alumno' => $personaBD], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idAlumno) {
        $persona = Persona::find($idAlumno);
        if (!$persona) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra ninguna persona con este dni ' . $idAlumno])], 404);
        }
        //$persona->update($request->all());
        $persona->update([
            'dni' => $request->input('alumno')['dni'],
            'nombre' => $request->input('alumno')['nombre'],
            'apellidos' => $request->input('alumno')['apellidos'],
            'localidad' => $request->input('alumno')['localidad'],
            'residencia' => $request->input('alumno')['residencia'],
            'correo' => $request->input('alumno')['correo'],
            'tlf' => $request->input('alumno')['telefono'],
        ]);
        //return response()->json(['status'=>'ok','data'=>$fabricante],200);
        return response()->json($persona, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idAlumno) {
        $persona = Persona::find($idAlumno);
        if (!$persona) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se encuentra ninguna persona con este id ' . $idAlumno])], 404);
        }
        $persona->delete();
        return response()->json(['code' => 200, 'message' => 'Persona borrada'], 200);
    }

    public function getProfesores() {
        $profesores = \DB::select('SELECT * FROM personas WHERE dni IN (SELECT user_dni FROM role_user WHERE role_id=5)');

        return response()->json(['code' => 200, 'message' => $profesores]);
    }

    // Método que devuelve los alumnos de un curso que tienen empresa para las practicas
    public function alumnosCursoSinEmpresa($idCurso) {

        // SELECT * FROM personas p INNER JOIN curso_alumno ca ON p.dni = ca.dniAlumno WHERE ca.idCurso = $idCurso AND p.dni NOT IN (SELECT dniAlumno FROM fct_alumno);

        $personas = Persona::join('curso_alumno', 'personas.dni', '=', 'curso_alumno.dniAlumno',)
                        ->where('curso_alumno.idCurso', $idCurso)
                        ->whereNotIn('personas.dni', function($query) {
                            $query->select('dniAlumno')->from('fct_alumno');
                        })->get();

        return response()->json(['code' => 200, 'message' => $personas]);
    }

    // Método para seleccioanr los alumnos en practicas en una empresa
    public function alumnosCursoPracticas($idCurso, $idEmpresa) {
        // SELECT * FROM personas p INNER JOIN curso_alumno ca ON p.dni = ca.dniAlumno WHERE ca.idCurso = $idCurso AND p.dni IN (SELECT dniAlumno FROM fct_alumno WHERE idEmpresa = $idEmpresa);
        $personas = Persona::join('curso_alumno', 'personas.dni', '=', 'curso_alumno.dniAlumno',)
                        ->where('curso_alumno.idCurso', $idCurso)
                        ->whereIn('personas.dni', function($query) use ($idEmpresa) {
                            $query->select('dniAlumno')
                            ->from('fct_alumno')
                            ->where('idEmpresa', $idEmpresa);
                        })->get();

        foreach ($personas as $persona) {
            $desplazamiento = Fct::where('dniAlumno', 'LIKE', $persona->dni)->first();
            $persona['desplazamiento'] = $desplazamiento->desplazamiento;
        }

        return response()->json(['code' => 200, 'message' => $personas]);
    }

    public function cambiarFoto(Request $request, $dni) {
        $request->file('img')->storeAs('', $dni . '.png', 'daniel');
        //bd actualizar
        $persona = Persona::where('dni', '=', $dni)->get();

        if (count($persona) >= 1) {
            $persona[0]->foto = 1;
            // Guardamos en base de datos
            $persona[0]->save();
        }
        return response()->json(['code' => 201, 'message' => $persona[0]], 201);
    }

}

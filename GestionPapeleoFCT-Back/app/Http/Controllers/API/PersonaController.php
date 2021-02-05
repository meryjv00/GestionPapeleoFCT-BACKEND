<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\CursoAlumno;

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
        ]);
        if (!$personaBD) {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'No se ha podido registrar al usuario ' . $persona])], 404);
        }
        //Asignar alumno a curso
        $cursoAlumno = new CursoAlumno();
        $cursoAlumno->idCurso = $idCurso;
        $cursoAlumno->dniAlumno = $persona['dni'];
        $cursoAlumno->save();

        return response()->json(['code' => 201, 'message' => 'Datos insertados correctamente'], 201);
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

}

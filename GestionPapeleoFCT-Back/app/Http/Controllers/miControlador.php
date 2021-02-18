<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Persona;
use App\Models\RolUsuario;
use App\Models\User;
use App\Models\CursoAlumno;

class miControlador extends Controller {

    public function vistaImports() {
        $cursos = Curso::all();
        session()->put('cursos', $cursos);
        $cursoSeleccionado = Curso::find(1);
        $datos = [
            'cursos' => $cursos,
            'cursoSeleccionado' => $cursoSeleccionado
        ];
        return view('importarCSV', $datos);
    }

    public function cambiaCurso(Request $request) {
        $cursoSelecc = $request->get('select_cursos');
        $cursoSeleccionado = Curso::find($cursoSelecc);
        $cursos = session()->get('cursos');
        $datos = [
            'cursos' => $cursos,
            'cursoSeleccionado' => $cursoSeleccionado
        ];
        return view('importarCSV', $datos);
    }

    /**
     * Rellena la BD con los alumnos que recuperamos del archivo csv
     * @param Request $request 
     * idCursoSeleccionado: asignar alumnos al curso
     * cicloCursoSeleccionado: nombrar al archivo
     */
    public function subirAlumnos(Request $request) {
        $idCursoSeleccionado = $request->get('idCursoSeleccionado');
        $cicloCursoSeleccionado = $request->get('cicloCursoSeleccionado');

        $request->file('alumnos')->storeAs('public/CSV/', $cicloCursoSeleccionado . '.csv');

        $ruta = 'app\public\CSV\\' . $cicloCursoSeleccionado . '.csv';
        $path = \storage_path($ruta);
        $lines = file($path);
        $utf8_lines = array_map('utf8_decode', $lines);
        $array = array_map('str_getcsv', $utf8_lines);

        //Insertar alumnos
        for ($i = 1; $i < count($array); $i++) {
            $apellidos = explode(",", $array[$i][1]);
            $nombre = explode(",", $array[$i][2]);
            $dni = explode(",", $array[$i][4]);
            $localidad = explode(",", $array[$i][11]);
            $residencia = explode(",", $array[$i][10]);
            $correo = explode(",", $array[$i][22]);
            $tlf = explode(",", $array[$i][13]);
            Persona::create([
                'dni' => $dni[0],
                'apellidos' => $apellidos[0],
                'nombre' => $nombre[0],
                'localidad' => $localidad[0],
                'residencia' => $residencia[0],
                'correo' => $correo[0],
                'tlf' => $tlf[0]
            ]);
            RolUsuario::create([
                'role_id' => 4,
                'user_dni' => $dni[0]
            ]);
            CursoAlumno::create([
                'idCurso' => $idCursoSeleccionado,
                'dniAlumno' => $dni[0]
            ]);
        }

        $cursos = session()->get('cursos');
        $cursoSeleccionado = Curso::find(1);
        $datos = [
            'cursos' => $cursos,
            'cursoSeleccionado' => $cursoSeleccionado
        ];
        return view('importarCSV', $datos);
    }

    public function subirProfesores(Request $request) {
        //Recibimos los archivos y lo guardamos en la carpeta storage/app/public
        $request->file('profesores')->storeAs('public/CSV/', 'Profesores.csv');

        //Insertar profesores
        $path = \storage_path('app\public\CSV\Profesores.csv');
        $lines = file($path);
        $utf8_lines = array_map('utf8_decode', $lines);
        $array = array_map('str_getcsv', $utf8_lines);

        for ($i = 1; $i < count($array); $i++) {
            $apellidos = explode(",", $array[$i][1]);
            $nombre = explode(",", $array[$i][2]);
            $dni = explode(",", $array[$i][4]);
            $localidad = explode(",", $array[$i][10]);
            $residencia = explode(",", $array[$i][9]);
            $correo = explode(",", $array[$i][19]);
            $tlf = explode(",", $array[$i][20]);

            Persona::create([
                'dni' => $dni[0],
                'apellidos' => $apellidos[0],
                'nombre' => $nombre[0],
                'localidad' => $localidad[0],
                'residencia' => $residencia[0],
                'correo' => $correo[0],
                'tlf' => $tlf[0]
            ]);
            RolUsuario::create([
                'role_id' => 5,
                'user_dni' => $dni[0]
            ]);
        }

        $cursos = session()->get('cursos');
        $cursoSeleccionado = Curso::find(1);
        $datos = [
            'cursos' => $cursos,
            'cursoSeleccionado' => $cursoSeleccionado
        ];
        return view('importarCSV', $datos);
    }

}

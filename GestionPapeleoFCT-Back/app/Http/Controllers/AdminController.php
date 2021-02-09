<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Persona;
use App\Models\RolUsuario;

class AdminController extends Controller {

    function insertCursos() {
        $path = public_path('csv/datUnidades.csv');
        $lines = file($path);
        $utf8_lines = array_map('utf8_encode', $lines);
        $array = array_map('str_getcsv', $utf8_lines);

        for ($i = 1; $i < count($array); $i++) {
            $familiaProfesional = explode(",", $array[$i][2]);
            $cicloFormativo = explode(",", $array[$i][3]);
            $cicloFormativoA = explode(",", $array[$i][1]);
            Curso::create([
                'dniTutor' => '3C',
                'familiaProfesional' => $familiaProfesional[0],
                'cicloFormativo' => $cicloFormativo[0],
                'cicloFormativoA' => $cicloFormativoA[0],
                'cursoAcademico' => '2020/2021',
                'nHoras' => 400
            ]);
        }

        return response()->json(['code' => 201, 'message' => 'Datos insertados correctamente'], 201);
    }

    function insertAlumnos() {
        $path2 = public_path('csv/datAlumnos.csv');
        $lines2 = file($path2);
        $utf8_lines2 = array_map('utf8_decode', $lines2);
        $array2 = array_map('str_getcsv', $utf8_lines2);

        for ($i = 1; $i < count($array2); $i++) {
            $apellidos = explode(",", $array2[$i][1]);
            $nombre = explode(",", $array2[$i][2]);
            $dni = explode(",", $array2[$i][4]);
            $localidad = explode(",", $array2[$i][11]);
            $residencia = explode(",", $array2[$i][10]);
            $correo = explode(",", $array2[$i][22]);
            $tlf = explode(",", $array2[$i][13]);

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
        }
        
        return response()->json(['code' => 201, 'message' => 'Datos insertados correctamente'], 201);
    }

    function insertProfesores() {
        $path = public_path('csv/datProfesores.csv');
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
    }

}

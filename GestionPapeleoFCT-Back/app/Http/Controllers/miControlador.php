<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Persona;
use App\Models\RolUsuario;
use App\Models\User;
use App\Models\CursoAlumno;

class miControlador extends Controller {

    public function subirCSV(Request $request) {
        //Recibimos los archivos y lo guardamos en la carpeta storage/app/public
        $request->file('profesores')->storeAs('public/CSV', 'Profesores.csv');
        $request->file('alumnos2DAW')->storeAs('public/CSV', 'Alumnos_2DAW.csv');
        $request->file('alumnos2DAM')->storeAs('public/CSV', 'Alumnos_2DAM.csv');
        $request->file('alumnos2ASIR')->storeAs('public/CSV', 'Alumnos_2ASIR.csv');

        //Contraseña inicial de las cuentas
        $contra = '12345678';

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

            //Insertar alumnos
            //2DAW
            $path = \storage_path('app\public\CSV\Alumnos_2DAW.csv');
            $lines = file($path);
            $utf8_lines = array_map('utf8_decode', $lines);
            $array = array_map('str_getcsv', $utf8_lines);

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
                    'idCurso' => 13,
                    'dniAlumno' => $dni[0]
                ]);
            }
            //2DAM
            $path = \storage_path('app\public\CSV\Alumnos_2DAM.csv');
            $lines = file($path);
            $utf8_lines = array_map('utf8_decode', $lines);
            $array = array_map('str_getcsv', $utf8_lines);

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
                    'idCurso' => 11,
                    'dniAlumno' => $dni[0]
                ]);
            }
            //2ASIR
            $path = \storage_path('app\public\CSV\Alumnos_2ASIR.csv');
            $lines = file($path);
            $utf8_lines = array_map('utf8_decode', $lines);
            $array = array_map('str_getcsv', $utf8_lines);

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
                    'idCurso' => 8,
                    'dniAlumno' => $dni[0]
                ]);
            }

            return redirect('http://localhost:4200/admin');
        }
    }

}

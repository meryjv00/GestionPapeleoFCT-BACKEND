<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\RolUsuario;
use App\Models\CursoAlumno;

class AlumnosSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //------------------------------------------
        //----------------TODOS ALUMNOS-------------
        //------------------------------------------
//        $path2 = public_path('csv/datAlumnos.csv');
//        $lines2 = file($path2);
//        $utf8_lines2 = array_map('utf8_decode', $lines2);
//        $array2 = array_map('str_getcsv', $utf8_lines2);
//
//        for ($i = 1; $i < count($array2); $i++) {
//            $apellidos = explode(",", $array2[$i][1]);
//            $nombre = explode(",", $array2[$i][2]);
//            $dni = explode(",", $array2[$i][4]);
//            $localidad = explode(",", $array2[$i][11]);
//            $residencia = explode(",", $array2[$i][10]);
//            $correo = explode(",", $array2[$i][22]);
//            $tlf = explode(",", $array2[$i][13]);
//
//            Persona::create([
//                'dni' => $dni[0],
//                'apellidos' => $apellidos[0],
//                'nombre' => $nombre[0],
//                'localidad' => $localidad[0],
//                'residencia' => $residencia[0],
//                'correo' => $correo[0],
//                'tlf' => $tlf[0]
//            ]);
//            RolUsuario::create([
//                'role_id' => 4,
//                'user_dni' => $dni[0]
//            ]);
//        }
        //----------------------------------------------
        //-------------ASIGNACION ALUMNOS--------------
        
        //-----------------2ASIR---------------------
//        $path = public_path('csv/datAlumnos_2ASIR.csv');
//        $lines = file($path);
//        $utf8_lines = array_map('utf8_decode', $lines);
//        $array = array_map('str_getcsv', $utf8_lines);
//
//        for ($i = 1; $i < count($array); $i++) {
//            $apellidos = explode(",", $array[$i][1]);
//            $nombre = explode(",", $array[$i][2]);
//            $dni = explode(",", $array[$i][4]);
//            $localidad = explode(",", $array[$i][11]);
//            $residencia = explode(",", $array[$i][10]);
//            $correo = explode(",", $array[$i][22]);
//            $tlf = explode(",", $array[$i][13]);
//
//            Persona::create([
//                'dni' => $dni[0],
//                'apellidos' => $apellidos[0],
//                'nombre' => $nombre[0],
//                'localidad' => $localidad[0],
//                'residencia' => $residencia[0],
//                'correo' => $correo[0],
//                'tlf' => $tlf[0]
//            ]);
//            RolUsuario::create([
//                'role_id' => 4,
//                'user_dni' => $dni[0]
//            ]);
////            CursoAlumno::create([
////                'idCurso' => 8,
////                'dniAlumno' => $dni[0]
////            ]);
//        }
        
        //-----------------2DAM---------------------
//        $path = public_path('csv/datAlumnos_2DAM.csv');
//        $lines = file($path);
//        $utf8_lines = array_map('utf8_decode', $lines);
//        $array = array_map('str_getcsv', $utf8_lines);
//
//        for ($i = 1; $i < count($array); $i++) {
//            $apellidos = explode(",", $array[$i][1]);
//            $nombre = explode(",", $array[$i][2]);
//            $dni = explode(",", $array[$i][4]);
//            $localidad = explode(",", $array[$i][11]);
//            $residencia = explode(",", $array[$i][10]);
//            $correo = explode(",", $array[$i][22]);
//            $tlf = explode(",", $array[$i][13]);
//
//            Persona::create([
//                'dni' => $dni[0],
//                'apellidos' => $apellidos[0],
//                'nombre' => $nombre[0],
//                'localidad' => $localidad[0],
//                'residencia' => $residencia[0],
//                'correo' => $correo[0],
//                'tlf' => $tlf[0]
//            ]);
//            RolUsuario::create([
//                'role_id' => 4,
//                'user_dni' => $dni[0]
//            ]);
////            CursoAlumno::create([
////                'idCurso' => 11,
////                'dniAlumno' => $dni[0]
////            ]);
//        }
        //-----------------2DAW---------------------
//        $path = public_path('csv/datAlumnos_2DAW.csv');
//        $lines = file($path);
//        $utf8_lines = array_map('utf8_decode', $lines);
//        $array = array_map('str_getcsv', $utf8_lines);
//
//        for ($i = 1; $i < count($array); $i++) {
//            $apellidos = explode(",", $array[$i][1]);
//            $nombre = explode(",", $array[$i][2]);
//            $dni = explode(",", $array[$i][4]);
//            $localidad = explode(",", $array[$i][11]);
//            $residencia = explode(",", $array[$i][10]);
//            $correo = explode(",", $array[$i][22]);
//            $tlf = explode(",", $array[$i][13]);
//
//            Persona::create([
//                'dni' => $dni[0],
//                'apellidos' => $apellidos[0],
//                'nombre' => $nombre[0],
//                'localidad' => $localidad[0],
//                'residencia' => $residencia[0],
//                'correo' => $correo[0],
//                'tlf' => $tlf[0]
//            ]);
//            RolUsuario::create([
//                'role_id' => 4,
//                'user_dni' => $dni[0]
//            ]);
////            CursoAlumno::create([
////                'idCurso' => 13,
////                'dniAlumno' => $dni[0]
////            ]);
//        }


    }

}

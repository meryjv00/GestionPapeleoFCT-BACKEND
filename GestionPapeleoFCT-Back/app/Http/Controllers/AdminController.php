<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\RolUsuario;
use App\Models\CursoAlumno;

class AdminController extends Controller {

    function insertProfesores(Request $request) {
        //Si algun usuario ya ha creado cuenta no se podrán insertar de nuevo, ya que se perderían los roles del registro
        $pers = \DB::select('SELECT * from personas where dni in (select user_dni from role_user where role_id=? or role_id=?)', [3,2]);
        if(count($pers) > 0){
            return response()->json(['code' => 201, 'message' => 'No es posible reinsertar los profesores, ya que hay cuentas creadas asociadas'], 201);
        }
            
        //Vaciar profesores
        \DB::delete('DELETE from personas where dni in (select user_dni from role_user where role_id=?)', [5]);

        //Insertar profesores
        $request->file('csv')->storeAs('public/CSV/', 'Profesores.csv');
        $path = \storage_path('app/public/CSV/Profesores.csv');
        $lines = file($path);
        $utf8_lines = array_map('utf8_encode', $lines);
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
                'tlf' => $tlf[0],
                'foto' => 0
            ]);
            RolUsuario::create([
                'role_id' => 5,
                'user_dni' => $dni[0]
            ]);
        }
        return response()->json(['code' => 201, 'message' => 'Profesores insertados correctamente.'], 201);
    }

    function insertAlumnos(Request $request,$idCurso, $cicloCurso) {        
        //Vaciar alumnos correspondientes al curso seleccionado
        \DB::delete('delete from personas  where dni in (select dniAlumno from curso_alumno where idCurso=?)', [$idCurso]);
        
        //Insertar alumnos correspondientes al curso seleccionado   
        $request->file('csv')->storeAs('public/CSV/', $cicloCurso . '.csv');
        $ruta = 'app/public/CSV/' . $cicloCurso . '.csv';
        $path = \storage_path($ruta);
        $lines = file($path);
        $utf8_lines = array_map('utf8_encode', $lines);
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
                'tlf' => $tlf[0],
                'foto' => 0
            ]);
            RolUsuario::create([
                'role_id' => 4,
                'user_dni' => $dni[0]
            ]);
            CursoAlumno::create([
                'idCurso' => $idCurso, 
                'dniAlumno' => $dni[0]
            ]);
        }

        return response()->json(['code' => 201, 'message' => 'Alumnos insertados correctamente'], 201);
    }

}

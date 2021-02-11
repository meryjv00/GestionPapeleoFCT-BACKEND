<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Models\RolUsuario;
use App\Models\User;

class ProfesoresSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //DIRECTOR DEL CENTRO
        $contra = '12345678';
        User::create([
            'dni' => '0X',
            'email' => 'director@gmail.com',
            'password' => \Hash::make($contra)
        ]);
        Persona::create([
            'dni' => '0X',
            'apellidos' => 'apellido1 apellido2',
            'nombre' => 'nombre',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'director@gmail.com',
            'tlf' => '999999999'
        ]);
//        RolUsuario::create([
//            'role_id' => 5,
//            'user_dni' => '0X'
//        ]);
        RolUsuario::create([
            'role_id' => 1,
            'user_dni' => '0X'
        ]);


        //-----------------------------------------------------------------------
        //-----------PROFESORES / TUTORES / DIRECTOR / JEFE DE ESTUDIOS----------
        //-----------------------------------------------------------------------
//        $path = public_path('csv/datProfesores.csv');
//        $lines = file($path);
//        $utf8_lines = array_map('utf8_decode', $lines);
//        $array = array_map('str_getcsv', $utf8_lines);
//
//        for ($i = 1; $i < count($array); $i++) {
//            $apellidos = explode(",", $array[$i][1]);
//            $nombre = explode(",", $array[$i][2]);
//            $dni = explode(",", $array[$i][4]);
//            $localidad = explode(",", $array[$i][10]);
//            $residencia = explode(",", $array[$i][9]);
//            $correo = explode(",", $array[$i][19]);
//            $tlf = explode(",", $array[$i][20]);
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
//                'role_id' => 5,
//                'user_dni' => $dni[0]
//            ]);
//
//            //Director -> Rol 1: Director
//            if ($dni[0] == '05664525Q') {
//                RolUsuario::create([
//                    'role_id' => 1,
//                    'user_dni' => $dni[0]
//                ]);
//            }
//
//            //Jefe de estudios -> Rol 2: Jefe de estudios
//            if ($dni[0] == '05679252T') {
//                RolUsuario::create([
//                    'role_id' => 2,
//                    'user_dni' => $dni[0]
//                ]);
//                User::create([
//                    'dni' => $dni[0],
//                    'email' => $correo[0],
//                    'password' => \Hash::make($contra)
//                ]);
//            }
//
//        }
    }

}

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
            'dni' => '99999999X',
            'email' => 'director@gmail.com',
            'password' => \Hash::make($contra),
            'activado' => 1
        ]);
        Persona::create([
            'dni' => '99999999X',
            'apellidos' => 'apellidouno apellidodos',
            'nombre' => 'nombre',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'director@gmail.com',
            'tlf' => '999999999',
            'foto' => 0      
        ]);
        RolUsuario::create([
            'role_id' => 1,
            'user_dni' => '99999999X'
        ]);


        //-----------------------------------------------------------------------
        //-----------PROFESORES / TUTORES / DIRECTOR / JEFE DE ESTUDIOS----------
        //-----------------------------------------------------------------------
//        $path = public_path('csv/datProfesores.csv');
//        $lines = file($path);
//        $utf8_lines = array_map('utf8_encode', $lines);
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
//        }
    }

}

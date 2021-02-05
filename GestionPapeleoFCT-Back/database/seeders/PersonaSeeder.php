<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persona;
use App\Clases\PersonaC;

class PersonaSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //TUTORES Y JEFES DE ESTUDIO
        Persona::create([
            'dni' => '1A',
            'apellidos' => 'Gómez Aranzabe',
            'nombre' => 'Fernando D.',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'fernando@gmail.com',
            'tlf' => '678979898'
        ]);
        Persona::create([
            'dni' => '2B',
            'apellidos' => 'Gijón Cardos',
            'nombre' => 'Inmaculada',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'inma@gmail.com',
            'tlf' => '768984521'
        ]);
        Persona::create([
            'dni' => '3C',
            'apellidos' => 'Córdoba Aguirre',
            'nombre' => 'Diego',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'diego@gmail.com',
            'tlf' => '679094587'
        ]);
        Persona::create([
            'dni' => '4D',
            'apellidos' => 'González Sánchez',
            'nombre' => 'Jose Luis',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'joseluis@gmail.com',
            'tlf' => '767578798'
        ]);
        Persona::create([
            'dni' => '00',
            'apellidos' => 'Lopez Lopez',
            'nombre' => 'Sra Directora',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'directora@gmail.com',
            'tlf' => '000000000'
        ]);

        //ALUMNOS
        Persona::create([
            'dni' => '99999999A',
            'apellidos' => 'Juan Viñas',
            'nombre' => 'María',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'maria@gmail.com',
            'tlf' => '999999999'
        ]);
        Persona::create([
            'dni' => '88888888B',
            'apellidos' => 'Sanchez Checa',
            'nombre' => 'Daniel',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'daniel@gmail.com',
            'tlf' => '888888888'
        ]);
        Persona::create([
            'dni' => '77777777C',
            'apellidos' => 'Susin Susin',
            'nombre' => 'Sergio',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'sergio@gmail.com',
            'tlf' => '777777777'
        ]);
        Persona::create([
            'dni' => '66666666D',
            'apellidos' => 'Rodri Rodri',
            'nombre' => 'Rodrigo',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'rodrigo@gmail.com',
            'tlf' => '666666666'
        ]);
        Persona::create([
            'dni' => '55555555E',
            'apellidos' => 'Gomez Gomez',
            'nombre' => 'Sara',
            'localidad' => 'Puertollano',
            'residencia' => 'Puertollano',
            'correo' => 'sara@gmail.com',
            'tlf' => '555555555'
        ]);
    }

}

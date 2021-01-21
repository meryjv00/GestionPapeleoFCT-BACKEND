<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new \App\Models\Role;
        $rol->id = '1';
        $rol->nombre = 'Director';
        $rol->save();

        $rol = new \App\Models\Role;
        $rol->id = '2';
        $rol->nombre = 'JefeEstudios';
        $rol->save();

        $rol = new \App\Models\Role;
        $rol->id = '3';
        $rol->nombre = 'Tutor';
        $rol->save();

        $rol = new \App\Models\Role;
        $rol->id = '4';
        $rol->nombre = 'Alumno';
        $rol->save();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        //$this->call(RolesSeeder::class);
        $this->call([
            RolesSeeder::class,
            AnexosSeeder::class,
            UserSeeder::class,
            UserRolSeeder::class,
            PersonaSeeder::class,
            CursosSeeder::class,
            CursoAlumnos::class,
            EmpresasSeeder::class
        ]);
    }

}

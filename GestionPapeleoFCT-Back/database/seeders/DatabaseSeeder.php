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
            ProfesoresSeeder::class,
            CursosSeeder::class,
            AlumnosSeeder::class,
            EmpresasSeeder::class,
            CentroSeeder::class
        ]);
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Centro;

class CentroSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Centro::create([
            'codigo' => '13002691',
            'nombre' => 'CIFP Virgen de Gracia',
            'provincia' => 'Ciudad Real',
            'localidad' => 'Puertollano',
            'calle' => 'Paseo de San Gregorio, 82b',
            'cp' => '13500',
            'cif' => 'S1300166D',
            'tlf' => '926426250',
            'email' => 'cifpvirgendegracia@gmail.com'
        ]);
    }

}

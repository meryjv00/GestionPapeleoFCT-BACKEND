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
            'codigo' => '11111X',
            'nombre' => 'CIFP Virgen de Gracia',
            'provincia' => 'Ciudad Real',
            'localidad' => 'Puertollano',
            'calle' => 'Calle Manzana',
            'cp' => '13570',
            'cif' => '11111',
            'tlf' => '999999999',
            'email' => 'cifpvirgendegracia@gmail.com'
        ]);
    }

}

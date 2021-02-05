<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;
use App\Models\EmpresaPerfiles;

class EmpresasSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Empresa::create([
            'nombre' => 'Indra',
            'provincia' => 'Ciudad Real',
            'localidad' => 'Ciudad Real',
            'calle' => 'Calle x',
            'cp' => '1111',
            'cif' => '1111',
            'tlf' => '999999999',
            'email' => 'indra@gmail.com'
        ]);
        EmpresaPerfiles::create([
            'idEmpresa' => 1,
            'nombreRepresentante' => 'Indra_Rep1',
            'nombreResponsable' => 'Indra_Resp1'
        ]);
        Empresa::create([
            'nombre' => 'Enova',
            'provincia' => 'Ciudad Real',
            'localidad' => 'Ciudad Real',
            'calle' => 'Calle y',
            'cp' => '2222',
            'cif' => '2222',
            'tlf' => '888888888',
            'email' => 'enova@gmail.com'
        ]);
        EmpresaPerfiles::create([
            'idEmpresa' => 2,
            'nombreRepresentante' => 'Enova_Rep1',
            'nombreResponsable' => 'Enova_Resp1'
        ]);

        Empresa::create([
            'nombre' => 'Everis',
            'provincia' => 'Ciudad Real',
            'localidad' => 'Ciudad Real',
            'calle' => 'Calle z',
            'cp' => '3333',
            'cif' => '3333',
            'tlf' => '777777777',
            'email' => 'everis@gmail.com'
        ]);
        EmpresaPerfiles::create([
            'idEmpresa' => 3,
            'nombreRepresentante' => 'Everis_Rep1',
            'nombreResponsable' => 'Everis_Resp1'
        ]);
    }

}

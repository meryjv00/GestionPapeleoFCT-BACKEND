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
            'calle' => 'Ronda de Toledo, s/n',
            'cp' => '13005',
            'cif' => 'B84065820',
            'tlf' => '926270800',
            'email' => 'indra@indra.es',
            'dniRepresentante' => '11',
            'nombreRepresentante' => 'Indra_Rep'
        ]);
        EmpresaPerfiles::create([
            'idEmpresa' => 1,
            'dniResponsable' => '22',
            'nombreResponsable' => 'Indra_Resp1'
        ]);
        Empresa::create([
            'nombre' => 'Enova',
            'provincia' => 'Ciudad Real',
            'localidad' => 'Ciudad Real',
            'calle' => 'Ronda del Carmen, 21',
            'cp' => '2222',
            'cif' => '2222',
            'tlf' => '926921363',
            'email' => 'enova@gmail.com',
            'dniRepresentante' => '33',
            'nombreRepresentante' => 'Enova_Rep'
        ]);
        EmpresaPerfiles::create([
            'idEmpresa' => 2,
            'dniResponsable' => '44',
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
            'email' => 'everis@gmail.com',
            'dniRepresentante' => '55',
            'nombreRepresentante' => 'Everis_Rep'
        ]);
        EmpresaPerfiles::create([
            'idEmpresa' => 3,
            'dniResponsable' => '66',
            'nombreResponsable' => 'Everis_Resp1'
        ]);
        EmpresaPerfiles::create([
            'idEmpresa' => 3,
            'dniResponsable' => '77',
            'nombreResponsable' => 'Everis_Resp2'
        ]);
    }

}

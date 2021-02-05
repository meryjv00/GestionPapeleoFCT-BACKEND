<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursosSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Curso::create([
            'dniTutor' => '3C',
            'familiaProfesional' => 'Informática',
            'cicloFormativo' => 'Desarrollo de aplicaciones web',
            'cicloFormativoA' => 'DAW',
            'cursoAcademico' => '2020/2021',
            'nHoras' => '400'
        ]);
        Curso::create([
            'dniTutor' => '3C',
            'familiaProfesional' => 'Informática',
            'cicloFormativo' => 'Desarrollo de aplicaciones multiplataforma',
            'cicloFormativoA' => 'DAM',
            'cursoAcademico' => '2020/2021',
            'nHoras' => '410'
        ]);
        Curso::create([
            'dniTutor' => '4D',
            'familiaProfesional' => 'Informática',
            'cicloFormativo' => 'Administración de sistemas informáticos en red',
            'cicloFormativoA' => 'ASIR',
            'cursoAcademico' => '2020/2021',
            'nHoras' => '390'
        ]);
    }

}

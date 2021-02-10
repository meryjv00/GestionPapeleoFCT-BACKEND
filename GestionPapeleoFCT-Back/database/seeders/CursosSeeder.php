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
        $path = public_path('csv/datUnidades.csv');
        $lines = file($path);
        $utf8_lines = array_map('utf8_encode', $lines);
        $array = array_map('str_getcsv', $utf8_lines);

        for ($i = 1; $i < count($array); $i++) {
            $familiaProfesional = explode(",", $array[$i][2]);
            $cicloFormativo = explode(",", $array[$i][3]);
            $cicloFormativoA = explode(",", $array[$i][1]);
            Curso::create([
                'dniTutor' => '0X',
                'familiaProfesional' => $familiaProfesional[0],
                'cicloFormativo' => $cicloFormativo[0],
                'cicloFormativoA' => $cicloFormativoA[0],
                'cursoAcademico' => '2020/2021',
                'nHoras' => 400
            ]);
        }
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anexo;

class AnexosSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Anexo::truncate();

        $anexos = ['Anexo 0.- Convenio Centro Docente - Empresa', 'Anexo I.- Relación de Alumnos.', 'Anexo II.- Programa formativo.', 'Anexo III.- Hoja semanal del alumno.',
            'Anexo IV.- Informe valorativo y de evaluación individual.', 'Anexo V.- Recibí del alumno.', 'Anexo VI - Resumen de Gastos de alumnos (Formato Excel)',
            'Anexo VII.- Autorización para desplazamientos.'];

        for ($i = 0; $i < count($anexos); $i++) {
            $anexo = new Anexo;
            $anexo->nombre = $anexos[$i];
            if ($i == 6) {
                $anexo->tipo = 1;
            } else {
                $anexo->tipo = 0;
            }
            $anexo->ruta = '';
            $anexo->save();
        }
    }

}

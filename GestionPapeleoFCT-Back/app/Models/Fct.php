<?php

/**
 * INFORMACIÓN RELACIONADA A LA FCT DE UN ALUMNO
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fct extends Model {

    use HasFactory;

    protected $table = 'fct_alumno';
    protected $fillable = [
        'idEmpresa',
        'dniAlumno',
        'nombreResponsable',
        'horarioDiario',
        'nHoras',
        'fechaComienzo',
        'fechaFin'
    ];

}

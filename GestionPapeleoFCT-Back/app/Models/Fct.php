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
        'dniResponsable',
        'horarioDiario',
        'nHoras',
        'fechaComienzo',
        'fechaFin',
        'desplazamiento',
        'semiPresencial'
    ];
    
    public function fcts(){
        return $this->hasOne(EmpresaPerfiles::class, 'dniResponsable', 'dniResponsable');
    }

}

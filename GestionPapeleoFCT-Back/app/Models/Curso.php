<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model {

    use HasFactory;

        protected $fillable = [
        'cicloFormativo',
        'cicloFormativoA',
        'dniTutor',
        'familiaProfesional',
        'cursoAcademico',
        'nHoras',
    ];

    public function cursos() {
        return $this->hasOne(Persona::class, 'dni', 'dniTutor');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model {

    use HasFactory;
    
    protected $fillable = [
        'dniTutor',
        'familiaProfesional',
        'cicloFormativo',
        'cicloFormativoA',
        'cursoAcademico',
        'nHoras'
    ];
    
    public function cursos() {
        return $this->hasOne(Persona::class, 'dni', 'dniTutor');
    }
    
}

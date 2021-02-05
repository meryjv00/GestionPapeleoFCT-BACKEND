<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoAlumno extends Model {

    use HasFactory;

    protected $table = 'curso_alumno';
    protected $fillable = [
        'idCurso',
        'dniAlumno',
    ];

    public function cursos() {
        return $this->hasMany(Curso::class, 'id', 'idCurso');
    }

    public function alumnos() {
        return $this->hasMany(Persona::class, 'dni', 'dniAlumno');
    }

}

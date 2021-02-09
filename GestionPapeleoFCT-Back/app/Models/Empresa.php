<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model {

    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'provincia',
        'localidad',
        'calle',
        'cp',
        'cif',
        'tlf',
        'email',
        'dniRepresentante',
        'nombreRepresentante'
    ];

}

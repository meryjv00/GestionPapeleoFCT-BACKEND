<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Persona extends Model {

    use HasFactory,HasApiTokens;

    protected $fillable = [
        'correo',
        'dni',
        'nombre',
        'apellidos',
        'localidad',
        'residencia',
        'tlf',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $hidden = [
        'remember_token',
    ];
}
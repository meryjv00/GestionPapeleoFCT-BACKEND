<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnexosGenerados extends Model
{
    use HasFactory;
    
    protected $table = 'anexosgenerados';


    protected $fillable = [
        'nombre',
        'descargado'
    ];
}

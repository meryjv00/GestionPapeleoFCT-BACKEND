<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centro extends Model {

    use HasFactory;

    protected $table = 'centro';
    protected $primaryKey = 'codigo';
    public $incrementing = false;
    protected $keyType = 'string';

}

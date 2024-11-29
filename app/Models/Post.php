<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;
    /*Especifica la tabla que yo quiere de la base de datos sin seguir el esquema de nombres del Framework*/
    protected $table='alumnos';
}

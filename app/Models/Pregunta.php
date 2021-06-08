<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public $timestamps = false;

    public $fillable = ['producto_id','pregunta', 'usuario_id'];

    use HasFactory;
}

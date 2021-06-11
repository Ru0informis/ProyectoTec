<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $fillable = ['quien','usuario_id','accion','que'];
    public $timestamps = false;
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;
    public $fillable = ['nombre','descripcion', 'imagen', 'activa'];

    public function productos(){
        return $this -> hasMany('App\Models\Producto');
    }
    public function concesionado(){
        return $this -> hasMany('App\Models\Producto') -> where('concesionado', 1);
    }
    
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    public $timestamps = false;
    protected $fillable = ['nombre',  'a_paterno', 'a_materno', 'correo', 'imagen', 'rol', 'activo', 'password'];
    
    public function productos(){
        return $this -> hasMany(Producto::class);
    }
    use HasFactory;
}

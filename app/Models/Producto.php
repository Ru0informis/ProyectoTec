<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps = false;
    protected $fillable = ['producto', 'descripcion','cantidad', 'precio', 'imagen', 'usuario_id','categoria_id','concesionado','no_cuenta'];
    
    public function scopeProductosConcesionados($query){
        $query-> where('concesionado',1);
    
    }

    public function usuario(){
        return $this -> belongsTo('App\Models\Usuario');
    }
    public function propiertario(){
        return $this -> hasOne('App\Models\Usuario', 'usuario_id', 'id');
    }
    public function categorias(){
        return $this -> hasMany('App\Models\Categoria', 'categoria_id', 'id');
    }


    public function estaConcesionado(){
        if($this -> concesionado) return 1;
        else return 0;
    }
    use HasFactory;
}

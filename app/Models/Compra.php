<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public $timestamps = false;
    protected $fillable = ['comprador_id','producto_id','vendedor_id','cantidad','fecha_compra','Total','estado','comprobante','No_cuenta'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    public $fillable = ['vendedor_id','notas', 'monto','estado_pago','fecha_pago'];
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkout extends Model
{
    use HasFactory;
    protected $table = 'checkout';

    protected $fillable = ['Idempleado', 'observacion_checkout', 'fecha_entrega','fecha_salida','idmaquinaria','cantidad','idproducto','numero_orden','idmaquinaria_activo'];

}

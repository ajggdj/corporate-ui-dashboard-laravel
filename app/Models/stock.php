<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;

    protected $table = 'stock';

    /*public static function inventario(){
        return $allstock = stock::join('types_measurement', 'types_measurement.id', '=' , 'stock.tipo_cantidad_id')
        ->join('types_product', 'types_product.id', '=' , 'stock.tipo_mercancia_id')
        ->select('stock.id as idstock','stock.nombre as producto','stock.cantidad','stock.observaciones','stock.imagen', 'stock.tipo_cantidad_id as idcantidad', 'stock.tipo_mercancia_id as idmercancia', 'stock.baja_id as idbaja' ,'types_product.nombre as herramienta','types_measurement.nombre as tipo')
        ->where('baja_id',1);
    }*/
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Cart;

class ShopComponent extends Component
{
    public function store($stock_id,$stock_nombre,$stock_precio){
        Cart::add($stock_id,$stock_nombre,1,$stock_precio)->associate('\App\Models\stock');
        session()->flash('success_message','Se agregado al carrito');
        return redirect()->route('shop');
    }


    public function render()
    {
        $stock = DB::table('stock')
        ->join('types_measurement', 'types_measurement.id', '=' , 'stock.tipo_cantidad_id')
        ->join('types_product', 'types_product.id', '=' , 'stock.tipo_mercancia_id')
        ->select('stock.id as idstock','stock.nombre as producto','stock.cantidad','stock.precio','stock.observaciones','stock.imagen', 'stock.tipo_cantidad_id as idcantidad', 'stock.tipo_mercancia_id as idmercancia', 'stock.baja_id as idbaja' ,'types_product.nombre as herramienta','types_measurement.nombre as tipo')
        ->where('baja_id',1)
        ->simplePaginate(15);

        return view('livewire.shop-component', ['stock' => $stock])->layout('layouts.app');
    }
}

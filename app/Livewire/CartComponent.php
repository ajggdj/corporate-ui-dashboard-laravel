<?php

namespace App\Livewire;

use Livewire\Component;
use Cart;
use App\Models\checkout;
use App\Models\employees;
use App\Models\stock;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CartComponent extends Component
{
    public $Idempleado='',  $observacion_checkout='', $fecha_entrega,$fecha_salida,$idmaquinaria,$cantidad,$idproducto;

    public $view = 'create';

    public function Checkout(){
        $cart = Cart::content();
        $date = Carbon::now();
        $numorder =Str::random(10);



        foreach ($cart as $orders) {
            $idproducto = stock::where('id', $orders->id)->get();

            if($idproducto[0]->tipo_mercancia_id == 2){
                $order = checkout::create([
                    'Idempleado' => $this->Idempleado,
                    'observacion_checkout' => $this->observacion_checkout,
                    'fecha_entrega'=> 'N/A',
                    'fecha_salida' => $date->format('d-m-Y'),
                    'idmaquinaria'=> $idproducto[0]->id,
                    'idmaquinaria_activo' => 1,
                    'cantidad' => $orders->qty,
                    'idproducto' => $orders->id,
                    'numero_orden'=> $numorder,

                ]);

            }else{
                $order = checkout::create([
                    'Idempleado' => $this->Idempleado,
                    'observacion_checkout' => $this->observacion_checkout,
                    'fecha_entrega'=> 'N/A',
                    'fecha_salida' => $date->format('d-m-Y'),
                    'idmaquinaria'=> 'N/A',
                    'idmaquinaria_activo' => 0,
                    'cantidad' => $orders->qty,
                    'idproducto' => $orders->id,
                    'numero_orden'=> $numorder,

                ]);
            }


            stock::find($orders->id)->decrement('cantidad',$orders->qty);
        }

        Cart::destroy();
        session()->flash('Exito','Se realizo la orden con exito!!');
        //return redirect()->back();
        return redirect()->route('shop');

    }

    public function increaseQuantity($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId,$qty);
    }
    public function decreaseQuantity($rowId){
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId,$qty);
    }

    public function destroy($id){
        Cart::remove($id);
        session()->flash('eliminado','se a eliminado con exito del carrito');
    }

    public function render()
    {
        $empleados = employees::all();
        return view('livewire.cart-component', ['empleados' => $empleados])->layout('layouts.app');
    }
}

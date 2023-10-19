<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\stock;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class StockController extends Controller
{
    function __construct(){
        $this->middleware([
          'auth'
        ]);
      }

    public function index(){
        $stock = DB::table('stock')
        ->join('types_measurement', 'types_measurement.id', '=' , 'stock.tipo_cantidad_id')
        ->join('types_product', 'types_product.id', '=' , 'stock.tipo_mercancia_id')
        ->select('stock.id as idstock','stock.nombre as producto','stock.cantidad','stock.observaciones','stock.imagen', 'stock.tipo_cantidad_id as idcantidad', 'stock.tipo_mercancia_id as idmercancia', 'stock.baja_id as idbaja' ,'types_product.nombre as herramienta','types_measurement.nombre as tipo')
        ->where('baja_id',1)
        ->simplePaginate(15);

        $baja = DB::table('stock')
        ->join('types_measurement', 'types_measurement.id', '=' , 'stock.tipo_cantidad_id')
        ->join('types_product', 'types_product.id', '=' , 'stock.tipo_mercancia_id')
        ->select('stock.id as idstock','stock.nombre as producto','stock.cantidad','stock.observaciones','stock.imagen','types_product.nombre as herramienta','types_measurement.nombre as tipo')
        ->where('baja_id',3)
        ->simplePaginate(15);

        $pendiente = DB::table('stock')
        ->join('types_measurement', 'types_measurement.id', '=' , 'stock.tipo_cantidad_id')
        ->join('types_product', 'types_product.id', '=' , 'stock.tipo_mercancia_id')
        ->select('stock.id as idstock','stock.nombre as producto','stock.cantidad','stock.observaciones','stock.imagen','types_product.nombre as herramienta','types_measurement.nombre as tipo')
        ->where('baja_id',2)
        ->simplePaginate(15);

        $tipoMedicion = DB::select('select * from types_measurement');
        $tipoMercancia = DB::select('select * from types_product');

        //return $stock;
        return view('stock.index',['stock' => $stock, 'baja' => $baja, 'pendiente' => $pendiente, 'tipoMedicion' => $tipoMedicion, 'tipoMercancia' => $tipoMercancia]);
    }

    public function add(){

        $tipoMedicion = DB::select('select * from types_measurement');
        $tipoMercancia = DB::select('select * from types_product');

        return view('stock.add', ['tipoMedicion'=> $tipoMedicion, 'tipoMercancia'=> $tipoMercancia]);
    }
    public function addprodcuto(Request $request){

        $messages = [
            'nombre.required' =>'Campo incompleto "Nombre de Prodcuto"',
            'cantidad.required' =>'Campo incompleto "Cantidad"',
            'tipo_cantidad_id.required' =>'Campo incompleto "Selecciona una cantidad"',
            'tipo_mercancia_id.required' => 'Campo incompleto "Selecciona un tipo de mercancia',
            'imagen.required' =>'La imagen no debe de pesar mas de 2MB',

        ];
        $rules = [
            'nombre' => 'required|min:3',
            'tipo_cantidad_id'=> 'required',
            'imagen' => 'required|max:2040|',


            //'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);


        $table = new stock();
        $table->nombre = $request->input('nombre');
        $table->cantidad = $request->input('cantidad');
        $table->tipo_cantidad_id = $request->input('tipo_cantidad_id');
        if(!$request->input('tipo_mercancia_id')){
            $table->observaciones = $request->input('observacion');

        }else{
            $table->observaciones = 'N/A';

        }
        $table->tipo_mercancia_id = $request->input('tipo_mercancia_id');
        $table->precio = '0';

            $Name = "";
            $Name = $imagen = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(base_path() . '/public/stock/', $Name);

        $table->imagen = $Name;
        $table->baja_id = $request->input('status');
        $table->baja_user_id = Auth::id();

        $table->save();
        return redirect()->route('stock.index');
        //return $table;
    }
    public function edit($id){
        $stock1 = stock::find($id);
        $tipoMedicion = DB::select('select * from types_measurement');
        $tipoMercancia = DB::select('select * from types_product');


        return view('stock.edit', ['stock1' => $stock1, 'tipoMercancia' =>$tipoMercancia, 'tipoMedicion'=> $tipoMedicion]);
    }

    public function update(Request $request,$id){
        $table = stock::find($id);
        $table->nombre = $request->input('nombre');
        $table->cantidad = $request->input('cantidad');
        $table->tipo_cantidad_id = $request->input('tipo_cantidad_id');
        $table->observaciones = $request->input('observacion');
        $table->tipo_mercancia_id = $request->input('tipo_mercancia_id');
        $table->precio = '0';

        $Name = "";
        if ($request->hasFile('imagen')) {

            $Name = $imagen = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(base_path() . '/public/stock/', $Name);
            $table->imagen = $Name;
        }

        $table->baja_id = $request->baja_id;
        $table->baja_user_id = Auth::id();

        $table->save();
        return redirect()->route('stock.index');
    }

    public function eliminar($id){

        $table = stock::find($id);
        $table->baja_id = 3;
        $table->baja_user_id = Auth::id();

        $table->save();
        return redirect()->route('stock.index');
    }
    public function activo($id){
        $table = stock::find($id);
        $table->baja_id = 1;
        $table->baja_user_id = Auth::id();

        $table->save();
        return redirect()->route('stock.index');
    }

    /*public function import(Request $request){
        $file = $request->file('file');
        Excel::import(new stock, $file);
        return back()->with('success', 'Products imported successfully.');
    }*/
}

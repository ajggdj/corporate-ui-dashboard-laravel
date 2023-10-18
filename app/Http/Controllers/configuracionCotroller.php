<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\typesProduct;
use App\Models\TypesMeasurement;
use App\Models\ConfigSites;


class configuracionCotroller extends Controller
{
    function __construct(){
        $this->middleware([
          'auth'
        ]);
      }

      public function index(){

        $TipoMercancia = DB::select('select * from types_product where activo = 1');
        $TipoCantidad = DB::select('select * from types_measurement where activo = 1');

        return view('configuracion.index',['TipoMercancia' => $TipoMercancia, 'TipoCantidad' => $TipoCantidad]);
      }

      public function addtipomercancia(Request $request){
        $table = new typesProduct();
        $table->nombre = $request->input('nombre');
        $table->activo = 1;
        $table->save();
        return redirect()->back()->with('addproducto','Se agregado una mercancia con exito!');
      }


      public function edittipomercancia(Request $request,$id){

        $table =  typesProduct::find($id);
        $table->nombre = $request->input('nombre');

        $table->save();

        return redirect()->route('configuracion.index')->with('editproducto','Se a editado una mercancia con exito!');
      }
      public function eliminarmercancia($id){
        $table = typesProduct::find($id);
        $table-> activo = 0;
        $table->save();
        return redirect()->route('configuracion.index')->with('eliminarmercancia','Se a eliminado una mercancia con exito!');


      }

      public function addtipocantidad(Request $request){
        $table = new TypesMeasurement();
        $table->nombre = $request->input('nombre');
        $table->activo = 1;
        $table->save();
        return redirect()->back()->with('addcantidad','Se agregado una nueva cantidad con exito!');
      }

      public function edittipocantidad(Request $request,$id){

        $table =  TypesMeasurement::find($id);
        $table->nombre = $request->input('nombre');

        $table->save();

        return redirect()->route('configuracion.index')->with('edittipocantidad','Se a editado una cantidad con exito!');
      }
      public function eliminarcantidad($id){
        $table = TypesMeasurement::find($id);
        $table-> activo = 0;
        $table->save();
        return redirect()->route('configuracion.index')->with('eliminarcantidad','Se a eliminado una cantidad con exito!');
      }

      public function logoimagen(Request $request) {

        $existelogo = DB::select('select * from config_sites where nombre = "logo"');

        if($existelogo){
            $table = ConfigSites::find($existelogo[0]->id);

            $Name = "";
        if ($request->hasFile('imagen')) {

            $Name = $imagen = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(base_path() . '/public/logo/', $Name);
            $table->opciones = $Name;
        }
            $table->save();

            return redirect()->route('configuracion.index')->with('logoimagen','Se cambio el logo con exito!');

        }else{
            $table = new ConfigSites();
            $table->nombre = 'logo';

            $Name = "";
            $Name = $imagen = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(base_path() . '/public/logo/', $Name);

            $table-> opciones = $Name;
            $table->save();
            return redirect()->route('configuracion.index')->with('logoimagen','Se a agregado el logo con exito con exito!');
        }



      }

}

<?php

namespace App\Http\Controllers;

use App\Models\checkout;
use App\Models\employees;
use App\Models\stock;
//use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
Use PDF;


class reportController extends Controller
{
    function __construct(){
        $this->middleware([
          'auth'
        ]);
      }

    public function index(){

        $unicos  = checkout::distinct()->join('employees','employees.id', '=', 'Idempleado')
        ->select('checkout.id','numero_empleado','numero_orden','fecha_salida','fecha_entrega')->where('idmaquinaria_activo',0)->orderBy('id', "desc")->simplePaginate(10);

        $maquinaria = checkout::distinct()->join('employees','employees.id', '=', 'Idempleado')
        ->select('checkout.id','numero_empleado','numero_orden','fecha_salida')->where('idmaquinaria_activo',1)->orderBy('id', "desc")->simplePaginate(10);

        /*$reporte = DB::table('checkout as ordenes')
        ->join('employees','employees.id', '=', 'ordenes.Idempleado')
        ->join('stock as producto','producto.id','=','ordenes.idproducto')
        ->select('employees.nombre_empleado','employees.numero_empleado',
        'producto.nombre','producto.id','producto.observaciones','producto.imagen',
        'ordenes.observacion_checkout','ordenes.fecha_salida','ordenes.cantidad','ordenes.created_at','ordenes.numero_orden'
        )
        ->orderBy('ordenes.numero_orden', "asc")
        ->orderBy('ordenes.created_at', "asc")
        ->orderBy('employees.numero_empleado', "asc")

        ->get();*/
        return view('reportes.index',['unicos'=>$unicos,'maquinaria'=>$maquinaria]);
    }

    public function indexmaquinaria(){

        $unicos  = checkout::distinct()->join('employees','employees.id', '=', 'Idempleado')
        ->select('checkout.id','numero_empleado','numero_orden','fecha_salida','fecha_entrega')->where('idmaquinaria_activo',0)->orderBy('id', "desc")->simplePaginate(10);

        $maquinaria = checkout::distinct()->join('employees','employees.id', '=', 'Idempleado')
        ->select('checkout.id','numero_empleado','numero_orden','fecha_salida')->where('idmaquinaria_activo',1)->orderBy('id', "desc")->simplePaginate(10);

        /*$reporte = DB::table('checkout as ordenes')
        ->join('employees','employees.id', '=', 'ordenes.Idempleado')
        ->join('stock as producto','producto.id','=','ordenes.idproducto')
        ->select('employees.nombre_empleado','employees.numero_empleado',
        'producto.nombre','producto.id','producto.observaciones','producto.imagen',
        'ordenes.observacion_checkout','ordenes.fecha_salida','ordenes.cantidad','ordenes.created_at','ordenes.numero_orden'
        )
        ->orderBy('ordenes.numero_orden', "asc")
        ->orderBy('ordenes.created_at', "asc")
        ->orderBy('employees.numero_empleado', "asc")

        ->get();*/
        return view('reportes.indexmaquinaria',['unicos'=>$unicos,'maquinaria'=>$maquinaria]);
    }

    public function detalles($id) {

        $reporte = DB::table('checkout as ordenes')
        ->join('employees','employees.id', '=', 'ordenes.Idempleado')
        ->join('stock as producto','producto.id','=','ordenes.idproducto')
        ->select('employees.nombre_empleado','employees.numero_empleado',
        'producto.nombre','producto.id','producto.observaciones as obser','producto.imagen',
        'ordenes.id as checkid','ordenes.activo as elimdetalle',
        'ordenes.observacion_checkout','ordenes.fecha_salida','ordenes.cantidad','ordenes.created_at','ordenes.numero_orden'
        )
        ->where('ordenes.numero_orden', $id)
        ->where('idmaquinaria_activo',0)
        ->get();

        $numeroOrden = checkout::where('numero_orden',$id)->get();
        $empleado = employees::where('id',$numeroOrden[0]->Idempleado)->get();

        return view('reportes.detalles', ['reporte' => $reporte,'numeroOrden'=>$numeroOrden,'empleado'=>$empleado]);


    }

    public function detallesmaquina($id) {

      $reporte = DB::table('checkout as ordenes')
      ->join('employees','employees.id', '=', 'ordenes.Idempleado')
      ->join('stock as producto','producto.id','=','ordenes.idproducto')
      ->select('employees.nombre_empleado','employees.numero_empleado',
      'producto.nombre','producto.id','producto.observaciones as obser','producto.imagen','ordenes.id as idcheckout',
      'ordenes.id as checkid','ordenes.activo as elimdetalle',
      'ordenes.observacion_checkout','ordenes.fecha_salida','ordenes.fecha_entrega','ordenes.cantidad','ordenes.created_at','ordenes.numero_orden'
      )
      ->where('idmaquinaria_activo',1)
      ->where('ordenes.numero_orden', $id)
      ->get();

      $numeroOrden = checkout::where('numero_orden',$id)->get();
      $empleado = employees::where('id',$numeroOrden[0]->Idempleado)->get();


      return view('reportes.detallesmaquina', ['reporte' => $reporte,'numeroOrden'=>$numeroOrden,'empleado'=>$empleado]);


  }

  public function detallesmaquinafecha(Request $request, $id){

    $table = checkout::find($id);
    $table->fecha_entrega = Carbon::parse($request->input('fechaentrega'))->format('d-m-Y');
    $table->save();

    stock::find($table->idproducto)->increment('cantidad',$table->cantidad);


    return back();
  }

  public function generatePDF($id)
  {
    $reporte = DB::table('checkout as ordenes')
    ->join('employees','employees.id', '=', 'ordenes.Idempleado')
    ->join('stock as producto','producto.id','=','ordenes.idproducto')
    ->select('employees.nombre_empleado','employees.numero_empleado',
    'producto.nombre','producto.id','producto.observaciones as obser','producto.imagen','ordenes.id as idcheckout',
    'ordenes.observacion_checkout','ordenes.idmaquinaria_activo','ordenes.fecha_salida','ordenes.fecha_entrega','ordenes.cantidad','ordenes.created_at','ordenes.numero_orden'
    )
    ->where('idmaquinaria_activo',1)
    ->where('ordenes.numero_orden', $id)
    ->get();

      $data = [
          'title' => 'Welcome to ItSolutionStuff.com',
          'date' => date('m/d/Y'),
          'reporte' => $reporte
      ];

      $pdf = PDF::loadView('reportes.myPDF', $data);

      return $pdf->download('Detalles-decompra-'.$id.'.pdf');
  }

  public function generatePDFnormal($id)
  {
    $reporte = DB::table('checkout as ordenes')
    ->join('employees','employees.id', '=', 'ordenes.Idempleado')
    ->join('stock as producto','producto.id','=','ordenes.idproducto')
    ->select('employees.nombre_empleado','employees.numero_empleado',
    'producto.nombre','producto.id','producto.observaciones as obser','producto.imagen','ordenes.id as idcheckout',
    'ordenes.observacion_checkout','ordenes.idmaquinaria_activo','ordenes.fecha_salida','ordenes.fecha_entrega','ordenes.cantidad','ordenes.created_at','ordenes.numero_orden'
    )
    ->where('idmaquinaria_activo',0)
    ->where('ordenes.numero_orden', $id)
    ->get();

      $data = [
          'title' => 'Welcome to ItSolutionStuff.com',
          'date' => date('m/d/Y'),
          'reporte' => $reporte
      ];

      $pdf = PDF::loadView('reportes.myPDF', $data);

      return $pdf->download('Detalles-decompra-'.$id.'.pdf');
  }
  public function eliminardetalle($id){
    $table = checkout::find($id);
    $table-> activo = 0;
    $table->save();

    $incrementar = checkout::where('id',$id)->get();

    stock::find($incrementar[0]->idproducto)->increment('cantidad',$incrementar[0]->cantidad);

    return back();
  }

  public function eliminardetallemaquina($id){
    $table = checkout::find($id);
    $table-> activo = 0;
    $table->save();

    $incrementar = checkout::where('id',$id)->get();

    stock::find($incrementar[0]->idproducto)->increment('cantidad',$incrementar[0]->cantidad);

    return back();
  }
}

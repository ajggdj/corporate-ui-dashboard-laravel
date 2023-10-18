<?php

namespace App\Http\Controllers;

use App\Exports\ExportEmployees;
use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;


class EmployeesCotroller extends Controller
{
    function __construct(){
        $this->middleware([
          'auth'
        ]);
      }

    public function index(){

        $empleadoNumero = employees::where('activo',1)->get();

        return view('empleados.index',['empleadoNumero' => $empleadoNumero]);
    }

    public function addempleado(Request $request){
        $table = new employees();
        $nombreEmpleado = $request->input('nombre_empleado');
        if($nombreEmpleado != null || $nombreEmpleado != ''){
            $table->nombre_empleado = $request->input('nombre_empleado');
        }else{
            $table->nombre_empleado = 'N/A';
        }
        
        $table->numero_empleado = $request->input('numero_empleado');
        $table->activo = 1;

        $table->save();

        return redirect()->route('empleados.index');

    }

    public function editar(Request $request,$id){
        $table = employees::find($id);

        $nombreEmpleado = $request->input('nombre_empleado');
        if($nombreEmpleado != null || $nombreEmpleado != ''){
            $table->nombre_empleado = $request->input('nombre_empleado');
        }else{
            $table->nombre_empleado = 'N/A';
        }
        
        $table->numero_empleado = $request->input('numero_empleado');
        $table->save();

        return redirect()->route('empleados.index');

    }

    public function eliminar(Request $request,$id){

    }

    public function import(Request $request){
        $file = $request->file('file');

        Excel::import(new EmployeesImport, $file);
        return back()->with('success', 'Nuevos usuarios registrados.');
    }
    public function exportEmpleados(Request $request){
        return Excel::download(new ExportEmployees, 'Registros-de-Empleados.xlsx');
    }
}

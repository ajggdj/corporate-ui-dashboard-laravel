<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class usuariosController extends Controller
{
    function __construct(){
        $this->middleware([
          'auth'
        ]);
      }

    public function index(){

        $usuario = DB::select('select * from users where activo = 1');
        $usuariobaja = DB::select('select * from users where activo = 0');


        return view('usuarios.index',['usuario' => $usuario, 'usuariobaja'=> $usuariobaja]);
    }

    public function addusuarios(Request $request) {

        $table = new User();
        $table->name = $request->input('nombre');
        $table->email = $request->input('correo');
        $table->password = Hash::make($request['password']);
        $table->activo = 1;
        $table->save();

        return redirect()->back()->with('addusuarios','Se agrego nuevo usuario con exito!');
    }

    public function editusuarios(Request $request, $id){

        $table = User::find($id);
        $table->name = $request->input('nombre');
        $table->email = $request->input('correo');
        if($request['password']){
            $table->password = Hash::make($request['password']);
        }
        $table->activo = 1;
        $table->save();

        return redirect()->back()->with('editusuarios','Se Edito usuario con exito!');

    }

    public function eliminarusuarios($id){
        $table = User::find($id);
        $table->activo = 0;
        $table->save();

        return redirect()->back()->with('eliminarusuarios','Se desactivo el usuario con exito!');

    }

    public function activarusuarios($id){
        $table = User::find($id);
        $table->activo = 1;
        $table->save();

        return redirect()->back()->with('activarusuarios','Se activo el usuario con exito!');
    }
}

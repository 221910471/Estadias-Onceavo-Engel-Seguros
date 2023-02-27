<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Polizas;
use App\Models\Usuarios;
use App\Models\UsuariosPolizas;
use Session;

class ClienteController extends Controller
{
    public function clientes(){
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        $usuarios = Usuarios::withTrashed()
            ->where("id",$sessionId)
            ->get();

        // $consulta[0]->nombre

        $usuarios_polizas = UsuariosPolizas::all();

        $polizas = Polizas::withTrashed()
            ->get();
        

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                Session::flash('mensaje', 'No puede acceder este apartado');
                return redirect()->route('login');
            }
            else{
                return view('cliente')
                ->with('polizas', $polizas)
                ->with('usuarios_polizas', $usuarios_polizas)
                ->with('usuarios', $usuarios);
            }
            
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Session;

class LoginController extends Controller
{   
    public function home(){
        // return view('home');

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        if($sessionId<>""){
            return view('home');
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }
    }

    public function login(){
        
        return view('auth.login');
    }

    public function validar(Request $request){
        $this->validate($request,[
            'correoElectronico' => 'required|email',
            'contrasena' => 'required'
        //     'nombre' => 'required|regex:/[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
        //     'apellidoPaterno' => 'required|regex:/[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
        //     'apellidoMaterno' => 'required|regex:/[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
        //     'telefono' => 'required|regex:/[0-9]{10}$/',
        //     'correoElectronico' => 'required|email',
        //     'img' => 'image|mimes:gif,jpeg,png'

            
        // 'contrasena',
        // 'rol',
        // 'fechaDeNacimiento',
        // 'identificacion',
        // 'tarjetaDeCirculacion',
        // 'comprobanteDomiciliario',
        // 'estadoDeSesion',
        // 'activo',
        // 'familiaId',
        ]);

        // $passwordEncriptado = Hash::make($request->contrasena);
        // echo $passwordEncriptado;
        
        $consulta = Usuarios::where('correoElectronico',$request->correoElectronico)
            ->where('activo','SI')
            ->get();
        $cuantos = count($consulta);
        if($cuantos==1 and hash::check($request->contrasena,$consulta[0]->contrasena)){
            // echo "acceso permitido";
            // crear variables de sesión
            Session::put('sessionUsuario',$consulta[0]->nombre . ' ' . $consulta[0]->apellidoPaterno . ' ' . $consulta[0]->apellidoMaterno);
            Session::put('sessionTipo',$consulta[0]->rol);
            Session::put('sessionId',$consulta[0]->id);

            return redirect()->route('home');
        }
        else{
            // echo "acceso NO permitido";
            Session::flash('mensaje','El correo o contraseña no son válidos');
            return redirect()->route('login');
        }
    }

    public function cerrarSesion(){
        //eliminamos las variables de session actuales
        Session::forget('sessionUsuario');
        Session::forget('sessionTipo');
        Session::forget('sessionId');

        // redireccionamos al login
    
        Session::flash('mensaje','Sesión cerrada correctamente');
            return redirect()->route('login');
    }
}

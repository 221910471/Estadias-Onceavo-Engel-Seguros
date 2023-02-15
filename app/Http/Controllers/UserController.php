<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Session;

class UserController extends Controller
{
    public function users(){
        $usuarios = Usuarios::all();
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        if($sessionId<>""){
            return view('crud.users')
            ->with('usuarios', $usuarios);
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }
    }

    public function createUser(Request $request){
        
        $this->validate($request,[
            
            'nombre' => 'required|regex:/[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'apellidoPaterno' => 'required|regex:/[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            // 'apellidoMaterno' => 'required|regex:/[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'telefono' => 'required|regex:/[0-9]{10}$/',
            'correoElectronico' => 'required|email|unique:usuarios',
            'contrasena' => 'required',
            'fechaDeNacimiento' => 'required',
            'rol' => 'required',
            'identificacion' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'tarjetaDeCirculacion' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'comprobanteDomiciliario' => 'required|image|mimes:jpeg,png,jpg|max:3000',
            'estadoDeSesion' => 'required',
            'activo' => 'required'

        ]);

        $passwordEncriptado = Hash::make($request->contrasena);
        echo $passwordEncriptado;

//Guardar en la base de datos el archivo de imagen Identificación

        if ($request->file('identificacion') != '') {
           //asignar el archivo de imagen a una variable
            $file = $request->file('identificacion');
            //obtener la extensión del archivo de imagen
            $foto = $file->getClientOriginalName();
            //Obtener la fecha y hora actual
            $date = date('Ymd_His_');
            //concatenar todo el nombre del archivo con el tiempo para que sea unico
            $foto2 = $date . $foto;
            //Cambiar la variable s un tipo string
            $ruta = strval($foto2);
            //almacenar en la carpeta de imagenes el archivo ingresado
            $file->move(public_path("images/identificaciones/"), $foto2);

        } else {
            $foto2 = "default.png";
            $ruta = "img/default.png";
        }

//Guardar en la base de datos el archivo de imagen Tarjeta de circulacion

        if ($request->file('tarjetaDeCirculacion') != '') {
            //asignar el archivo de imagen a una variable
            $archivoTarjeta = $request->file('tarjetaDeCirculacion');
            //obtener la extensión del archivo de imagen
            $extensionTarjeta = $archivoTarjeta->getClientOriginalName();
            //Obtener la fecha y hora actual
            $date = date('Ymd_His_');
            //concatenar todo el nombre del archivo con el tiempo para que sea unico
            $nombreArchivoTarjeta = $date . $extensionTarjeta;
            //Cambiar la variable s un tipo string
            $rutaTarjeta = strval($nombreArchivoTarjeta);
            //almacenar en la carpeta de imagenes el archivo ingresado
            $archivoTarjeta->move(public_path("images/tarjetaCirculacion/"), $nombreArchivoTarjeta);

        } else {
            $nombreArchivoTarjeta = "default.png";
            $rutaTarjeta = "img/default.png";
        }
        echo $rutaTarjeta;
//Guardar en la base de datos el archivo de imagen Comprobante de domicilio

            if ($request->file('comprobanteDomiciliario') != '') {
                //asignar el archivo de imagen a una variable
                $archivoComprobanteDomiciliario = $request->file('comprobanteDomiciliario');
                //obtener la extensión del archivo de imagen
                $extensionComprobanteDomiciliario = $archivoComprobanteDomiciliario->getClientOriginalName();
                //Obtener la fecha y hora actual
                $date = date('Ymd_His_');
                //concatenar todo el nombre del archivo con el tiempo para que sea unico
                $nombreArchivoComprobante = $date . $extensionComprobanteDomiciliario;
                //Cambiar la variable s un tipo string
                $rutaComprobante = strval($nombreArchivoComprobante);
                //almacenar en la carpeta de imagenes el archivo ingresado
                $archivoComprobanteDomiciliario->move(public_path("images/comprobanteDomiciliario/"), $nombreArchivoComprobante);

            } else {
                $nombreArchivoComprobante = "default.png";
                $rutaComprobante = "img/default.png";
            }

            echo $rutaComprobante;


            Usuarios::create(array(
                'nombre' => $request->input('nombre'),
                'apellidoPaterno' => $request->input('apellidoPaterno'),
                'apellidoMaterno' => $request->input('apellidoMaterno'),
                'telefono' => $request->input('telefono'),
                'contrasena' => $passwordEncriptado,
                'correoElectronico' => $request->input('correoElectronico'),
                'rol' => $request->input('rol'),
                'fechaDeNacimiento' => $request->input('fechaDeNacimiento'),
                'identificacion' => $ruta,
                'tarjetaDeCirculacion' => $rutaTarjeta,
                'comprobanteDomiciliario' => $rutaComprobante,
                'estadoDeSesion' => $request->input('estadoDeSesion'),
                'activo' => $request->input('activo'),
                'familiaId' => $request->input('familiaId')
            ));
        
        $usuarios = Usuarios::all();

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        if($sessionId<>""){
            Session::flash('mensaje', 'REGISTRO COMPLETO');
            // return view('crud.users')
            // ->with('usuarios', $usuarios);
            return redirect('users');
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }
    }
}

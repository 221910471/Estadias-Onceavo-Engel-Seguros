<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Session;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

class UserController extends Controller
{
    public function users(){
        $usuarios = Usuarios::all();
        
        //Consultar todos los datos junto con el softdelete
        // $usuarios = Usuarios::withTrashed()
        //     ->get();

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
            'identificacion' => 'image|mimes:jpeg,png,jpg|max:3000',
            'tarjetaDeCirculacion' => 'image|mimes:jpeg,png,jpg|max:3000',
            'comprobanteDomiciliario' => 'image|mimes:jpeg,png,jpg|max:3000',
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
            $ruta = "default.png";
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
            $rutaTarjeta = "default.png";
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
                $rutaComprobante = "default.png";
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

    public function delete($id){
        $usuarios = Usuarios::find($id);
        $usuarios->delete();
        Session::flash('mensaje', 'El usuario ha sido eliminado');
        return redirect()->route('users');
        
    }

    public function activateUser($id){
        $usuarios2 = Usuarios::withTrashed()->where('id',$id)->restore();
        Session::flash('mensaje', 'El usuario ha sido restaurado con éxito');
        return redirect()->route('users');
    }

    public function editUser(Request $request, $id){
        
        $this->validate($request,[
            
            'nombre' => 'required|regex:/[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'apellidoPaterno' => 'required|regex:/[A-Z][A-Z,a-z, ,á,é,í,ó,ú]+$/',
            'telefono' => 'required|regex:/[0-9]{10}$/',
            'correoElectronico' => 'required|email',
            'contrasena' => 'required',
            'fechaDeNacimiento' => 'required',
            'rol' => 'required',
            'identificacion' => 'image|mimes:jpeg,png,jpg|max:3000',
            'tarjetaDeCirculacion' => 'image|mimes:jpeg,png,jpg|max:3000',
            'comprobanteDomiciliario' => 'image|mimes:jpeg,png,jpg|max:3000',
            'estadoDeSesion' => 'required',
            'activo' => 'required'

        ]);

        // $passwordEncriptado = Hash::make($request->contrasena);
        // echo $passwordEncriptado;

        if ($request->file('identificacion') != '') {
            $file = $request->file('identificacion');
            $foto = $file->getClientOriginalName();
            $date = date('Ymd_His_');
            $foto2 = $date . $foto;
            $ruta = strval($foto2);
            $file->move(public_path("images/identificaciones/"), $foto2);

        } else {
            $foto2 = "default.png";
            $ruta = "img/default.png";
        }

        if ($request->file('tarjetaDeCirculacion') != '') {
            $archivoTarjeta = $request->file('tarjetaDeCirculacion');
            $extensionTarjeta = $archivoTarjeta->getClientOriginalName();
            $date = date('Ymd_His_');
            $nombreArchivoTarjeta = $date . $extensionTarjeta;
            $rutaTarjeta = strval($nombreArchivoTarjeta);
            $archivoTarjeta->move(public_path("images/tarjetaCirculacion/"), $nombreArchivoTarjeta);

        } else {
            $nombreArchivoTarjeta = "default.png";
            $rutaTarjeta = "img/default.png";
        }
        

            if ($request->file('comprobanteDomiciliario') != '') {
                $archivoComprobanteDomiciliario = $request->file('comprobanteDomiciliario');
                $extensionComprobanteDomiciliario = $archivoComprobanteDomiciliario->getClientOriginalName();
                $date = date('Ymd_His_');
                $nombreArchivoComprobante = $date . $extensionComprobanteDomiciliario;
                $rutaComprobante = strval($nombreArchivoComprobante);
                $archivoComprobanteDomiciliario->move(public_path("images/comprobanteDomiciliario/"), $nombreArchivoComprobante);

            } else {
                $nombreArchivoComprobante = "default.png";
                $rutaComprobante = "img/default.png";
            }

            


            Usuarios::query()->update(array(
                'nombre' => $request->input('nombre'),
                'apellidoPaterno' => $request->input('apellidoPaterno'),
                'apellidoMaterno' => $request->input('apellidoMaterno'),
                'telefono' => $request->input('telefono'),
                'contrasena' => $request->input('contrasena'),
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

        $sessionId = session('sessionId');
        if($sessionId<>""){
            Session::flash('mensaje', 'Registro Actualizado Correctamente');
            return redirect('users');
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }

    }

    public function filterUsers(Request $request){

        $nombres = Usuarios::where("nombre","like",$request->texto."%")
            ->get();

        // echo ($nombres);

        switch ($request->activo) {
            case 1:
                // $usuarios = Usuarios::all();
                $usuarios = Usuarios::where("nombre","like",$request->nombre."%")
                    ->orWhere("apellidoPaterno","like",$request->nombre."%")
                    ->orWhere("apellidoMaterno","like",$request->nombre."%")
                    ->get();
                break;
            case 2:
                // $usuarios = Usuarios::where("nombre","like",$request->nombre."%")
                //     ->orWhere("apellidoPaterno","like",$request->nombre."%")
                //     ->orWhere("apellidoMaterno","like",$request->nombre."%")
                //     ->onlyTrashed()
                //     ->get();
                $usuarios = Usuarios::onlyTrashed()
                ->get();
                break;
            default:
                $usuarios = Usuarios::where("nombre","like",$request->nombre."%")
                    ->orWhere("apellidoPaterno","like",$request->nombre."%")
                    ->orWhere("apellidoMaterno","like",$request->nombre."%")
                    ->withTrashed()
                    ->get();
                // $usuarios = Usuarios::withTrashed()
                // ->get();
                break;
        }
        


        // if(isset($usuarios)){
        //     Session::flash('mensaje', 'No se encontró ningun resultado');
        // }

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

    public function pdfVista(){
        $usuarios = Usuarios::all();
        return view('crud.pdfUsuarios')
            ->with('usuarios', $usuarios);
    }

    public function pdfUsuarios(){
        $usuarios = Usuarios::all();
        $pdf = PDF::loadView('crud.pdfUsuarios',['usuarios'=>$usuarios]);
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;
use App\Models\Notificaciones;
use Illuminate\Pagination\Paginator;
use Session;
use PDF;

class NotificacionController extends Controller
{
    public function notificaciones(){
        $notificaciones = Notificaciones::all();
        $usuarios = Usuarios::all();
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.notificaciones.notificaciones')
                    ->with('usuarios', $usuarios)
                    ->with('notificaciones', $notificaciones);
            }
            else{
                Session::flash('mensaje', 'No puede acceder este apartado');
            return redirect()->route('login');
            }
            
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }

    }

    public function createNotificacion(Request $request){

        $this->validate($request,[
            
            'titulo' => 'required',
            'asunto' => 'required',
            'mensaje' => 'required',
            'usuarioId' => 'required'

        ]);

            $asunto = $request->input('asunto');
            $asunto2 = $request->input('asunto2');

            if($asunto == "Seleccione un asunto de la lista"){
                $asuntoGuardar = $asunto2;
            }
            else{
                $asuntoGuardar = $asunto;
            }

            $mensaje = $request->input('mensaje');
            $mensaje2 = $request->input('mensaje2');

            if($mensaje == "Seleccione un mensaje de la lista"){
                $mensajeGuardar = $mensaje2;
            }
            else{
                $mensajeGuardar = $mensaje;
            }


            $sessionId = session('sessionId');

            $date = date('Ymd');

            Notificaciones::create(array(
                'fechaEnvio' => $date,
                'titulo' => $request->input('titulo'),
                'asunto' => $asuntoGuardar,
                'mensaje' => $request->input('mensaje'),
                'usuarioId' => $request->input('usuarioId')
            ));

        
            $sessionTipo = session('sessionTipo');
    
            if($sessionId<>""){
                if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                    return redirect('notificaciones');
                }
                else{
                    Session::flash('mensaje', 'No puede acceder este apartado');
                    return redirect()->route('login');
                }
                
            }
            else{
                Session::flash('mensaje', 'Por favor inicie sesión para continuar');
                return redirect()->route('login');
            }
    }

    public function deleteNotificacion($id){
        $notificaciones = Notificaciones::find($id);
        $notificaciones->delete();
        Session::flash('mensaje', 'La notificación ha sido eliminada');
        return redirect()->route('notificaciones');
        
    }

    // public function activateNotificacion($id){
    //     $usuarios2 = Usuarios::withTrashed()->where('id',$id)->restore();
    //     Session::flash('mensaje', 'La venta ha sido restaurada con éxito');
    //     return redirect()->route('ventas');
    // }

    public function editNotificacion(Request $request, $id){
        
        
        $this->validate($request,[
            
            'titulo' => 'required',
            'asunto' => 'required',
            'mensaje' => 'required',
            'usuarioId' => 'required'

        ]);

        $sessionId = session('sessionId');

        $date = date('Ymd');

        $sessionTipo = session('sessionTipo');

        $notificacionesSave = Notificaciones::find($id);
            $notificacionesSave->fechaEnvio = $date;
            $notificacionesSave->titulo = $request->titulo;
            $notificacionesSave->asunto = $request->asunto;
            $notificacionesSave->mensaje = $request->mensaje;
            $notificacionesSave->usuarioId = $request->usuarioId;
        $notificacionesSave->save();
         
    
        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                Session::flash('mensaje', 'Registro Actualizado Correctamente');
                return redirect('notificaciones');
            }
            else{
                  Session::flash('mensaje', 'No puede acceder este apartado');
            return redirect()->route('login');
            }
                
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }       

    }

    public function notificacionesCliente(){

        Paginator::useBootstrapFour();

        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');
       
        $notificaciones = Notificaciones::where("usuarioId", "=", $sessionId)
        ->orderBy('fechaEnvio', 'desc')
            ->paginate(6);
        $usuarios = Usuarios::all();
        
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador

        if($sessionId<>""){
            if($sessionTipo == "Cliente"){
                return view('notificaciones')
                    ->with('usuarios', $usuarios)
                    ->with('notificaciones', $notificaciones);
            }
            else{
                Session::flash('mensaje', 'No puede acceder este apartado');
            return redirect()->route('login');
            }
            
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }
    }


    // public function filterVentas(Request $request){

    //     $nombres = Usuarios::where("nombre","like",$request->texto."%")
    //         ->get();

    //     // echo ($nombres);

    //     switch ($request->activo) {
    //         case 1:
    //             // $usuarios = Usuarios::all();
    //             $usuarios = Usuarios::where("nombre","like",$request->nombre."%")
    //                 ->orWhere("apellidoPaterno","like",$request->nombre."%")
    //                 ->orWhere("apellidoMaterno","like",$request->nombre."%")
    //                 ->get();
    //             break;
    //         case 2:
    //             // $usuarios = Usuarios::where("deleted_at", "!=", "")
    //             //     ->where("nombre","like",$request->nombre."%")    
    //             //     ->orWhere("apellidoPaterno","like",$request->nombre."%")
    //             //     ->orWhere("apellidoMaterno","like",$request->nombre."%")
    //             //     ->get();
    //             $usuarios = Usuarios::onlyTrashed()
    //             ->get();
    //             break;
    //         default:
    //             $usuarios = Usuarios::where("nombre","like",$request->nombre."%")
    //                 ->orWhere("apellidoPaterno","like",$request->nombre."%")
    //                 ->orWhere("apellidoMaterno","like",$request->nombre."%")
    //                 ->withTrashed()
    //                 ->get();
    //             // $usuarios = Usuarios::withTrashed()
    //             // ->get();
    //             break;
    //     }


    //     $sessionId = session('sessionId');
    //     if($sessionId<>""){
    //         return view('crud.users')
    //         ->with('usuarios', $usuarios);
    //     }
    //     else{
    //         Session::flash('mensaje', 'Por favor inicie sesión para continuar');
    //         return redirect()->route('login');
    //     }
    // }

    // public function pdfVistaVenta(){
    //     $usuarios = Usuarios::all();
    //     return view('crud.pdfUsuarios')
    //         ->with('usuarios', $usuarios);
    // }

    // public function pdfVentas(){
    //     $usuarios = Usuarios::all();
    //     $pdf = PDF::loadView('crud.pdfUsuarios',['usuarios'=>$usuarios]);
    //     //$pdf->loadHTML('<h1>Test</h1>');
    //     return $pdf->stream();
    // }
}

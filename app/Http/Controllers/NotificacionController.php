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

        $notificaciones = Notificaciones::orderBy('updated_at', 'desc')
            ->get();

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
                Session::flash('mensaje', 'No puede acceder este apartado con los permisos actuales');
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
                    Session::flash('mensaje', 'No puede acceder este apartado con los permisos actuales');
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
        Session::flash('mensaje', 'La notificación ha sido eliminada exitosamente');
        return redirect()->route('notificaciones');
        
    }

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
                  Session::flash('mensaje', 'No puede acceder este apartado con los permisos actuales');
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
           
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador

        if($sessionId<>""){
            if($sessionTipo == "Cliente"){

                //Proceso para alertas de cumpleaños
                $usuarioCumpleaños=Usuarios::where('id','=',$sessionId)
                    ->get();
                $hoy = date('Y-m-d');
                
                $numeroNotificacionesDeCumpleañosExistentes=Notificaciones::where('fechaEnvio','=',$hoy)
                    ->where('asunto','=','Cumpleaños')
                    ->where('usuarioId','=',$sessionId)
                    ->get();
                $resultados = $numeroNotificacionesDeCumpleañosExistentes->count();
                
                $fechaCumpleaños = $usuarioCumpleaños[0]->fechaDeNacimiento;

                $diaFechaCumpleaños = date('d', strtotime($fechaCumpleaños));
                $mesFechaCumpleaños = date('m', strtotime($fechaCumpleaños));

                $diaHoy = date('d', strtotime($hoy));
                $mesHoy = date('m', strtotime($hoy));

                // echo  " diacumpleaños: ". $diaFechaCumpleaños." mes cumpleaños: ". $mesFechaCumpleaños. "  dia de hoy: ".$diaHoy." mes de hoy: ".$mesHoy;


                if($resultados == 0 && $diaFechaCumpleaños == $diaHoy && $mesFechaCumpleaños == $mesHoy){
                    
                    Notificaciones::create(array(
                        'fechaEnvio' => $fechaCumpleaños,
                        'titulo' => "Feliz Cumpleaños",
                        'asunto' => "Cumpleaños",
                        'mensaje' => "Le deseamos un feliz cumpleaños, que viva esta fecha con mucha alegría.",
                        'usuarioId' => $sessionId
                    ));
                }

                $notificaciones = Notificaciones::where("usuarioId", "=", $sessionId)
                ->orderBy('fechaEnvio', 'desc')
                    ->paginate(6);
                $usuarios = Usuarios::all();
            

                return view('notificaciones')
                    ->with('usuarios', $usuarios)
                    ->with('notificaciones', $notificaciones);
            }
            else{
                Session::flash('mensaje', 'No puede acceder este apartado con los permisos actuales');
            return redirect()->route('login');
            }
            
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }
    }


    public function filterRemitenteNotificacion(Request $request){

        $notificaciones = Notificaciones::where("usuarioId","=",$request->remitente)
            ->get();
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
                Session::flash('mensaje', 'No puede acceder este apartado con los permisos actuales');
            return redirect()->route('login');
            }
            
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }
                
    }

    public function filterAsuntoNotificacion(Request $request){

        $notificaciones = Notificaciones::where("asunto","like",$request->asunto."%")
            ->orderBy('updated_at', 'desc')
            ->get();

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
                    Session::flash('mensaje', 'No puede acceder este apartado con los permisos actuales');
                return redirect()->route('login');
                }
                
            }
            else{
                Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            }
                
    }

    public function filterFechaNotificacion(Request $request){

        $notificaciones = Notificaciones::where("fechaEnvio","=",$request->fecha)
            ->orderBy('updated_at', 'desc')
            ->get();

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
                    Session::flash('mensaje', 'No puede acceder este apartado con los permisos actuales');
                return redirect()->route('login');
                }
                
            }
            else{
                Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            }  
                
    }

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

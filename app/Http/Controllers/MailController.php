<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\correoElectronicoMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Prospectos;
use Session;

class MailController extends Controller
{
    public function correos(){

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                $prospectos = Prospectos::all();

                return view('mail.correos')
                    ->with('prospectos', $prospectos);;
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

    public function enviarCorreo(Request $request){

        $this->validate($request,[
            
            'titulo' => 'required',
            'asunto' => 'required',
            'mensaje' => 'required',
            'correoElectronico' => 'required|email',
            // 'usuarioId' => 'required',

        ]);

        $titulo = $request->titulo;
        $asunto = $request->asunto;
        $mensaje = $request->mensaje;
        $correoElectronico = $request->correoElectronico;

        $data = [
            'titulo' => $titulo,
            'asunto' => $asunto,
            'mensaje' => $mensaje
        ];

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                Mail::to($correoElectronico)->send(new correoElectronicoMail($data));
                Session::flash('correo', 'Correo enviado exitosamente');
                return redirect()->route('correos');
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

        // Mail::to('josuemanjarrezcareaga.2001@gmail.com')->send(new correoElectronicoMail());
        // return view('mail.correos');
    }
}

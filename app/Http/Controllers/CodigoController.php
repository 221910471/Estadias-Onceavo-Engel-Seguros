<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Codigos;
use App\Models\Usuarios;
use Session;


class CodigoController extends Controller
{
    
    public function codigos(){
        $codigos = Codigos::orderBy('updated_at', 'desc')
            ->withTrashed()
            ->get();

        $usuarios = Usuarios::orderBy('updated_at', 'desc')
            ->withTrashed()
            ->get();
        
        

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.codigos.codigos')
                    ->with('codigos', $codigos)
                    ->with('usuarios', $usuarios);
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

    public function generarCodigos(Request $request){

        $this->validate($request,[
            
            'numero' => 'required',
            'porcentaje' => 'required'

        ]);
            
            $numeroDeCodigosNuevos = $request->input('numero');
            $porcentajeDeDescuento = $request->input('porcentaje');
            
            // Obtiene la fecha actual
            $fecha_actual = date('Y-m-d');
            // Suma un mes a la fecha actual
            $nueva_fecha = date('Y-m-d', strtotime('+1 month', strtotime($fecha_actual)));
            // Imprime la nueva fecha

            $sessionId = session('sessionId');

            for ($i = 0; $i < $numeroDeCodigosNuevos; $i++) {

                $uniqid = uniqid();
                $cadena1 = substr($uniqid, 0, 4);
                $cadena2 = substr($uniqid, 4, 4);
                $cadena3 = substr($uniqid, 8, 4);
                $resultUniqid = $cadena1 . "-" . $cadena2 . "-" . $cadena3;

                Codigos::create(array(
                    'codigo' => $resultUniqid,
                    'porcentaje' => $porcentajeDeDescuento,
                    'fechaDeVencimiento' => $nueva_fecha,
                    'usuarioId' => 0,
                ));
            }
            

        
            $sessionTipo = session('sessionTipo');
    
            if($sessionId<>""){
                if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                    return redirect('codigos');
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

    public function eliminarCodigo($id){
        $codigo = Codigos::find($id);
        $codigo->delete();
        Session::flash('mensaje', 'El código ha sido cambiado a usado');
        return redirect()->route('codigos');
        
    }

    public function activarCodigo($id){
        $codigo2 = Codigos::withTrashed()->where('id',$id)->restore();
        Session::flash('mensaje', 'El código ha sido cambiado a no usado');
        return redirect()->route('codigos');
    }

    public function descuentos(){

         // validar que tenga una sesión activa en esa pantalla, dentro del controlador
         $sessionId = session('sessionId');
         $sessionTipo = session('sessionTipo');
 
         if($sessionId<>""){
             if($sessionTipo == "Cliente"){
                 return view('descuentos');
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

    public function ingresarCodigo(Request $request){
        $this->validate($request,[
            
            'codigo' => 'required'

        ]);
        $codigoIngresado = $request->input('codigo');
        
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Cliente"){
    
                // validar que tenga una sesión activa en esa pantalla, dentro del controlador

                $registroCodigo = Codigos::where("codigo","=",$codigoIngresado)
                    ->pluck('id')
                    ->first();

                $codigoSave = Codigos::find($registroCodigo);
                $codigoSave->usuarioId = $sessionId;
                $codigoSave->save();
                Session::flash('mensaje', 'El código ha sido usado, y se aplicará a su próxima compra');
                // return view('descuentos');
                return redirect('descuentos');
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

    public function prueba(Request $request){
        // echo $request->input('codigo');
        echo "hola";
    }
}

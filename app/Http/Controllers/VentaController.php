<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;
use App\Models\Ventas;
use Session;
use PDF;

class VentaController extends Controller
{
    public function ventas(){
        // $ventas = Ventas::all();
        $usuarios = Usuarios::withTrashed()
            ->get();

        $ventas = Ventas::orderBy('updated_at', 'desc')
            ->withTrashed()
            ->get();
        
        

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.ventas.ventas')
                    ->with('usuarios', $usuarios)
                    ->with('ventas', $ventas);
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

    public function createVenta(Request $request){

        $this->validate($request,[
            
            'clave' => 'required|unique:ventas',
            'comision' => 'required|regex:/([0-9]*[.])?[0-9]+$/'

        ]);

            $sessionId = session('sessionId');

            $date = date('Ymd');
            Ventas::create(array(
                'clave' => $request->input('clave'),
                'comision' => $request->input('comision'),
                'fecha' => $date,
                'usuarioId' => $sessionId,
            ));

        
            $sessionTipo = session('sessionTipo');
    
            if($sessionId<>""){
                if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                    return redirect('ventas');
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

    public function deleteVenta($id){
        $ventas = Ventas::find($id);
        $ventas->delete();
        Session::flash('mensaje', 'La venta ha sido eliminada');
        return redirect()->route('ventas');
        
    }

    public function activateVenta($id){
        $ventas2 = Ventas::withTrashed()->where('id',$id)->restore();
        Session::flash('mensaje', 'La venta ha sido restaurada con éxito');
        return redirect()->route('ventas');
    }

    public function editVenta(Request $request, $id){
        
        
        $this->validate($request,[
            
            'clave' => 'required',
            'comision' => 'required|regex:/[0-9]$/'
        ]);

        $sessionId = session('sessionId');

        $date = date('Ymd');

        $sessionTipo = session('sessionTipo');

        $ventasSave = Ventas::find($id);
            $ventasSave->clave = $request->clave;
            $ventasSave->comision = $request->comision;
            $ventasSave->fecha = $date;
            $ventasSave->usuarioId = $sessionId;
        $ventasSave->save();
         
    
        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                Session::flash('mensaje', 'Los datos de la venta han sido actualizados correctamente');
                return redirect('ventas');
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

    public function filterActivoVenta(Request $request){

        switch ($request->activo) {
            case 1:
                $ventas = Ventas::all();
                    // ->orderBy('updated_at', 'desc')
                    // ->get();
                break;
            case 2:
                $ventas = Ventas::onlyTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();
                break;
            default:
                $ventas = Ventas::withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();

                // $usuarios = Usuarios::withTrashed()
                // ->get();
                break;
                
        }

        $usuarios = Usuarios::withTrashed()
            ->get();  

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.ventas.ventas')
                    ->with('usuarios', $usuarios)
                    ->with('ventas', $ventas);
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

    public function filterClaveVenta(Request $request){

        $clave = $request->clave;
        
        $ventas = Ventas::where("clave","like",$request->clave."%")
            ->withTrashed()
            ->orderBy('updated_at', 'desc')
            ->get();

        $usuarios = Usuarios::withTrashed()
            ->get();  

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.ventas.ventas')
                    ->with('usuarios', $usuarios)
                    ->with('ventas', $ventas);
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

    public function filterFechaVenta(Request $request){

        $ventas = Ventas::where("fecha","=",$request->fecha)
            ->withTrashed()
            ->orderBy('updated_at', 'desc')
            ->get();

        $usuarios = Usuarios::withTrashed()
            ->get();  

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.ventas.ventas')
                    ->with('usuarios', $usuarios)
                    ->with('ventas', $ventas);
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
}

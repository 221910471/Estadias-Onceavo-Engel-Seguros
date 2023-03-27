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
        $usuarios = Usuarios::all();

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
                Session::flash('mensaje', 'No puede acceder este apartado');
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
            'comision' => 'required|regex:/[0-9]$/'

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
                    Session::flash('mensaje', 'No puede acceder este apartado');
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
                Session::flash('mensaje', 'Registro Actualizado Correctamente');
                return redirect('ventas');
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

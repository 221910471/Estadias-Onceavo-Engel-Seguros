<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagos;
use App\Models\Usuarios;
use App\Models\Polizas;
use App\Models\Codigos;
use Illuminate\Pagination\Paginator;
use Session;
use PDF;

class PagoController extends Controller
{
    public function pagos(){
        $pagos = pagos::orderBy('updated_at', 'desc')
            ->withTrashed()
            ->get();
        $polizas = Polizas::all();
        $usuarios = Usuarios::all();
        $codigos = Codigos::all();
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.pagos.pagos')
                    ->with('usuarios', $usuarios)
                    ->with('polizas', $polizas)
                    ->with('codigos', $codigos)
                    ->with('pagos', $pagos);
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

    public function createPago(Request $request){

        $this->validate($request,[
            
            // 'clave' => 'required|unique:Pagos',
            'frecuenciaDePago' => 'required',
            'fechaLimiteDePago' => 'required',
            'estado' => 'required',
            'formaDePago' => 'required',
            'montoDePago' => 'required',
            'polizaId' => 'required',
            'usuarioId' => 'required'

        ]);
            $date = date('Ymd_His_');
            $fecha = date('Ymd');

            $texto = "C-";
            $clave = $texto.$date;

            $valorMonto = $request->input('montoDePago');
            $valorDescuento = $request->input('descuentoRealizado'); 

            if($valorDescuento != ''){
                $porcentajeDescuento = $valorDescuento/100;
                $valorDelDescuento = $valorMonto*$porcentajeDescuento;
                $valorSubtotal = $valorMonto-$valorDelDescuento;
            }
            else{
                $valorDescuento = 0;
                $valorSubtotal = $valorMonto;
            }

            


            echo $valorDescuento;

            Pagos::create(array(
                'clave' => $clave,
                'frecuenciaDePago' => $request->input('frecuenciaDePago'),
                'fechaDePago' => $fecha,
                'fechaLimiteDePago' => $request->input('fechaLimiteDePago'),
                'estado' => $request->input('estado'),
                'formaDePago' => $request->input('formaDePago'),
                'montoDePago' => $request->input('montoDePago'),
                'polizaId' => $request->input('polizaId'),
                'usuarioId' => $request->input('usuarioId'),
                'descuentoRealizado' => $valorDescuento,
                'subtotal' => $valorSubtotal,

            ));

            $usuarioId = $request->input('usuarioId');
            $codigoParaEliminar = Codigos::where("usuarioId","=",$usuarioId)
            ->where("porcentaje","=",$valorDescuento)
            ->first();
            echo $codigoParaEliminar;
            $idDelCodigoEliminar = $codigoParaEliminar->id;
            
            $codigo = Codigos::find($idDelCodigoEliminar);
            $codigo->delete();

            
            
            $sessionId = session('sessionId');
        
            $sessionTipo = session('sessionTipo');
    
            if($sessionId<>""){
                if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                    return redirect('pagos');
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

    public function deletePago($id){
        $pagos = Pagos::find($id);
        $pagos->delete();
        Session::flash('mensaje', 'El pago ha sido eliminado exitosamente');
        return redirect()->route('pagos');
        
    }

    public function activatePago($id){
        $pagos2 = Pagos::withTrashed()->where('id',$id)->restore();
        Session::flash('mensaje', 'El pago ha sido restaurado con éxito');
        return redirect()->route('pagos');
    }

    public function editPago(Request $request, $id){
        
        
        $this->validate($request,[
            
            'frecuenciaDePago' => 'required',
            'fechaLimiteDePago' => 'required',
            'estado' => 'required',
            'formaDePago' => 'required',
            'montoDePago' => 'required',
            // 'descuentoRealizado' => 'required',
            // 'subtotal' => 'required',
            'polizaId' => 'required',
            'usuarioId' => 'required'

        ]);
        

        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        $pagosSave = Pagos::find($id);
            $pagosSave->clave = $request->clave;
            $pagosSave->frecuenciaDePago = $request->frecuenciaDePago;
            $pagosSave->fechaDePago = $request->fechaDePago;
            $pagosSave->fechaLimiteDePago = $request->fechaLimiteDePago;
            $pagosSave->estado = $request->estado;
            $pagosSave->formaDePago = $request->formaDePago;
            $pagosSave->montoDePago = $request->montoDePago;
            $pagosSave->descuentoRealizado = 0;
            $pagosSave->subtotal = $request->montoDePago;
            $pagosSave->polizaId = $request->polizaId;
            $pagosSave->usuarioId = $request->usuarioId;
        $pagosSave->save();
         
    
        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                Session::flash('mensaje', 'Registro actualizado correctamente');
                return redirect('pagos');
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

    public function pagosCliente(){

        Paginator::useBootstrapFour();

        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');
       
        $pagos = Pagos::where("usuarioId", "=", $sessionId)
        ->orderBy('fechaLimiteDePago', 'desc')
            ->paginate(6);
        $usuarios = Usuarios::all();
        $codigos = Codigos::all();
        
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador

        if($sessionId<>""){
            if($sessionTipo == "Cliente"){
                return view('pagos')
                    ->with('usuarios', $usuarios)
                    ->with('codigos', $codigos)
                    ->with('pagos', $pagos);
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




    public function filterActivoPago(Request $request){

        switch ($request->activo) {
            case 1:
                $pagos = Pagos::all();
                    // ->orderBy('updated_at', 'desc')
                    // ->get();
                break;
            case 2:
                $pagos = Pagos::onlyTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();
                break;
            default:
                $pagos = Pagos::withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();

                // $usuarios = Usuarios::withTrashed()
                // ->get();
                break;
                
        }

        $polizas = Polizas::withTrashed()
        ->orderBy('updated_at', 'desc')
        ->get();
        
        $usuarios = Usuarios::withTrashed()
        ->orderBy('updated_at', 'desc')
        ->get();
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.pagos.pagos')
                    ->with('usuarios', $usuarios)
                    ->with('polizas', $polizas)
                    ->with('pagos', $pagos);
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

    public function filterEstadoPago(Request $request){

        switch ($request->estado) {
            case 1:
                $pagos = Pagos::where("estado","=","Pagado")
                    ->withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();
                break;
            case 2:
                $pagos = Pagos::where("estado","=","Por pagar")
                    ->withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();
                break;
            default:
                $pagos = Pagos::withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();

                break;
                
        }

        $polizas = Polizas::withTrashed()
        ->orderBy('updated_at', 'desc')
        ->get();
        
        $usuarios = Usuarios::withTrashed()
        ->orderBy('updated_at', 'desc')
        ->get();
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.pagos.pagos')
                    ->with('usuarios', $usuarios)
                    ->with('polizas', $polizas)
                    ->with('pagos', $pagos);
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

    public function filterFechaPago(Request $request){

        $pagos = Pagos::where("fechaDePago","=",$request->fecha)
        ->withTrashed()
        ->orderBy('updated_at', 'desc')
        ->get();

        $polizas = Polizas::withTrashed()
        ->orderBy('updated_at', 'desc')
        ->get();

        $usuarios = Usuarios::withTrashed()
        ->orderBy('updated_at', 'desc')
        ->get();
        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.pagos.pagos')
                    ->with('usuarios', $usuarios)
                    ->with('polizas', $polizas)
                    ->with('pagos', $pagos);
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

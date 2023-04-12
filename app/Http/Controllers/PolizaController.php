<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Polizas;
use App\Models\Usuarios;
use App\Models\UsuariosPolizas;
use App\Models\Ventas;
use Session;

class PolizaController extends Controller
{
    public function polizas(){
        // $polizas = Polizas::all();
        // $usuarios = Usuarios::all();

        $polizas = Polizas::withTrashed()
            ->orderBy('updated_at', 'desc')
            ->get();

        $usuarios = Usuarios::withTrashed()
            ->get();

        $usuarios_polizas = UsuariosPolizas::all();

        $ventas = Ventas::all();

        $sessionId = session('sessionId');
        // echo $sessionId;
        $sessionTipo = session('sessionTipo');
        // echo $sessionTipo;

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.polizas.polizas')
                ->with('polizas', $polizas)
                ->with('usuarios_polizas', $usuarios_polizas)
                ->with('ventas', $ventas)
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

    public function createPoliza(Request $request){
        
        echo $request;
        $this->validate($request,[
            
            'clave' => 'required|unique:polizas',
            'tipoPoliza' => 'required',
            'rutaArchivo' => 'required',
            'usuarioId' => 'required',
            'ventaId' => 'required',

        ]);
        
        //Almacenar la documentación

        if ($request->file('rutaArchivo') != '') {

            $file2 = $request->file('rutaArchivo');

            $nombreArchivo = $file2->getClientOriginalName();

            $file2->move(public_path("pdf/polizas/"), $nombreArchivo);
        }

        //Obtener la fecha actual
        $date = date('Ymd');

            Polizas::create(array(
                'clave' => $request->input('clave'),
                'rutaArchivo' => $nombreArchivo,
                'nombreArchivo' => $nombreArchivo,
                'fechaDeRegistro' => $date,
                'tipoPoliza' => $request->input('tipoPoliza'),
                'ventaId' => $request->input('ventaId'),
            ));
            //consultamos el id del ultimo registro(que se creo inmediatamente antes)
            $consulta = Polizas::latest('id')->first();
            $ultimoId = $consulta->id;

            UsuariosPolizas::create(array(
                'polizaId' => $ultimoId,
                'usuarioId' => $request->input('usuarioId'),
            ));
        


        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return redirect()->route('polizas');
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

    public function editPoliza(Request $request, $id){
        
        $this->validate($request,[
            
            'clave' => 'required',
            'tipoPoliza' => 'required',
            'rutaArchivo' => 'required',
            'usuarioId' => 'required',
            'ventaId' => 'required',

        ]);

        //Almacenar la documentación

        if ($request->file('rutaArchivo') != '') {

            $file2 = $request->file('rutaArchivo');

            $nombreArchivo = $file2->getClientOriginalName();

            $file2->move(public_path("pdf/polizas/"), $nombreArchivo);
        }

        //Obtener la fecha actual
        $date = date('Ymd');

            $polizasSave = Polizas::find($id);
                $polizasSave->clave = $request->clave;
                $polizasSave->rutaArchivo = $nombreArchivo;
                $polizasSave->nombreArchivo = $nombreArchivo;
                $polizasSave->fechaDeRegistro = $date;
                $polizasSave->tipoPoliza = $request->tipoPoliza;
                $polizasSave->ventaId = $request->ventaId;
            $polizasSave->save();

            $consulta = Polizas::latest('updated_at')->first();
            $ultimoUpdate = $consulta->id;

            //Consultamos el id de la tabla pivote "UsuariosPolizas" donde sea igual al id de la ultima poliza actualizada
            $idPolizaUsuario = UsuariosPolizas::where('polizaId', $ultimoUpdate)
                ->get();
                
            $idPivote=$idPolizaUsuario[0]->id;
            
            $polizasUsuariosSave = UsuariosPolizas::find($idPivote);
                $polizasUsuariosSave->polizaId = $ultimoUpdate;
                $polizasUsuariosSave->usuarioId = $request->usuarioId;
            $polizasUsuariosSave->save();
            

        // validar que tenga una sesión activa en esa pantalla, dentro del controlador
        $sessionId = session('sessionId');
        $sessionTipo = session('sessionTipo');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                Session::flash('mensaje', 'Los datos de la pólizan ha sido actualizados correctamente');
                return redirect()->route('polizas');
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

    public function deletePoliza($id){
        $polizas = Polizas::find($id);
        $polizas->delete();
        Session::flash('mensaje', 'La póliza ha sido eliminada exitosamente');
        return redirect()->route('polizas');
        
    }

    public function activatePoliza($id){
        $polizas = Polizas::withTrashed()->where('id',$id)->restore();
        Session::flash('mensaje', 'La póliza ha sido restaurada con éxito');
        return redirect()->route('polizas');
    }

    public function filterActivo(Request $request){

        switch ($request->activo) {
            case 1:
                $polizas = Polizas::all();
                    // ->orderBy('updated_at', 'desc')
                    // ->get();
                break;
            case 2:
                $polizas = Polizas::onlyTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();
                break;
            default:
                $polizas = Polizas::withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();

                // $usuarios = Usuarios::withTrashed()
                // ->get();
                break;
                
        }

        $usuarios = Usuarios::withTrashed()
            ->get();

        $usuarios_polizas = UsuariosPolizas::all();

        $ventas = Ventas::all();

        $sessionId = session('sessionId');
        // echo $sessionId;
        $sessionTipo = session('sessionTipo');
        // echo $sessionTipo;


        $sessionId = session('sessionId');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.polizas.polizas')
                ->with('polizas', $polizas)
                ->with('usuarios_polizas', $usuarios_polizas)
                ->with('ventas', $ventas)
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

    public function filterClave(Request $request){

        $clave = $request->clave;
        
        $polizas = Polizas::where("clave","like",$request->clave."%")
            ->withTrashed()
            ->orderBy('updated_at', 'desc')
            ->get();

        $usuarios = Usuarios::withTrashed()
            ->get();

        $usuarios_polizas = UsuariosPolizas::all();

        $ventas = Ventas::all();

        $sessionId = session('sessionId');
        // echo $sessionId;
        $sessionTipo = session('sessionTipo');
        // echo $sessionTipo;


        $sessionId = session('sessionId');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.polizas.polizas')
                ->with('polizas', $polizas)
                ->with('usuarios_polizas', $usuarios_polizas)
                ->with('ventas', $ventas)
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

    public function filterTipoPoliza(Request $request){

        switch ($request->tipoPoliza) {
            case "Médico":
                $polizas = Polizas::where("tipoPoliza","=","Médico")
                    ->withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();
                break;
            case "Daños":
                $polizas = Polizas::where("tipoPoliza","=","Daños")
                    ->withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();
                break;
            case "Vida":
                $polizas = Polizas::where("tipoPoliza","=","Vida")
                    ->withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();
                break;
            default:
                $polizas = Polizas::withTrashed()
                    ->orderBy('updated_at', 'desc')
                    ->get();

                // $usuarios = Usuarios::withTrashed()
                // ->get();
                break;
                
        }

        $usuarios = Usuarios::withTrashed()
            ->get();

        $usuarios_polizas = UsuariosPolizas::all();

        $ventas = Ventas::all();

        $sessionId = session('sessionId');
        // echo $sessionId;
        $sessionTipo = session('sessionTipo');
        // echo $sessionTipo;


        $sessionId = session('sessionId');

        if($sessionId<>""){
            if($sessionTipo == "Administrador" || $sessionTipo == "Interno"){
                return view('crud.polizas.polizas')
                ->with('polizas', $polizas)
                ->with('usuarios_polizas', $usuarios_polizas)
                ->with('ventas', $ventas)
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

}

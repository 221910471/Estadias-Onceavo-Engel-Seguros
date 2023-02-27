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
                Session::flash('mensaje', 'No puede acceder este apartado');
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
                Session::flash('mensaje', 'No puede acceder este apartado');
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

            Polizas::query()->update(array(
                'clave' => $request->input('clave'),
                'rutaArchivo' => $nombreArchivo,
                'nombreArchivo' => $nombreArchivo,
                'fechaDeRegistro' => $date,
                'tipoPoliza' => $request->input('tipoPoliza'),
                'ventaId' => $request->input('ventaId'),
            ));

            $consulta = Polizas::latest('created_at')->first();
            $ultimoUpdate = $consulta->id;

            UsuariosPolizas::query()->update(array(
                'polizaId' => $ultimoUpdate,
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
                Session::flash('mensaje', 'No puede acceder este apartado');
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
        Session::flash('mensaje', 'La póliza ha sido eliminado');
        return redirect()->route('polizas');
        
    }

    public function activatePoliza($id){
        $polizas = Polizas::withTrashed()->where('id',$id)->restore();
        Session::flash('mensaje', 'La póliza ha sido restaurado con éxito');
        return redirect()->route('polizas');
    }

}

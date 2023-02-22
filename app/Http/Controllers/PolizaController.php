<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Polizas;
use Session;

class PolizaController extends Controller
{
    public function polizas(){
        $polizas = Polizas::all();

        $sessionId = session('sessionId');
        if($sessionId<>""){
            return view('crud.polizas.polizas')
            ->with('polizas', $polizas);
        }
        else{
            Session::flash('mensaje', 'Por favor inicie sesión para continuar');
            return redirect()->route('login');
        }
    }
}

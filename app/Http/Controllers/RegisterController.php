<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
// use App\Models\User;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show(){
        if(Auth::check()){
            return redirect()->route('home.index');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request){
        
        $Usuarios= Usuarios::create($request->validated());
        auth()->login($Usuarios);
        return redirect('/home')->with('success', "Account successfully registered.");
        
    }
}

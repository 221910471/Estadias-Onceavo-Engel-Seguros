<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function show()
    {
        if(Auth::check()){
            return redirect()->route('home.index');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        
        if(!Auth::validate($credentials)):
            dd('error');
           return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;
        $Usuarios = Auth::getProvider()->retrieveByCredentials($credentials);
        

        Auth::login($Usuarios);

        return $this->authenticated($request, $Usuarios);
    }

    protected function authenticated(Request $request, $Usuarios) 
    {
        return redirect()->route('home.index');
    }
}

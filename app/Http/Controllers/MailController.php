<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\correoElectronicoMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function correos(){
        return view('mail.correos');
    }

    public function enviarCorreo(){
        Mail::to('josuemanjarrezcareaga.2001@gmail.com')->send(new correoElectronicoMail());
        return view('mail.correos');
    }
}

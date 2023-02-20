<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Softdeletes;

class Usuarios extends Model
{
    use HasFactory;
    use Softdeletes;

    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'nombre',
        'apellidoPaterno',
        'apellidoMaterno',
        'telefono',
        'contrasena',
        'correoElectronico',
        'rol',
        'fechaDeNacimiento',
        'identificacion',
        'tarjetaDeCirculacion',
        'comprobanteDomiciliario',
        'estadoDeSesion',
        'activo',
        'familiaId',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'contrasena',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // public function setPasswordAttribute($value){
    //     $this->attributes['contrasena'] = bcrypt($value);
    // }
}

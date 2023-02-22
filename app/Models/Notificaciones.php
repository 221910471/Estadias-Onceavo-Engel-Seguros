<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;

    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'fechaEnvio',
        'asunto',
        'titulo',
        'mensaje',
        'usuarioId',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosPolizas extends Model
{
    use HasFactory;

    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'polizaId',
        'usuarioId',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Polizas extends Model
{
    use HasFactory;
    use Softdeletes;

    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'rutaArchivo',
        'nombreArchivo',
        'fechaDeRegistro',
        'tipoPoliza',
    ];
}

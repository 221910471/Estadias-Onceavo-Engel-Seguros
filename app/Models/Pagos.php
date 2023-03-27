<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class Pagos extends Model
{
    use HasFactory;
    use Softdeletes;

    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'clave',
        'frecuenciaDePago',
        'fechaDePago',
        'fechaLimiteDePago',
        'estado',
        'formaDePago',
        'montoDePago',
        'polizaId',
        'usuarioId',
    ];
}

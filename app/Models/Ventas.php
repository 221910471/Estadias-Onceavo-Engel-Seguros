<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'clave',
        'usuarioId',
        'fecha',
    ];
}

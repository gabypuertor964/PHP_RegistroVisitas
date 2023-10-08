<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitas extends Model
{
    use HasFactory;
    protected $fillable=['id_visit','fech_ingreso','fech_salida','id_trabajador','id_equipo','motivo','observaciones','cod_gafete'];
}

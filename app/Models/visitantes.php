<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitantes extends Model
{
    use HasFactory;
    protected $fillable=['nombres','apellidos','tip_doc','num_doc','sexo','num_tel','correo','url'];
}

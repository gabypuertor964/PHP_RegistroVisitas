<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_has_areas extends Model
{
    use HasFactory;
    protected $guarded=['token'];
    protected $fillable=['id_rol','id_area'];
}

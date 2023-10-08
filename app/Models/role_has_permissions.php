<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_has_permissions extends Model
{
    use HasFactory;
    public $timestamps=FALSE;
    protected $fillable=['permission_id','role_id'];
}

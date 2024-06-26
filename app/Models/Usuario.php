<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = ['email','password','id_rol','id_empresa','estado'];
}

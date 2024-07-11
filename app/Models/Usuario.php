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

    public function rol()
    {
        return $this->hasOne(Role::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_user');
    }

    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'id_user');
    }
}

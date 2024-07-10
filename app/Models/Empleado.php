<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = ['nombre', 'telefono', 'turno', 'ci', 'id_user', 'estado'];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'id_user');
    }
}

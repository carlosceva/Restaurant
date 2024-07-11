<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';

    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['nombre', 'telefono', 'turno', 'ci', 'id_user', 'estado'];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'id_user');
    }
}

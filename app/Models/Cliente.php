<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nombre', 'direccion', 'telefono', 'id_user', 'estado'];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'id_user');
    }
}

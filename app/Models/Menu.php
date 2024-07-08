<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion', 'estado'];

    public function detalleMenus()
    {
        return $this->hasMany(DetalleMenu::class, 'id_menu');
    }
}

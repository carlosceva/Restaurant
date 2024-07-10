<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'descripcion',
        'estado'
    ];

    public function detalleMenus()
    {
        return $this->hasMany(DetalleMenu::class, 'id_menu', 'id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_menus', 'id_menu', 'id_producto')
                    ->withPivot('id', 'estado'); // Puedes añadir más campos pivot si es necesario
    }
}

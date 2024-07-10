<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMenu extends Model
{
    protected $table = 'detalle_menus';

    protected $fillable = ['id_menu', 'id_producto', 'estado'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}

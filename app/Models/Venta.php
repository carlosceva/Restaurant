<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['id_cliente', 'id_servicio', 'fecha', 'estado', 'id_promocion', 'total', 'id_empleado'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }

    public function promocion()
    {
        return $this->belongsTo(Promocion::class, 'id_promocion');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }
    
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id');
    }

}

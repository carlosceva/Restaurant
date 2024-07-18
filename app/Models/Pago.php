<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id');
    }

    public function cliente()
{
    return $this->belongsTo(Cliente::class, 'id_cliente');
}
}

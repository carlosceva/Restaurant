<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    protected $table = 'promocions';

    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = ['descuento','fecha_i','fecha_f','estado'];
}

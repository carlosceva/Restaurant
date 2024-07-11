<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = ['nombre','estado'];

    public function privilegios()
    {
        return $this->hasMany(Privilegio::class, 'id_rol', 'id');
    }
}

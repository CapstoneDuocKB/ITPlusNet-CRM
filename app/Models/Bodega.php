<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $table = 'bodegas';

    protected $fillable = [
        'nombre',
        'activa',
        'sucursal_id'
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function soportes()
    {
        return $this->hasMany(Soporte::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'cajas';

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

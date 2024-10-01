<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $primaryKey = 'id';
    public $incrementing = false; // Dado que 'id' es CHAR(36)
    protected $keyType = 'string'; // La clave primaria es un string

    protected $fillable = [
        'id',
        'nombre',
        'activa',
        'direccion_id',
        'sucursal_id',
        'empresa_id',
    ];

    // Relaciones
    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function sucursalPadre()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function sucursalesHijas()
    {
        return $this->hasMany(Sucursal::class, 'sucursal_id');
    }
    public $timestamps = false;
}

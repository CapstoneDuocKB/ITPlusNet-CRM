<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas'; // Nombre de la tabla en plural

    protected $primaryKey = 'id';
    public $incrementing = false; // Indica que el id no es auto-incremental
    protected $keyType = 'string'; // Tipo de la clave primaria

    protected $fillable = [
        'rut',
        'nombre',
        'razon_social',
        'direccion_id',
        'color',
        'ruta_logo',
        'activa',
    ];

    /**
     * Relación con la tabla `direcciones`
     * Una empresa pertenece a una dirección.
     */
    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }

    /**
     * Relación con la tabla `sucursales`
     * Una empresa tiene muchas sucursales.
     */
    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    /**
     * Relación con la tabla `usuarios`
     * Una empresa tiene muchos usuarios.
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}

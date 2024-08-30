<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales'; // Nombre de la tabla en la base de datos

    // Si la clave primaria no es 'id' y es un string, puedes configurarlo así:
    protected $primaryKey = 'id';
    public $incrementing = false; // Indica que el id no es auto-incremental
    protected $keyType = 'string'; // Tipo de la clave primaria

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'activa',
        'direccion_id',
    ];

    /**
     * Relación con la tabla `direcciones`
     * Una sucursal tiene una dirección.
     */
    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }

    /**
     * Relación con la tabla `bodegas`
     * Una sucursal puede tener muchas bodegas.
     */
    public function bodegas()
    {
        return $this->hasMany(Bodega::class);
    }

    /**
     * Relación con la tabla `cajas`
     * Una sucursal puede tener muchas cajas.
     */
    public function cajas()
    {
        return $this->hasMany(Caja::class);
    }
}

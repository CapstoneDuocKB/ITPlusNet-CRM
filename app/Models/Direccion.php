<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones'; // Nombre de la tabla en plural

    protected $primaryKey = 'id';
    public $incrementing = false; // Indica que el id no es auto-incremental
    protected $keyType = 'string'; // Tipo de la clave primaria

    protected $fillable = [
        'calle',
        'numero',
        'comuna_id',
    ];

    /**
     * Relación con la tabla `comunas`
     * Una dirección pertenece a una comuna.
     */
    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'comuna_id');
    }

    /**
     * Relación con la tabla `empresas`
     * Una dirección puede estar relacionada con varias empresas.
     */
    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'direccion_id');
    }

    /**
     * Relación con la tabla `sucursales`
     * Una dirección puede estar relacionada con varias sucursales.
     */
    public function sucursales()
    {
        return $this->hasMany(Sucursal::class, 'direccion_id');
    }
}
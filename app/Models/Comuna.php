<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    use HasFactory;

    protected $table = 'comunas'; // Nombre de la tabla en plural

    protected $primaryKey = 'id';
    public $incrementing = false; // Indica que el id no es auto-incremental
    protected $keyType = 'string'; // Tipo de la clave primaria

    protected $fillable = [
        'nombre',
        'region_id',
    ];

    /**
     * Relación con la tabla `regiones`
     * Una comuna pertenece a una región.
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    /**
     * Relación con la tabla `direcciones`
     * Una comuna tiene muchas direcciones.
     */
    public function direcciones()
    {
        return $this->hasMany(Direccion::class);
    }
}
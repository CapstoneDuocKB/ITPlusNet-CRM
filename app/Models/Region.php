<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regiones'; // Nombre de la tabla en plural

    protected $primaryKey = 'id';
    public $incrementing = false; // Indica que el id no es auto-incremental
    protected $keyType = 'string'; // Tipo de la clave primaria

    protected $fillable = [
        'nombre',
    ];

    /**
     * Relación con la tabla `comunas`
     * Una región tiene muchas comunas.
     */
    public function comunas()
    {
        return $this->hasMany(Comuna::class);
    }
}
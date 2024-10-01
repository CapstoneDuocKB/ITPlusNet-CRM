<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $table = 'bodegas';

    protected $primaryKey = 'id';
    public $incrementing = false; // Dado que 'id' es CHAR(36)
    protected $keyType = 'string'; // La clave primaria no es entera

    protected $fillable = [
        'id',
        'nombre',
        'activa',
        'sucursal_id',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
    public $timestamps = false;
}

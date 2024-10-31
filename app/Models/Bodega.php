<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $table = 'bodegas';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'nombre', 'activa', 'sucursal_id'];
    public $timestamps = false;

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public static function updateOrCreateFromApiData($data)
    {
            // Verificar que sucursal_id existe en la tabla de sucursales
        if (!Sucursal::where('id', $data['sucursal'])->exists()) {
            // Omitir la inserción o registro de la bodega si sucursal_id no es válido
            return null;
        }
        return self::updateOrCreate(
            ['id' => $data['codigo']],
            [
                'nombre' => $data['descripcion'],
                'activa' => $data['activa'] ?? 1,
                'sucursal_id' => $data['sucursal'],
            ]
        );
    }
}

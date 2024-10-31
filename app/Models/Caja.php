<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'cajas';
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
        if (!Sucursal::where('id', $data['sucursal'])->exists()) {
            // Omitir la inserción o registro de la caja si sucursal_id no es válido
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

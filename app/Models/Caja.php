<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'cajas';

    protected $primaryKey = 'id';
    public $incrementing = false; // Dado que 'id' es CHAR(36)
    protected $keyType = 'string'; // La clave primaria es un string

    public $timestamps = false;


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

    // Relación polimórfica inversa
    public function usuarios()
    {
        return $this->morphToMany(Usuario::class, 'relacionable', 'relacionables');
    }

    public static function updateOrCreateFromApiData($data)
    {
        // Verificar que sucursal_id existe en la tabla de sucursales
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

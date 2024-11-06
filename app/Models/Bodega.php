<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $table = 'bodegas';

    protected $primaryKey = 'id';
<<<<<<< Updated upstream
    public $incrementing = false; // Dado que 'id' es CHAR(36)
    protected $keyType = 'string'; // La clave primaria no es entera

    protected $fillable = [
        'id',
        'nombre',
        'activa',
        'sucursal_id',
    ];
=======
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'nombre', 'activa', 'sucursal_id', 'email'];
    public $timestamps = false;
>>>>>>> Stashed changes

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
<<<<<<< Updated upstream
    public $timestamps = false;
=======

    // Relación polimórfica inversa
    public function usuarios()
    {
        return $this->morphToMany(Usuario::class, 'relacionable', 'relacionables');
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
                'email' => $data['email'] ?? 'sinemail@ejemplo.com',
            ]
        );
    }
>>>>>>> Stashed changes
}

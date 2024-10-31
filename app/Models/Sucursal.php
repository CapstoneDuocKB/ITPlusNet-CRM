<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'nombre', 'activa', 'direccion_id', 'empresa_id'];
    public $timestamps = false;

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public static function updateOrCreateFromApiData($data)
    {
        return self::updateOrCreate(
            ['id' => $data['codigo']],
            [
                'nombre' => $data['descripcion'],
                'activa' => $data['activa'] ?? 1,
                'direccion_id' => $data['direccion_id'] ?? null,
                'empresa_id' => $data['empresa_id'] ?? null,
            ]
        );
    }
}

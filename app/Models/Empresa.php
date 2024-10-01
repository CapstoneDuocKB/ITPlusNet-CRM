<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $primaryKey = 'id';
    public $incrementing = false; // 'id' es CHAR(36)
    protected $keyType = 'string'; // La clave primaria es un string

    protected $fillable = [
        'id',
        'rut',
        'nombre',
        'razon_social',
        'direccion_id',
        'color',
        'ruta_logo',
        'activa',
    ];

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }
}

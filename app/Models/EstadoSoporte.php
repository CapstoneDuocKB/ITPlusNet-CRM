<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSoporte extends Model
{
    use HasFactory;

    protected $table = 'estados_soporte';

    protected $primaryKey = 'id';
    public $incrementing = false; // 'id' es CHAR(36)
    protected $keyType = 'string'; // La clave primaria es un string

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
    ];

    public $timestamps = false; // Si la tabla no tiene campos 'created_at' y 'updated_at'
}

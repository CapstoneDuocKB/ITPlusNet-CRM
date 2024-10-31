<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DificultadSoporte extends Model
{
    use HasFactory;

    protected $table = 'dificultades_soporte';

    protected $primaryKey = 'id';
    public $incrementing = false; // 'id' es CHAR(36)
    protected $keyType = 'string'; // La clave primaria es un string

    public $timestamps = false; // La tabla no tiene campos 'created_at' ni 'updated_at'

    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'uf',
    ];
}

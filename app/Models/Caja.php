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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSoporte extends Model
{
    use HasFactory;

    protected $table = 'estado_soportes';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function soportes()
    {
        return $this->hasMany(Soporte::class);
    }
}

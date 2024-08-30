<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSoporte extends Model
{
    use HasFactory;

    protected $table = 'tipo_soportes';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function soportes()
    {
        return $this->hasMany(Soporte::class);
    }
}

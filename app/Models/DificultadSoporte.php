<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DificultadSoporte extends Model
{
    use HasFactory;

    protected $table = 'dificultad_soportes';

    protected $fillable = [
        'nombre',
        'descripcion',
        'uf'
    ];

    public function soportes()
    {
        return $this->hasMany(Soporte::class);
    }
}

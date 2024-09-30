<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Soporte extends Model
{
    use HasFactory;

    protected $table = 'soportes';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'bodega_id',
        'caja_id',
        'celular',
        'descripcion',
        'dificultad_soporte_id',
        'email',
        'estado_soporte_id',
        'horas_hombre',
        'solucion',
        'tipo_soporte_id',
        'uf',
        'urgente',
    ];

    protected $casts = [
        'id' => 'string',
        'urgente' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generar el siguiente número de soporte
            $maxNumeroSoporte = Soporte::max('numero_soporte');
            $model->numero_soporte = $maxNumeroSoporte ? $maxNumeroSoporte + 1 : 1;

            // Generar un UUID si no se ha proporcionado uno
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relaciones (relaciones con otras tablas)

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'bodega_id');
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }

    public function dificultadSoporte()
    {
        return $this->belongsTo(DificultadSoporte::class, 'dificultad_soporte_id');
    }

    public function estadoSoporte()
    {
        return $this->belongsTo(EstadoSoporte::class, 'estado_soporte_id');
    }

    public function tipoSoporte()
    {
        return $this->belongsTo(TipoSoporte::class, 'tipo_soporte_id');
    }

    // Relación uno a muchos con ImgSoporte (un soporte tiene muchas imágenes)
    public function soporteImagenes()
    {
        return $this->hasMany(SoporteImagen::class, 'soporte_id');
    }
}

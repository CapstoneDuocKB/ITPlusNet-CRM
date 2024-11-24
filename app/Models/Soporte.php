<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Soporte extends Model
{
    use HasFactory;

    protected $table = 'soportes';

    public $incrementing = false; // 'id' es CHAR(36)

    protected $keyType = 'string'; // La clave primaria es un string

    protected $fillable = [
        'id', // Añadido si deseas permitir la asignación masiva de 'id'
        'bodega_id',
        'sucursal_id',
        'caja_id', // Eliminado el duplicado
        'celular',
        'descripcion',
        'dificultad_soporte_id',
        'email',
        'estado_soporte_id',
        'horas_hombre',
        'solucion',
        'tipo_soporte_id',
        'estado_cobranza_id',
        'fecha_estimada_entrega',
        'uf',
        'urgente',
    ];

    protected $casts = [
        'id' => 'string',
        'urgente' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'horas_hombre' => 'float',
        'uf' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generar el siguiente número de soporte de forma segura
            $maxNumeroSoporte = Soporte::max('numero_soporte');
            $model->numero_soporte = $maxNumeroSoporte ? $maxNumeroSoporte + 1 : 1;

            // Generar un UUID si no se ha proporcionado uno
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relaciones con otros modelos
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }
    
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

    public function estadoCobranza()
    {
        return $this->belongsTo(EstadoCobranza::class, 'estado_cobranza_id');
    }

    // Relación uno a muchos con SoporteImagen (un soporte tiene muchas imágenes)
    public function imagenes()
    {
        return $this->hasMany(SoporteImagen::class, 'soporte_id');
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class, 'soporte_id');
    }
}

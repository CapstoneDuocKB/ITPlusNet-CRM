<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class HistorialEstado extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'historiales_estado';

    /**
     * El nombre de la clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indica si las claves primarias son incrementales.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * El tipo de la clave primaria.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indica si el modelo debe gestionar los timestamps.
     * Solo 'created_at' está presente en la tabla.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'comentario',
        'soporte_id',
        'estado_soporte_id',
        'usuario_id',
    ];

    /**
     * Boot function del modelo.
     * Genera automáticamente un UUID al crear una nueva instancia.
     */
    protected static function boot()
    {
        parent::boot();

        // Generar UUID al crear un nuevo registro
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Relación con el modelo Soporte.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soporte(): BelongsTo
    {
        return $this->belongsTo(Soporte::class, 'soporte_id');
    }

    /**
     * Relación con el modelo EstadoSoporte.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estadoSoporte(): BelongsTo
    {
        return $this->belongsTo(EstadoSoporte::class, 'estado_soporte_id');
    }

    /**
     * Relación con el modelo Usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Conversation extends Model
{
    // Indicar que la clave primaria no es auto-incremental y es de tipo string
    public $incrementing = false;
    protected $keyType = 'string';

    // Permitir asignación masiva en estos campos
    protected $fillable = [
        'id',
        'soporte_id',
    ];

    // Relación con mensajes
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Generar UUID automáticamente al crear un nuevo registro
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
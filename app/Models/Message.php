<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    // Indicar que la clave primaria no es auto-incremental y es de tipo string
    public $incrementing = false;
    protected $keyType = 'string';

    // Permitir asignación masiva en estos campos
    protected $fillable = [
        'id',
        'conversation_id',
        'role',
        'content',
    ];

    // Relación con conversación
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
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

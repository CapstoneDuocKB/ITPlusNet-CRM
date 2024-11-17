<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SoporteImagen extends Model
{
    use HasFactory;

    protected $table = 'soporte_imagenes'; // Laravel sabrá que corresponde a la tabla soporte_imagenes

    public $incrementing = false;
    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = [
        'soporte_id',
        'ruta',
    ];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function soporte()
    {
        return $this->belongsTo(Soporte::class, 'soporte_id');
    }
}

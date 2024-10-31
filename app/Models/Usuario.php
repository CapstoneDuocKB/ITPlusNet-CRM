<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'rut',
        'name',
        'email',
        'password',
        'telefono',
        'direccion_id',
        'empresa_id',
        'activo',
    ];

    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public static function updateOrCreateFromApiData($data)
{
    return self::updateOrCreate(
        ['id' => $data['codigo']],
        [
            'rut' => $data['rut'] ?? null,
            'name' => $data['usuario'] ?? 'Sin Nombre',
            'email' => $data['email'] ?? 'sinemail@ejemplo.com',
            'telefono' => $data['telefono'] ?? null,
            'direccion_id' => $data['direccion_id'] ?? null,
            'empresa_id' => $data['empresa_id'] ?? null,
            'activo' => $data['activo'] ?? 1,
            'password' => bcrypt('contraseña_genérica'), // Valor predeterminado para password
        ]
    );
}
}

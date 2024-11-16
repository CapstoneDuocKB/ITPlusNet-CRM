<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Importar la clase Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', // Asegúrate de incluir 'id' si estás usándolo como clave primaria
        'rut',
        'name',
        'email',
        'password',
        'telefono',
        'direccion_id',
        'empresa_id',
        'activo',
        'sucursal_id',
        'caja_id',
        'bodega_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'activo' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        // Genera un UUID cuando se está creando un nuevo modelo
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    // Definición de relaciones
    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }

    public function bodega()
    {
        return $this->belongsTo(Bodega::class, 'bodega_id');
    }

    /**
     * Método para actualizar o crear un usuario desde datos de la API.
     *
     * @param array $data
     * @return \App\Models\Usuario|null
     */
    public static function updateOrCreateFromApiData($data)
    {
        // Validar que 'codigo' esté presente
        if (empty($data['codigo'])) {
            Log::warning("Usuario sin 'codigo' en los datos de la API. Se omite la importación.");
            return null;
        }

        // Validar relaciones
        $sucursalExists = Sucursal::where('id', $data['sucursal'])->exists();
        $cajaExists = Caja::where('id', $data['caja'])->exists();
        $bodegaExists = Bodega::where('id', $data['bodega'])->exists();

        if (!$sucursalExists || !$cajaExists || !$bodegaExists) {
            Log::warning("Usuario con código {$data['codigo']} tiene relaciones inválidas. Se omite la importación.");
            return null;
        }

        // Validar el correo electrónico
        $validator = Validator::make($data, [
            'email' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            Log::warning("Usuario con código {$data['codigo']} tiene un email inválido. Se asigna un valor por defecto.");
            $data['email'] = 'sinemail@ejemplo.com';
        }

        // Crear o actualizar el usuario usando 'id' como clave
        return self::updateOrCreate(
            ['id' => $data['codigo']], // Usar 'id' (codigo de la API) como clave
            [
                // Asignar solo los campos necesarios
                'name' => $data['usuario'] ?? null,
                'sucursal_id' => $data['sucursal'] ?? null,
                'caja_id' => $data['caja'] ?? null,
                'bodega_id' => $data['bodega'] ?? null,

                // Asignar otros campos a null
                'rut' => null,
                'email' => $data['email'] ?? null,
                'telefono' => null,
                'direccion_id' => null,
                'empresa_id' => null,
                'activo' => null,
                'password' => null,
            ]
        );
    }
}

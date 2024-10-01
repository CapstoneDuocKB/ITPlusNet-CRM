<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $primaryKey = 'id';
    public $incrementing = false; // 'id' es CHAR(36)
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'calle',
        'numero',
        'comuna_id',
    ];

    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'comuna_id');
    }

    public function getDescripcionAttribute()
    {
        return "{$this->calle} {$this->numero}, "
            . "{$this->comuna->nombre}";
    }
    public $timestamps = false;   
}

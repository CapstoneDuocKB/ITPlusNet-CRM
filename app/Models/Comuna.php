<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    use HasFactory;

    protected $table = 'comunas';

    protected $primaryKey = 'id';
    public $incrementing = false; // 'id' es CHAR(36)
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'nombre',
        'region_id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function direcciones()
    {
        return $this->hasMany(Direccion::class, 'comuna_id');
    }


    public $timestamps = false;    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relacionable extends Model
{
    use HasFactory;

    protected $table = 'relacionables';

    protected $fillable = [
        'usuario_id',
        'relacionable_id',
        'relacionable_type',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function relacionable()
    {
        return $this->morphTo();
    }
}

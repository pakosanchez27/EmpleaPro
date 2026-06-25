<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'user_id',
    'calle',
    'numero_exterior',
    'numero_interior',
    'codigo_postal',
    'delegacion_municipio',
    'estado',
])]
class Domicilio extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

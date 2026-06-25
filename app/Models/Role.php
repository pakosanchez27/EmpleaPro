<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable([
    'name',
    'slug',
    'description',
    'is_active',
])]
class Role extends Model
{

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}

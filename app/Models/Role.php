<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama', 'slug'])]
class Role extends Model
{
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}

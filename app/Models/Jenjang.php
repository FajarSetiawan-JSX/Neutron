<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama', 'slug', 'subtitle'])]
class Jenjang extends Model
{
    public function tingkat(): HasMany
    {
        return $this->hasMany(Tingkat::class, 'jenjang_id');
    }
}

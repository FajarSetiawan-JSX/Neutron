<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama', 'slug', 'deskripsi', 'active'])]
class Ujian extends Model
{
    public function nilai(): HasMany
    {
        return $this->hasMany(Nilai::class, 'ujian_id');
    }
}

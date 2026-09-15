<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama', 'slug'])]
class Tipe extends Model
{
    public function pertemuan(): HasMany
    {
        return $this->hasMany(Pertemuan::class, 'tipe_id');
    }
}

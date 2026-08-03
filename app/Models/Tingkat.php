<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['tingkat', 'jenjang_id'])]
class Tingkat extends Model
{
    public function jenjang(): BelongsTo
    {
        return $this->belongsTo(Jenjang::class, 'jenjang_id');
    }
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'tingkat_id');
    }
}

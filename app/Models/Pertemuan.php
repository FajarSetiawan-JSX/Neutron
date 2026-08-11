<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['rombel_id', 'pertemuan', 'materi'])]
class Pertemuan extends Model
{
    public function rombel(): BelongsTo
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }
    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class, 'absensi_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['rombel_id', 'tipe_id', 'pertemuan', 'materi', 'selesai'])]
class Pertemuan extends Model
{
    public function rombel(): BelongsTo
    {
        return $this->belongsTo(Rombel::class, 'rombel_id');
    }
    public function tipe(): BelongsTo
    {
        return $this->belongsTo(Tipe::class, 'tipe_id');
    }
    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class, 'pertemuan_id');
    }
}

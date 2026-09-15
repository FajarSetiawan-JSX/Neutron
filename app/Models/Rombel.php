<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['subjek_id', 'tahun_id', 'tingkat_id', 'name', 'slug', 'deskripsi'])]
class Rombel extends Model
{
    public function tahun(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_id');
    }
    public function subjek(): BelongsTo
    {
        return $this->belongsTo(SubjekTentor::class, 'subjek_id');
    }
    public function tingkat(): BelongsTo
    {
        return $this->belongsTo(Tingkat::class, 'tingkat_id');
    }
    public function siswa(): HasMany
    {
        return $this->hasMany(RombelSiswa::class, 'rombel_id');
    }
    public function pertemuan(): HasMany
    {
        return $this->hasMany(Pertemuan::class, 'rombel_id');
    }
}

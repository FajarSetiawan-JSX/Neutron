<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['rombel_siswa_id', 'pertemuan_id'])]
class Absensi extends Model
{
    public function pertemuan(): BelongsTo
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id');
    }
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(RombelSiswa::class, 'rombel_siswa_id');
    }
    public function nilai(): HasOne
    {
        return $this->hasOne(Nilai::class, 'absensi_id');
    }
}

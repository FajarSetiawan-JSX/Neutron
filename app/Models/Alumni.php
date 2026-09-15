<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['siswa_id', 'tahun_id'])]
class Alumni extends Model
{
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function tahun(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_id');
    }
}

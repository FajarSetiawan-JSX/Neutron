<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['absensi_id', 'ujian_id', 'nilai', 'catatan'])]
class Nilai extends Model
{
    public function absensi(): BelongsTo
    {
        return $this->belongsTo(Absensi::class, 'absensi_id');
    }
    public function ujian(): BelongsTo
    {
        return $this->belongsTo(Ujian::class, 'ujian_id');
    }
}

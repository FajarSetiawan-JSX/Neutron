<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['nama', 'slug', 'tingkat_id', 'deskripsi'])]
class Kelas extends Model
{
    public function wali(): HasOne
    {
        return $this->hasOne(KelasWali::class, 'kelas_id');
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(KelasSiswa::class, 'kelas_id');
    }
}

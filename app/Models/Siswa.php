<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['nama', 'slug', 'nis', 'sekolah', 'alamat', 'phone', 'phone_hash', 'status'])]
class Siswa extends Model
{
    public function mapel(): HasMany
    {
        return $this->hasMany(SubjekSiswa::class, 'siswa_id');
    }
    public function kelas(): HasOne
    {
        return $this->hasOne(KelasSiswa::class, 'siswa_id');
    }
    public function logsiswa(): HasMany
    {
        return $this->hasMany(LogSiswa::class, 'siswa_id');
    }
    public function rombel(): HasMany
    {
        return $this->hasMany(RombelSiswa::class, 'siswa_id');
    }
}

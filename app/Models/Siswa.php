<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['nama', 'slug', 'nis', 'sekolah', 'alamat', 'phone', 'phone_hash', 'phone_ortu', 'phone_ortu_hash', 'status', 'lulus'])]
class Siswa extends Model
{
    public function mapel(): HasMany
    {
        return $this->hasMany(SubjekSiswa::class, 'siswa_id');
    }
    public function kelas(): HasMany
    {
        return $this->hasMany(KelasSiswa::class, 'siswa_id');
    }
    public function kelasSekarang(): HasOne
    {
        return $this->hasOne(KelasSiswa::class, 'siswa_id')->whereHas('tahun', function ($query) {
            $query->where('active', '=', 1);
        })->with('kelas.tingkat.jenjang');
    }

    public function logsiswa(): HasMany
    {
        return $this->hasMany(LogSiswa::class, 'siswa_id');
    }
    public function rombel(): HasMany
    {
        return $this->hasMany(RombelSiswa::class, 'siswa_id');
    }
    public function rombelSekarang(): HasMany
    {
        return $this->hasMany(RombelSiswa::class, 'siswa_id')->whereHas('rombel.tahun', function ($query) {
            $query->where('active', '=', 1);
        })->with(['rombel']);
    }
    public function alumni(): HasOne
    {
        return $this->hasOne(Alumni::class, 'siswa_id');
    }
}

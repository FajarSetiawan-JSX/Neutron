<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['tahun', 'active'])]
class TahunAjaran extends Model
{
    public function logs(): HasMany
    {
        return $this->hasMany(KelasSiswa::class, 'tahun_id');
    }
    public function rombel(): HasMany
    {
        return $this->hasMany(Rombel::class, 'tahun_id');
    }
    public function alumni(): HasMany
    {
        return $this->hasMany(Alumni::class, 'tahun_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama', 'slug', 'singkatan'])]
class Mapel extends Model
{
    public function tentor(): HasMany
    {
        return $this->hasMany(SubjekTentor::class, 'mapel_id');
    }
    public function siswa(): HasMany
    {
        return $this->hasMany(SubjekSiswa::class, 'mapel_id');
    }
}

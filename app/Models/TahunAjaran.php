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
        return $this->hasMany(LogSiswa::class, 'tahun_id');
    }
}

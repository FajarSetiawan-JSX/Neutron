<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['tentor_id', 'mapel_id'])]
class SubjekTentor extends Model
{
    public function tentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tentor_id');
    }
    public function mapel(): BelongsTo
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    public function rombel(): HasMany
    {
        return $this->hasMany(Rombel::class, 'subjek_id');
    }
}

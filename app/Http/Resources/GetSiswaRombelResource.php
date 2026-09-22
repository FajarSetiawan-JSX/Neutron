<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetSiswaRombelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->name,
            'slug' => $this->slug,
            'tahun' => $this->tahun->tahun,
            'siswa' => $this->siswa->count(),
            'mapel' => $this->subjek?->mapel?->singkatan ?? 'Tidak ada mapel',
            'tentor' => $this->subjek?->tentor?->name ?? 'Tidak memiliki tentor',
            'tingkat' => $this->tingkat->tingkat,
            'jenjang' => $this->tingkat->jenjang->slug
        ];
    }
}

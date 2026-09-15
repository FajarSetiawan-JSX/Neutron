<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRombelByTentorResource extends JsonResource
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
            'tingkat' => $this->tingkat->tingkat,
            'tingkat_id' => $this->tingkat_id,
            'tentor' => $this->subjek->tentor->name,
            'mapel' => $this->subjek->mapel->singkatan,
            'subjek_id' => $this->subjek_id,
            'siswa' => $this->siswa()->count(),
            'deskripsi' => $this->deskripsi,
            'ta' => $this->tahun->tahun
        ];
    }
}

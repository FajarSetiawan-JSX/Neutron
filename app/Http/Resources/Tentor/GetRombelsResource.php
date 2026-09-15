<?php

namespace App\Http\Resources\Tentor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRombelsResource extends JsonResource
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
            'mapel' => $this->subjek->mapel->singkatan ?? $this->subjek->mapel->nama,
            'tingkat' => $this->tingkat->tingkat,
            'jenjang' => $this->tingkat->jenjang->slug,
            'tentor' => $this->subjek->tentor->name,
            'siswa' => $this->siswa()->count(),
            'tahun' => $this->tahun->tahun
        ];
    }
}

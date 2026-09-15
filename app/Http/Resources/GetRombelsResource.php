<?php

namespace App\Http\Resources;

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
            'tahun' => $this->tahun->tahun,
            'tentor' => $this->subjek->tentor->name,
            'avatar' => $this->subjek->tentor->avatar,
            'mapel' => $this->subjek->mapel->singkatan,
            'tingkat' => $this->tingkat->tingkat,
            'jenjang' => $this->tingkat->jenjang->slug,
            'siswa' => $this->siswa()->count()
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetSiswaResource extends JsonResource
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
            'nama' => $this->nama,
            'nis' => $this->nis,
            'sekolah' => $this->sekolah,
            'alamat' => $this->alamat,
            'phone' => decrypt($this->phone),
            'kelas' => $this->kelas?->kelas?->nama ?? null,
            'id_kelas' => $this->kelas?->kelas?->id ?? null,
            'mapel' => $this->mapel()->count() ?? null,
            'id_mapel' => $this->mapel()->pluck('mapel_id')->toArray(),
            'status' => $this->status
        ];
    }
}

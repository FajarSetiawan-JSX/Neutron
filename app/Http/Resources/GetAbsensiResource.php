<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAbsensiResource extends JsonResource
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
            'nama' => $this->siswa->siswa->nama,
            'nis' => $this->siswa->siswa->nis,
            'kelas' => $this->siswa->siswa->kelasSekarang->kelas->nama,
            'mapel' => $this->pertemuan->rombel->subjek->mapel->singkatan ?? $this->pertemuan->rombel->subjek->mapel->nama,
            'tipe' => $this->pertemuan->tipe->nama,
            'tanggal' => $this->created_at
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetNilaiResource extends JsonResource
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
            'nama' => $this->absensi->siswa->siswa->nama,
            'mapel' => $this->absensi->pertemuan->rombel->subjek->mapel->singkatan,
            'pertemuan' => $this->absensi->pertemuan->pertemuan,
            'jenis' => $this->ujian->nama,
            'nilai' => $this->nilai,
            'catatan' => $this->catatan ?? '',
            'tanggal' => $this->created_at
        ];
    }
}

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
            'nama' => $this->absensi->pertemuan->siswa->siswa->nama,
            'mapel' => $this->absensi->pertemuan->rombel->subjek->mapel->nama,
            'pertemuan' => $this->absensi->pertemuan->pertemuan,
            'jenis' => $this->ujian->nama,
            'nilai' => $this->nilai,
            'ta' => $this->absensi->pertemuan->rombel->tahun->tahun,
            'tanggal' => $this->created_at
        ];
    }
}

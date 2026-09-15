<?php

namespace App\Http\Resources\Tentor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetPertemuansResource extends JsonResource
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
            'pertemuan' => $this->pertemuan,
            'materi' => $this->materi,
            'absen' => $this->absensi()->count() ?? 0,
            'nilai' => $this->absensi->filter(fn($absen) => $absen->nilai)->count(),
            'status' => $this->selesai,
            'tanggal' => $this->created_at,
            'total' => $this->rombel->siswa()->count(),
            'tipe' => $this->tipe->nama
        ];
    }
}

<?php

namespace App\Http\Resources\Tentor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetSiswaPertemuanDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $presensi = $this->absensi->where('pertemuan_id', '=', $request->route('id'))->first();
        return [
            'id' => $this->id,
            'nama' => $this->siswa->nama,
            'nis' => $this->siswa->nis,
            'presensi' => $presensi ? 'Hadir' : 'Tidak hadir',
            'nilai' => $presensi?->nilai ? $presensi?->nilai->nilai : 'Tidak ada penilaian'
        ];
    }
}

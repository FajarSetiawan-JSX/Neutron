<?php

namespace App\Http\Resources;

use App\Models\KelasSiswa;
use App\Models\RombelSiswa;
use App\Models\TahunAjaran;
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
            'phone_ortu' => decrypt($this->phone_ortu),
            'kelas' => $this->kelasSekarang->kelas->nama ?? null,
            'id_kelas' => $this->kelasSekarang->kelas->id ?? null,
            'mapel' => $this->mapel()->count() ?? null,
            'id_mapel' => $this->mapel()->pluck('mapel_id')->toArray(),
            'rombel' => $this->rombelSekarang()->count(),
            'status' => $this->status,
            'lulus' => $this->lulus
        ];
    }
}

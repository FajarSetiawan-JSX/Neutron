<?php

namespace App\Http\Resources;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetCalonAlumniResource extends JsonResource
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
            'kelas' => $this->kelasSekarang->kelas->nama,
            'status' => $this->status == 1 ? 'Aktif' : 'Non aktif'
        ];
    }
}

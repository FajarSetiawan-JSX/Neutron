<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetKelasResource extends JsonResource
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
            'slug' => $this->slug,
            'deskripsi' => $this->deskripsi,
            'wali' => $this->wali->wali->name ?? 'Belum memiliki wali kelas.',
            'siswa' => $this->siswa()->count(),
            'tingkat' => $this->tingkat->tingkat,
            'jenjang' => $this->tingkat->jenjang->nama,
            'singkatan' => $this->tingkat->jenjang->slug
        ];
    }
}

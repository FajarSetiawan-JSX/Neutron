<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAlumniResource extends JsonResource
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
            'telp' => decrypt($this->phone),
            'ortu' => decrypt($this->phone_ortu),
            'status' => $this->status,
            'alamat' => $this->alamat,
            'ta' => $this->alumni->tahun->tahun
        ];
    }
}

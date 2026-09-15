<?php

namespace App\Http\Resources\Tentor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetSiswaKelasResource extends JsonResource
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
            'phone' => decrypt($this->phone),
            'phone_ortu' => decrypt($this->phone_ortu),
            'alamat' => $this->alamat,
            'status' => $this->status
        ];
    }
}

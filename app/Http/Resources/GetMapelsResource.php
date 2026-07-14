<?php

namespace App\Http\Resources;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetMapelsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $siswa = Siswa::count();
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'inisial' => $this->singkatan,
            'tentors' => $this->tentor->map(function ($item) {
                return [
                    'nama' => $item->tentor->name,
                    'avatar' => $item->tentor->avatar ?? null
                ];
            }),
            'total' => $siswa,
            'siswa' => $this->siswa->count()
        ];
    }
}

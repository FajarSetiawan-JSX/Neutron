<?php

namespace App\Http\Resources;

use App\Models\Rombel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetTentorResource extends JsonResource
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
            'nama' => $this->name,
            'slug' => $this->slug,
            'email' => $this->email,
            'active' => $this->active,
            'phone' => decrypt($this->phone),
            'avatar' => $this->avatar ?? null,
            'id_kelas' => $this->kelas()->pluck('kelas_id')->toArray(),
            'kelas' => $this->kelas()->get()->map(function ($item) {
                return [
                    'id' => $item->kelas->id,
                    'nama' => $item->kelas->nama
                ];
            }),
            'id_mapel' => $this->mapel()->pluck('mapel_id')->toArray(),
            'mapel' => $this->mapel()->get()->map(function ($item) {
                return [
                    'id' => $item->mapel->id,
                    'nama' => $item->mapel->nama,
                    'singkatan' => $item->mapel->singkatan
                ];
            }),
            'rombel' => Rombel::whereHas('tahun', function ($q) {
                $q->where('active', '=', 1);
            })->whereHas('subjek.tentor', function ($query) {
                $query->where('id', '=', $this->id);
            })->count()
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRombelSiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $kelassiswa = KelasSiswa::where('siswa_id', '=', $this->id)->whereHas('tahun', function($query){
            $query->where('active', '=', 1);
        })->with(['kelas'])->first();
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'slug' => $this->slug,
            'nis' => $this->nis,
            'sekolah' => $this->sekolah,
            'kelas' => $kelassiswa->kelas->nama
        ];
    }
}

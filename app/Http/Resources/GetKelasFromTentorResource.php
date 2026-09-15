<?php

namespace App\Http\Resources;

use App\Models\KelasSiswa;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetKelasFromTentorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $kelassiswa = KelasSiswa::where('kelas_id', '=', $this->id)->whereHas('tahun', function ($query) {
            $query->where('active', '=', 1);
        });
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'slug' => $this->slug,
            'tentor' => $this->wali->wali->name,
            'tingkat' => $this->tingkat->tingkat,
            'jenjang' => $this->tingkat->jenjang->slug,
            'siswa' => $kelassiswa->count()
        ];
    }
}

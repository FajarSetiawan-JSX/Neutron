<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetSiswaResource;
use App\Http\Resources\GetSiswaRombelResource;
use App\Http\Resources\Tentor\GetSiswaKelasResource;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\LogKelas;
use App\Models\Mapel;
use App\Models\Rombel;
use App\Models\RombelSiswa;
use App\Models\Siswa;
use App\Models\SubjekSiswa;
use App\Models\TahunAjaran;
use App\Models\Tingkat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $siswa = Siswa::where('lulus', '=', 0)->with('kelas', 'mapel');
        if ($request->filled('search')) {
            $siswa = $siswa->where('nama', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('jenjang')) {
            $id = $request->jenjang;
            $siswa = $siswa->whereHas('kelas.kelas.tingkat.jenjang', function ($query) use ($id) {
                $query->where('id', '=', $id);
            });
        }
        if ($request->filled('tingkat')) {
            $id = $request->tingkat;
            $siswa = $siswa->whereHas('kelas.kelas.tingkat', function ($query) use ($id) {
                $query->where('id', '=', $id);
            });
        }
        if ($request->filled('kelas')) {
            $id = $request->kelas;
            $siswa = $siswa->whereHas('kelas.kelas', function ($query) use ($id) {
                $query->where('id', '=', $id);
            });
        }
        return GetSiswaResource::collection($siswa->paginate(25)->withQueryString());
    }

    public function getbytentor(Request $request, $id, $ta)
    {
        $siswa = Siswa::whereHas('kelas.tahun', function ($query) use ($ta) {
            $query->where('id', '=', $ta);
        })->whereHas('kelas.kelas', function ($q) use ($id) {
            $q->where('id', '=', $id);
        });
        if ($request->filled('search')) {
            $siswa = $siswa->where('nama', 'like', '%' . $request->search . '%');
        }
        return GetSiswaKelasResource::collection($siswa->paginate(25)->withQueryString());
    }

    public function rombel($id, $tahun, Request $request)
    {
        $rombel = Rombel::whereHas('siswa.siswa', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->where('tahun_id', '=', $tahun)->with(['tahun', 'siswa', 'subjek.tentor', 'subjek.mapel', 'tingkat.jenjang']);
        if ($request->filled('search')) {
            $rombel = $rombel->where('name', 'like', '%' . $request->search . '%');
        }
        return GetSiswaRombelResource::collection($rombel->paginate(6)->withQueryString());
    }

    public function rombelsaran($id, $tahun)
    {
        $siswa = Siswa::where('id', '=',  $id)->first();
        $mapelsiswa = SubjekSiswa::where('siswa_id', '=', $siswa->id)->pluck('mapel_id')->values();
        $tingkatsiswa = KelasSiswa::where('siswa_id', '=', $siswa->id)->where('tahun_id', '=', $tahun)->with(['kelas'])->first();
        $rombel = Rombel::where('tahun_id', '=', $tahun)->whereDoesntHave('siswa', function ($q) use ($siswa) {
            $q->where('siswa_id', '=', $siswa->id);
        })->whereHas('subjek.mapel', function ($query) use ($mapelsiswa) {
            $query->whereIn('id', $mapelsiswa);
        })->where('tingkat_id', '=', $tingkatsiswa->kelas->tingkat_id)->with(['subjek.tentor', 'siswa', 'subjek.mapel', 'tingkat.jenjang', 'tahun'])->get();
        $result = $rombel->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->name,
                'slug' => $item->slug,
                'siswa' => $item->siswa()->count(),
                'tentor' => $item->subjek->tentor->name,
                'avatar' => $item->subjek->tentor->avatar ?? null,
                'mapel' => $item->subjek->mapel->singkatan,
                'tingkat' => $item->tingkat->tingkat,
                'jenjang' => $item->tingkat->jenjang->slug,
                'tahun' => $item->tahun->tahun
            ];
        });
        return response()->json(['rombels' => $result]);
    }
    public function keluarrombel($id, $rombel)
    {
        $rombels = Rombel::where('id', '=', $rombel)->first();
        $siswa = Siswa::where('id', '=', $id)->first();
        DB::beginTransaction();
        try {
            $data = RombelSiswa::where('rombel_id', '=', $rombels->id)->where('siswa_id', '=', $siswa->id)->first();
            $data->delete();
            DB::commit();
            return response()->json(['message' => 'Berhasil menghapus rombel siswa']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }
    public function siswakelas(Request $request, $id, $ta)
    {
        $kelas = Kelas::where('id', '=', $id)->first();
        $tahun = TahunAjaran::where('id', '=', $ta)->first();
        if (!$kelas || !$tahun) {
            return response()->json(['message' => 'kelas atau tahun tidak ditemukan'], 404);
        }
        $siswas = Siswa::whereHas('kelas', function ($query) use ($kelas, $tahun) {
            $query->where('kelas_id', '=', $kelas->id)->where('tahun_id', '=', $tahun->id);
        })->where('status', '=', 1);
        if ($request->filled('search')) {
            $siswas = $siswas->where('nama', 'like', '%' . $request->search . '%');
        }
        return GetSiswaKelasResource::collection($siswas->paginate(25)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis',
            'sekolah' => 'required',
            'alamat' => 'nullable',
            'phone' => 'required|between:9,13|different:phoneOrtu|regex:/^628/',
            'phoneOrtu' => 'required|between:9,13|different:phone|regex:/^628/',
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => 'NIS sudah terdaftar',
            'between' => 'Nomor hp terdiri dari 9 hingga 13 digit',
            'different' => 'Nomor Telp siswa dan orang tua tidak boleh sama',
            'regex' => '08 wajib menggunakan format 628'
        ])->validate();
        $phone = Siswa::where('phone_hash', '=', hash_hmac('sha256', $valid['phone'], config('app.key')))->exists();
        $phoneOrtu = Siswa::where('phone_ortu_hash', '=', hash_hmac('sha256', $valid['phoneOrtu'], config('app.key')))->exists();
        if ($phone) {
            return response()->json(['message' => 'Nomor Telp / WhatsApp sudah terdaftar'], 409);
        }
        if ($phoneOrtu) {
            return response()->json(['message' => 'Nomor Telp / WhatsApp orang tua sudah terdaftar'], 409);
        }
        DB::beginTransaction();
        try {
            $siswa = Siswa::create([
                'nama' => $valid['nama'],
                'slug' => Str::slug($valid['nama']),
                'nis' => $valid['nis'],
                'sekolah' => $valid['sekolah'],
                'alamat' => $valid['alamat'],
                'phone' => encrypt($valid['phone']),
                'phone_hash' => hash_hmac('sha256', $valid['phone'], config('app.key')),
                'phone_ortu' => encrypt($valid['phoneOrtu']),
                'phone_ortu_hash' => hash_hmac('sha256', $valid['phoneOrtu'], config('app.key'))
            ]);
            $siswa->logsiswa()->create([
                'judul' => 'Create data siswa',
                'history' => 'Terdaftar sebagai siswa pada ' . today()->format('d-m-Y') . '.'
            ]);
            DB::commit();
            return response()->json(['message' => 'Berhasil menambah siswa baru.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function kelas(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'siswa' => 'required|exists:siswas,id,status,1',
            'kelas' => 'nullable|exists:kelas,id',
        ], [
            'siswa.exists' => 'Siswa dengan status non aktif tidak diizinkan mengambil kelas.',
            'required' => ':attribute wajib dibawa!',
            'exists' => 'ID :attribute tidak ada'
        ])->validate();

        DB::beginTransaction();
        try {
            $siswa = Siswa::where('id', '=', $valid['siswa'])->with('kelas.kelas')->first();
            $tahun = TahunAjaran::where('active', '=', 1)->first();
            $kelas = Kelas::where('id', '=', $valid['kelas'])->first();
            $kelassiswa = KelasSiswa::where('siswa_id', '=', $siswa->id)->where('tahun_id', '=', $tahun->id);
            if ($kelassiswa->exists()) {
                if (empty($valid['kelas'])) {
                    $kelassiswa->delete();
                } else {
                    $kelassiswa = $kelassiswa->first();
                    $kelassiswa->update([
                        'kelas_id' => $valid['kelas']
                    ]);
                    $siswa->logsiswa()->create([
                        'judul' => 'Create Kelas',
                        'history' => 'Pindah ke kelas ' . $kelas->nama . ' sebagai base kelas untuk Tahun Ajaran ' . $tahun->tahun . ' pada ' . today()->format('d-m-Y') . '.'
                    ]);
                }
            } else {
                if (empty($valid['kelas'])) {
                    return response()->json(['message' => 'Wajib mengambil kelas'], 422);
                }
                $siswa->kelas()->create([
                    'tahun_id' => $tahun->id,
                    'kelas_id' => $valid['kelas']
                ]);
                $siswa->logsiswa()->create([
                    'judul' => 'Create Kelas',
                    'history' => 'Mengambil kelas ' . $kelas->nama . ' sebagai base kelas untuk Tahun Ajaran ' . $tahun->tahun . ' pada ' . today()->format('d-m-Y') . '.'
                ]);
            }
            DB::commit();
            if (empty($valid['kelas'])) {
                return response()->json(['message' => 'Berhasil mengeluarkan siswa dari kelas']);
            } else {
                return response()->json(['message' => 'Berhasil mengatur kelas']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function mapel(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'siswa' => 'required|exists:siswas,id',
            'mapel' => 'array',
            'mapel.*' => 'exists:mapels,id'
        ], [
            'required' => 'Id Tentor wajib ada',
            'exists' => 'id :attribute tidak ditemukan'
        ])->validate();
        DB::beginTransaction();
        try {
            $siswa = Siswa::where('id', '=', $valid['siswa'])->with('mapel')->first();
            if ($siswa->mapel()->exists()) {
                $siswa->mapel()->delete();
                $siswa->logsiswa()->create([
                    'judul' => 'Delete mapel siswa',
                    'history' => 'Menghapus seluruh mapel pada ' . today()->format('d-m-Y') . '.'
                ]);
            }
            if (!empty($valid['mapel'])) {
                $mapels = Mapel::whereIn('id', $valid['mapel'])->get()->keyBy('id');
                foreach ($valid['mapel'] as $id) {
                    $mapel = Mapel::where('id', '=', $id)->first();
                    $siswa->mapel()->create([
                        'mapel_id' => $id
                    ]);
                    $siswa->logsiswa()->create([
                        'judul' => 'Create mapel siswa',
                        'history' => 'Mengambil mapel ' . $mapels[$id]->nama . ' pada ' . today()->format('d-m-Y') . '.'
                    ]);
                }
            }
            DB::commit();
            if (!empty($valid['mapel'])) {
                return response()->json(['message' => 'Berhasil mengatur mapel']);
            } else {
                return response()->json(['message' => 'Berhasil melepas mapel dari siswa']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['message' => 'Server Error!'], 500);
        }
    }

    public function status(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'status' => 'required'
        ])->validate();

        DB::beginTransaction();
        try {
            $siswa = Siswa::where('id', '=', $id)->first();
            $siswa->update([
                'status' => $valid['status']
            ]);
            if ($siswa->status == 0) {
                $siswa->logsiswa()->create([
                    'judul' => 'Update status siswa',
                    'history' => 'Mengubah status siswa menjadi ' . $siswa->status . ' pada ' . today()->format('d-m-Y')
                ]);
            } else {
                $siswa->logsiswa()->create([
                    'judul' => 'Update status siswa',
                    'history' => 'Mengubah status siswa menjadi ' . $siswa->status . ' pada ' . today()->format('d-m-Y')
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Berhasil mengubah status']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis',
            'sekolah' => 'required',
            'alamat' => 'nullable',
            'phone' => 'required|between:9,13|different:phoneOrtu|regex:/^628/',
            'phoneOrtu' => 'required|between:9,13|different:phone|regex:/^628/',
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => 'NIS sudah terdaftar',
            'between' => 'Nomor hp terdiri dari 9 hingga 13 digit',
            'different' => 'Nomor Telp siswa dan orang tua tidak boleh sama',
            'regex' => '08 wajib menggunakan format 628'
        ])->validate();
        $siswa = Siswa::where('id', '=', $id)->first();
        $phone = hash_hmac('sha256', $valid['phone'], config('app.key'));
        $phoneOrtu = hash_hmac('sha256', $valid['phoneOrtu'], config('app.key'));
        $cekphone = Siswa::where('phone_hash', '=', $phone)->where('id', '!=', $siswa->id)->exists();
        $cekphoneOrtu = Siswa::where('phone_hash', '=', $phoneOrtu)->where('id', '!=', $siswa->id)->exists();
        if ($cekphone) {
            return response()->json(['message' => 'Nomor Telp / WhatsApp sudah terdaftar'], 409);
        }
        if ($cekphoneOrtu) {
            return response()->json(['message' => 'Nomor Telp / WhatsApp orang tua sudah terdaftar'], 409);
        }
        DB::beginTransaction();
        try {
            $siswa->update([
                'nama' => $valid['nama'],
                'slug' => Str::slug($valid['nama']),
                'nis' => $valid['nis'],
                'sekolah' => $valid['sekolah'],
                'alamat' => $valid['alamat'],
                'phone' => encrypt($valid['phone']),
                'phone_hash' => $phone,
                'phone_ortu' => encrypt($valid['phoneOrtu']),
                'phone_ortu_hash' => $phoneOrtu
            ]);
            $siswa->logsiswa()->create([
                'judul' => 'Update data siswa',
                'history' => 'Data siswa diperbarui pada ' . today()->format('d-m-Y') . '.'
            ]);
            DB::commit();
            return response()->json(['message' => 'Berhasil update data siswa.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = Siswa::where('id', '=', $id)->first();
        //$siswa->delete();
        return response()->json(['message' => 'Berhasil hit end point API']);
    }
}

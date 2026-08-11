<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetSiswaResource;
use App\Models\Kelas;
use App\Models\LogKelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\TahunAjaran;
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
        $siswa = Siswa::with('kelas', 'mapel');
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
            'phone' => 'required|between:9,13'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => 'NIS sudah terdaftar',
            'between' => 'Nomor hp terdiri dari 9 hingga 13 digit'
        ])->validate();
        $data = Siswa::where('phone_hash', '=', hash_hmac('sha256', $valid['phone'], config('app.key')))->exists();
        if ($data) {
            return response()->json(['message' => 'Nomor Telp / WhatsApp sudah terdaftar'], 409);
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
                'phone_hash' => hash_hmac('sha256', $valid['phone'], config('app.key'))
            ]);
            $siswa->logsiswa()->create([
                'judul' => 'Create data siswa',
                'history' => 'Terdaftar sebagai siswa pada ' . today()->format('d-m-Y') . '.'
            ]);
            Db::commit();
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
            'kelas' => 'nullable|exists:kelas,id'
        ], [
            'siswa.exists' => 'Siswa dengan status non aktif tidak diizinkan mengambil kelas.',
            'required' => ':attribute wajib dibawa!',
            'exists' => 'ID :attribute tidak ada'
        ])->validate();

        DB::beginTransaction();
        try {
            $siswa = Siswa::where('id', '=', $valid['siswa'])->with('kelas.kelas')->first();
            $tahun = TahunAjaran::where('active', '=', 1)->first();
            if ($siswa->kelas) {
                $siswa->logsiswa()->create([
                    'judul' => 'Delete Kelas',
                    'history' => 'dikeluarkan dari kelas ' . $siswa->kelas->kelas->nama . ' pada ' . today()->format('d-m-Y')
                ]);
                $siswa->kelas()->delete();
            }
            if (!empty($valid['kelas'])) {
                $siswa->kelas()->create([
                    'kelas_id' => $valid['kelas']
                ]);
                $kelas = Kelas::where('id', '=', $valid['kelas'])->first();
                $siswa->logsiswa()->create([
                    'judul' => 'Create Kelas',
                    'history' => 'Mengambil kelas ' . $kelas->nama . ' sebagai base kelas untuk Tahun Ajaran ' . $tahun->tahun . ' pada ' . today()->format('d-m-Y') . '.'
                ]);
            }
            Db::commit();
            if (empty($valid['kelas'])) {
                return response()->json(['message' => 'Berhasil melepas mapel dari siswa']);
            } else {
                return response()->json(['message' => 'Berhasil mengatur ulang mapel']);
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
            Db::commit();
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
            'nis' => 'required|unique:siswas,nis,' . $id,
            'sekolah' => 'required',
            'alamat' => 'nullable',
            'phone' => 'required|between:9,13'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => 'NIS sudah terdaftar',
            'between' => 'Nomor hp terdiri dari 9 hingga 13 digit'
        ])->validate();
        $siswa = Siswa::where('id', '=', $id)->first();
        $phone = hash_hmac('sha256', $valid['phone'], config('app.key'));
        $cek = Siswa::where('phone_hash', '=', $phone)->where('id', '!=', $siswa->id)->exists();
        if ($cek) {
            return response()->json(['message' => 'Nomor Telp / WhatsApp sudah terdaftar'], 409);
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
                'phone_hash' => $phone
            ]);
            $siswa->logsiswa()->create([
                'judul' => 'Update data siswa',
                'history' => 'Data siswa diperbarui pada ' . today()->format('d-m-Y') . '.'
            ]);
            Db::commit();
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

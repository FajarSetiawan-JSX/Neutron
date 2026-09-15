<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetAbsensiResource;
use App\Models\Absensi;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $absen = Absensi::orderBy('created_at', 'desc')->with(['pertemuan.rombel.subjek.mapel', 'siswa.siswa', 'pertemuan.tipe']);
        if ($request->filled('search')) {
        }
        $absen = $absen->paginate(15)->withQueryString();
        return GetAbsensiResource::collection($absen);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'pertemuan' => 'required|exists:pertemuans,id',
            'hadir' => 'array|min:1',
            'hadir*' => 'required|exists:rombel_siswas,id'
        ], [
            'required' => ':attribute wajib diisi',
            'min' => 'Minimal memilih 1 siswa',
            'exists' => ':attribute harus valid'
        ])->validate();
        DB::beginTransaction();
        try {
            foreach ($valid['hadir'] as $siswa) {
                Absensi::create([
                    'pertemuan_id' => $valid['pertemuan'],
                    'rombel_siswa_id' => $siswa,
                ]);
            }
            DB::commit();
            return response()->json(['data' => $valid['hadir']]);
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

    public function tambahan(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'rombel' => 'required|exists:rombels,id',
            'materi' => 'required|string|max:200',
            'siswa' => 'array|min:1',
            'siswa*' => 'required|exists:rombel_siswas,id'
        ], [
            'required' => ':attribute wajib diisi',
            'min' => 'Minimal memilih 1 siswa',
            'exists' => ':attribute harus valid',
            'string' => 'Input harus berupa string',
            'max' => 'Maksimal 200 karakter'
        ])->validate();
        DB::beginTransaction();
        try {
            $rombel = Rombel::where('id', '=', $valid['rombel'])->first();
            $ke = 1;
            $last = Pertemuan::where('rombel_id', '=', $rombel->id)->where('tipe_id', '=', 2)->orderBy('pertemuan', 'desc');
            if($last->exists()){
                $last = $last->first();
                $ke = $last->pertemuan;
            }
            $pertemuan = $rombel->pertemuan()->create([
                'tipe_id' => 2,
                'pertemuan' => $ke,
                'materi' => $valid['materi'],
                'selesai' => 1,
            ]);
            foreach ($valid['siswa'] as $siswa) {
                $pertemuan->absensi()->create([
                    'rombel_siswa_id' => $siswa
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Berhasil absen tambahan']);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ta)
    {
        $ta = TahunAjaran::where('id', '=', $ta)->first();
        if (!$ta) {
            return response()->json(['message' => 'ID Tahun Ajaran tidak ada'], 404);
        }
        if ($ta->active == 1) {
            return response()->json(['message' => 'Tahun Ajaran sedang berlangsung'], 409);
        }
        DB::beginTransaction();
        try {
            Absensi::whereHas('pertemuan.rombel.tahun', function ($query) use ($ta) {
                $query->where('id', '=', $ta);
            })->delete();
            DB::commit();
            return response()->json(['message' => 'Berhasil menghapus absensi']);
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
}

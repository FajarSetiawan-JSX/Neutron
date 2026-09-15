<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetNilaiResource;
use App\Models\Absensi;
use App\Models\Nilai;
use App\Models\Pertemuan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nilai = Nilai::with(['ujian', 'absensi.pertemuan.siswa.siswa', 'absensi.pertemuan.rombel.subjek.mapel', 'absensi.pertemuan.rombel.tingkat.jenjang', 'absensi.pertemuan.rombel.tahun']);
        if ($request->filled('search')) {
            $cari = $request->search;
            $nilai = $nilai->whereHas('absensi.pertemuan.siswa.siswa', function ($query) use ($cari) {
                $query->where('nama', 'like', '%' . $cari . '%');
            });
        }
        if ($request->filled('tahun')) {
            $tahun = $request->tahun;
            $nilai = $nilai->whereHas('absensi.pertemuan.rombel.tahun', function ($query) use ($tahun) {
                $query->where('id', '=', $tahun);
            });
        }
        if ($request->filled('tingkat')) {
            $tingkat = $request->tingkat;
            $nilai = $nilai->whereHas('absensi.pertemuan.rombel.tingkat', function ($query) use ($tingkat) {
                $query->where('id', '=', $tingkat);
            });
        }
        if ($request->filled('jenjang')) {
            $jenjang = $request->jenjang;
            $nilai = $nilai->whereHas('absensi.pertemuan.rombel.tingkat.jenjang', function ($query) use ($jenjang) {
                $query->where('id', '=', $jenjang);
            });
        }
        $nilai = $nilai->paginate(15)->withQueryString();
        return GetNilaiResource::collection($nilai);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'ujian' => 'required|exists:ujians,id',
            'pertemuan' => 'required|exists:pertemuans,id',
            'data' => 'required|array|min:1',
            'data.*.id' => 'required|exists:rombel_siswas,id',
            'data.*.nilai' => 'required|numeric|min:0|max:100',
            'data.*.note' => 'nullable|max:100'
        ], [
            'required' => ':attribute wajib diisi',
            'exists' => ':attribute does not exist',
            'array' => 'only array allowed',
            'numeric' => 'nilai harus berupa angka',
            'min' => 'minimal nilai 0',
            'max' => 'maksimal nilai 100'
        ])->validate();
        $absen = Absensi::where('pertemuan_id', '=', $valid['pertemuan']);
        if (!$absen->exists()) {
            return response()->json(['message' => 'Submit absensi terlebih dahulu!'], 409);
        }
        DB::beginTransaction();
        try {
            $absensi = $absen->get();
            $data = collect($valid['data'])->keyBy('id');
            foreach ($absensi as $item) {
                $siswa = $data->get($item->rombel_siswa_id);
                if (!$siswa) {
                    continue;
                }
                $item->nilai()->create([
                    'ujian_id' => $valid['ujian'],
                    'nilai' => $siswa['nilai'],
                    'catatan' => $siswa['note']
                ]);
            }
            $pertemuan = Pertemuan::where('id', '=', $valid['pertemuan'])->first();
            $pertemuan->update([
                'selesai' => 1
            ]);
            DB::commit();
            return response()->json(['message' => 'Berhasil memasukan nilai']);
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
    public function destroy(string $id)
    {
        //
    }
}

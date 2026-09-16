<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tentor\GetPertemuanResource;
use App\Http\Resources\Tentor\GetPertemuansResource;
use App\Http\Resources\Tentor\GetSiswaPertemuanDetailResource;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\RombelSiswa;
use App\Models\Tipe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PertemuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $rombel)
    {
        $pertemuan = Pertemuan::where('rombel_id', '=', $rombel)->with(['absensi.nilai', 'rombel.siswa', 'tipe'])->orderBy('pertemuan', 'desc');
        $pertemuan = $pertemuan->paginate(5)->withQueryString();
        return GetPertemuansResource::collection($pertemuan);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $rombel)
    {
        $valid = Validator::make($request->all(), [
            'materi' => 'required|max:200'
        ], [
            'required' => 'Materi wajib diisi',
            'max' => 'Maksimal 200 karakter'
        ])->validate();
        $rombel = Rombel::where('id', '=', $rombel)->first();
        if (!$rombel) {
            return response()->json(['message' => 'ID rombelnya ga ketemu, minta developer benerin aja'], 409);
        }
        DB::beginTransaction();
        try {
            $tipe = Tipe::where('nama', '=', 'Pertemuan')->first();
            $ke = 1;
            $pertemuan = Pertemuan::where('rombel_id', '=', $rombel->id)->where('tipe_id', '=', $tipe->id)->orderBy('pertemuan', 'desc');
            if ($pertemuan->exists()) {
                $pertemuan = $pertemuan->first();
                $ke = $pertemuan->pertemuan + 1;
            }
            $data = $rombel->pertemuan()->create([
                'tipe_id' => $tipe->id,
                'pertemuan' => $ke,
                'materi' => $valid['materi']
            ]);
            $data->load(['tipe', 'absensi', 'rombel.siswa']);
            DB::commit();
            return new GetPertemuanResource($data);
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
    public function show($id)
    {
        $pertemuan = Pertemuan::where('id', '=', $id)->first();
        if (!$pertemuan) {
            return response()->json(['message' => 'Pertemuan tidak ditmukan'], 404);
        }
        $siswas = RombelSiswa::whereHas('rombel.pertemuan', function ($query) use ($pertemuan) {
            $query->where('id', '=', $pertemuan->id);
        })->with(['siswa', 'absensi.nilai'])->withExists([
            'absensi as hadir' => function ($query) use ($pertemuan) {
                $query->where('pertemuan_id', $pertemuan->id);
            }
        ])->orderByDesc('hadir')->paginate(10)->withQueryString();
        return GetSiswaPertemuanDetailResource::collection($siswas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $pertemuan = Pertemuan::where('id', '=', $id)->first();
        if (!$pertemuan) {
            return response()->json(['message' => 'ID Pertemuan tidak ketemu'], 404);
        }
        DB::beginTransaction();
        try {
            $pertemuan->update([
                'selesai' => 1
            ]);
            DB::commit();
            return response()->json(['message' => 'Success done pertemuan']);
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
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetAlumniResource;
use App\Http\Resources\GetCalonAlumniResource;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $siswas = Siswa::with(['alumni.tahun'])->where('lulus', '=', 1);
        if ($request->filled('search')) {
            $siswas = $siswas->where('nama', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('ta')) {
            $id = $request->ta;
            $siswas = $siswas->whereHas('alumni.tahun', function ($q) use ($id) {
                $q->where('id', '=', $id);
            });
        }
        return GetAlumniResource::collection($siswas->paginate(15)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'ta' => 'required|exists:tahun_ajarans,id'
        ])->validate();
        $ta = TahunAjaran::where('id', '=', $valid['ta'])->first();
        if (!$ta) {
            return response()->json(['message' => 'Ada masalah pada Tahun Ajaran. Laporkan ke developer'], 500);
        }
        if ($ta->active == 0) {
            return response()->json(['message' => 'Tahun Ajaran pada Backend sistem tidak match. laporin ke developer ya'], 409);
        }

        DB::beginTransaction();
        try {
            $taID = $valid['ta'];
            $siswas = Siswa::whereHas('kelas.tahun', function ($query) use ($taID) {
                $query->where('id', '=', $taID);
            })->whereHas('kelas.kelas.tingkat', function ($q) {
                $q->where('tingkat', '=', 12);
            })->get();
            foreach ($siswas as $siswa) {
                $siswa->update([
                    'status' => 0,
                    'lulus' => 1
                ]);
                $siswa->alumni()->create([
                    'tahun_id' => $valid['ta']
                ]);
                $siswa->logsiswa()->create([
                    'judul' => 'LULUS',
                    'history' => 'Lulus dari tingkat 12 pada tahun ajaran ' . $ta->tahun
                ]);
            }
            Db::commit();
            return response()->json(['message' => 'Berhasil meluluskan siswa tingkat 12']);
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

    public function calon(Request $request)
    {
        $siswa = Siswa::whereHas('kelas.tahun', function ($query) {
            $query->where('active', '=', 1);
        })->whereHas('kelas.kelas.tingkat', function ($q) {
            $q->where('tingkat', '=', 12);
        })->where('lulus', '=', 0)->with(['kelas.kelas.tingkat']);
        return GetCalonAlumniResource::collection($siswa->paginate(15)->withQueryString());
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

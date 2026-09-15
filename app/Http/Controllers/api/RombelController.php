<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetRombelByTentorResource;
use App\Http\Resources\GetRombelSiswaResource;
use App\Http\Resources\GetRombelsResource;
use App\Http\Resources\Tentor\GetRombelsResource as TentorGetRombelsResource;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rombels = Rombel::latest()->whereHas('tahun', function ($q) {
            $q->where('active', '=', 1);
        })->with(['tahun', 'subjek.tentor', 'subjek.mapel', 'tingkat.jenjang', 'siswa']);
        if ($request->filled('search')) {
            $rombels = $rombels->where('name', 'like', '%' . $request->Search . '%');
        }
        $rombels = $rombels->paginate(6)->withQueryString();
        return GetRombelsResource::collection($rombels);
    }

    public function getbytentor($tentor)
    {
        $rombels = Rombel::whereHas('subjek.tentor', function ($query) use ($tentor) {
            $query->where('id', '=', $tentor);
        })->whereHas('tahun', function ($query) {
            $query->where('active', '=', 1);
        })->with(['subjek.tentor', 'subjek.mapel', 'tahun', 'tingkat'])->paginate(6)->withQueryString();
        return GetRombelByTentorResource::collection($rombels);
    }

    public function getsiswa(Request $request, $id)
    {
        $siswas = Siswa::whereHas('rombel.rombel', function ($query) use ($id) {
            $query->where('id', '=', $id);
        });
        if ($request->filled('search')) {
            $nama = $request->search;
            $siswas = $siswas->where('nama', 'like', '%' . $nama . '%');
        }
        $siswas = $siswas->paginate(15)->withQueryString();
        return GetRombelSiswaResource::collection($siswas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required|string',
            'tingkat' => 'required|exists:tingkats,id',
            'tahun' => 'required|exists:tahun_ajarans,id',
            'subjek' => 'required|exists:subjek_tentors,id',
            'deskripsi' => 'nullable|string|max:200'
        ], [
            'required' => ':attribute wajib diisi',
            'exists' => 'id :attribute tidak tersedia',
            'max' => 'maksimal :attribute 200 kata',
            'string' => 'Format wajib huruf'
        ])->validate();
        DB::beginTransaction();
        try {
            $tahun = TahunAjaran::where('active', '=', 1)->first();
            if ($tahun->id != $valid['tahun']) {
                return response()->json(['message' => 'Terjadi konflik sistem pada Tahun Ajaran'], 409);
            }
            $tahun->rombel()->create([
                'subjek_id' => $valid['subjek'],
                'tingkat_id' => $valid['tingkat'],
                'name' => $valid['nama'],
                'slug' => Str::slug($valid['nama']),
                'deskripsi' => $valid['deskripsi']
            ]);
            DB::commit();
            return response()->json(['message' => 'Berhasil membuat rombel baru']);
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

    public function checkout(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'tahun' => 'required|exists:tahun_ajarans,id',
            'siswa' => 'required|exists:siswas,id',
            'rombel' => 'required|array|min:1',
            'rombel.*' => 'exists:rombels,id'
        ], [
            'required' => ':attribute wajib',
            'exists' => 'id :attribute tidak tersedia',
            'min' => 'minimal memilih 1 rombel'
        ])->validate();
        DB::beginTransaction();
        try {
            $tahun = TahunAjaran::where('id', '=', $valid['tahun'])->first();
            $siswa = Siswa::where('id', '=', $valid['siswa'])->first();
            foreach ($valid['rombel'] as $rombel) {
                $siswa->rombel()->create([
                    'rombel_id' => $rombel
                ]);
                $siswa->logsiswa()->create([
                    'judul' => 'Checkout rombel',
                    'history' => 'Menambah rombel dengan id ' . $rombel . ' Untuk Tahun Ajaran ' . $tahun->tahun
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Berhasil menambah rombel']);
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
    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required|string',
            'tingkat' => 'required|exists:tingkats,id',
            'subjek' => 'required|exists:subjek_tentors,id',
            'deskripsi' => 'nullable|string|max:200'
        ], [
            'required' => ':attribute wajib diisi',
            'exists' => 'id :attribute tidak tersedia',
            'max' => 'maksimal :attribute 200 kata',
            'string' => 'Format wajib huruf'
        ])->validate();
        DB::beginTransaction();
        try {
            $rombel = Rombel::where('id', '=', $id)->first();
            $rombel->update([
                'subjek_id' => $valid['subjek'],
                'tingkat_id' => $valid['tingkat'],
                'name' => $valid['nama'],
                'slug' => Str::slug($valid['nama']),
                'deskripsi' => $valid['deskripsi']
            ]);
            DB::commit();
            return response()->json(['message' => 'Berhasil memperbarui rombel']);
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
        $rombel = Rombel::where('id', '=', $id)->first();
        //$rombel->delete();
        return response()->json(['message' => 'Jangan dihapus rombelnya'], 409);
    }

    //TENTOR
    public function tentorindex(Request $request)
    {
        $ta = TahunAjaran::where('active', '=', 1)->first();
        $rombels = Rombel::whereHas('subjek.tentor', function ($query) {
            $query->where('id', '=', Auth::user()->id);
        })->where('tahun_id', '=', $ta->id)->with(['subjek.tentor', 'subjek.mapel', 'tahun', 'siswa', 'tingkat.jenjang']);
        if ($request->filled('search')) {
            $cari = $request->search;
            $rombels = $rombels->where('name', 'like', '%' . $cari . '%');
        }
        return TentorGetRombelsResource::collection($rombels->paginate(6)->withQueryString());
    }
}

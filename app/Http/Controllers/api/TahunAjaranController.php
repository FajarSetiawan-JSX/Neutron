<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetTahunAjaransResource;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = TahunAjaran::with('logs')->latest()->paginate(6)->withQueryString();
        return GetTahunAjaransResource::collection($datas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'tahun' => 'required|unique:tahun_ajarans,tahun'
        ], [
            'required' => 'Tahun Ajaran baru wajib dipilih',
            'unique' => 'Tahun Ajaran sudah pernah dibuat'
        ])->validate();

        DB::beginTransaction();
        try {
            $tahun = TahunAjaran::where('active', '=', 1)->first();
            if ($tahun) {
                $tahun->update([
                    'active' => 0
                ]);
            }
            TahunAjaran::create([
                'tahun' => $valid['tahun'],
                'active' => 1
            ]);
            DB::commit();
            return response()->json(['message' => 'Berhasil membuat Tahun Ajaran Baru.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan eror' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            return response()->json(['message' => $e->getMessage()], 500);
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
    public function update($id)
    {
        $tahun = TahunAjaran::where('id', '=', $id)->first();
        if (!$tahun) {
            return response()->json(['message' => 'Tahun Ajaran yang anda pilih tidak tersedia'], 404);
        }
        $firstyear = (int) explode(' / ', $tahun->tahun)[0];
        $now = Carbon::now()->year;
        if ($firstyear < $now) {
            return response()->json(['message' => 'Anda tidak diizinkan oleh sistem untuk mengaktifkan Tahun Ajaran yang lebih lama dari tahun saat ini.'], 500);
        }
        DB::beginTransaction();
        try {
            $tahunActive = TahunAjaran::where('active', '=', 1)->first();
            $tahunActive->update([
                'active' => 0
            ]);
            $tahun->update([
                'active' => 1
            ]);
            DB::commit();
            return response()->json(['message' => 'Berhasil mengubah Tahun Ajaran.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan eror' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
            return response()->json(['message' => $e->getMessage()], 500);
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

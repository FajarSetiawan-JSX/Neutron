<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetMapelsResource;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MapelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mapels = Mapel::with(['tentor.tentor', 'siswa']);
        if ($request->filled('search')) {
            $mapels->where('nama', 'like', '%' . $request->search . '%');
        }
        return GetMapelsResource::collection($mapels->paginate(6)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required|unique:mapels,nama,',
            'inisial' => 'required'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute mapel sudah digunakan'
        ])->validate();

        Mapel::create([
            'nama' => $valid['nama'],
            'slug' => Str::slug($valid['nama']),
            'singkatan' => $valid['inisial']
        ]);

        return response()->json(['message' => 'Berhasil membuat mapel baru.']);
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
        $mapel = Mapel::where('id', '=', $id)->first();
        if (!$mapel) {
            return response()->json(['message' => 'Mapel tidak tersedia di database'], 404);
        }
        $valid = Validator::make($request->all(), [
            'nama' => 'required|unique:mapels,nama,' . $mapel->id,
            'inisial' => 'required'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute mapel sudah digunakan'
        ])->validate();
        $mapel->update([
            'nama' => $valid['nama'],
            'slug' => Str::slug($valid['nama']),
            'singkatan' => $valid['inisial']
        ]);
        return response()->json(['message' => 'Berhasil memperbarui mapel.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mapel = Mapel::where('id', '=', $id)->first();
        if (!$mapel) {
            return response()->json(['message' => 'Mapel tidak tersedia di database'], 404);
        }
        $mapel->delete();
        return response()->json(['message' => 'Berhasil menghapus mapel.']);
    }
}

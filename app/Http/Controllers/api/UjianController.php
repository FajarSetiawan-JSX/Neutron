<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetUjianResource;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ujian = Ujian::query();
        if ($request->filled('filter')) {
            $ujian = $ujian->where('active', '=', $request->filter);
        }
        return GetUjianResource::collection($ujian->paginate(3)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required|unique:ujians,nama',
            'deskripsi' => 'required|string|max:255'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute sudah terdaftar',
            'string' => ':attribute harus string',
            'max' => 'Maksimal 255 karakter'
        ])->validate();

        Ujian::create([
            'nama' => $valid['nama'],
            'slug' => Str::slug($valid['nama']),
            'deskripsi' => $valid['deskripsi']
        ]);

        return response()->json(['message' => 'Berhasil membuat tipe ujian baru.']);
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
            'nama' => 'required|unique:ujians,nama,' . $id,
            'deskripsi' => 'required|string|max:255'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute sudah terdaftar',
            'string' => ':attribute harus string',
            'max' => 'Maksimal 255 karakter'
        ])->validate();
        $ujian = Ujian::where('id', '=', $id)->first();
        $ujian->update([
            'nama' => $valid['nama'],
            'slug' => Str::slug($valid['nama']),
            'deskripsi' => $valid['deskripsi']
        ]);
        return response()->json(['message' => 'Berhasil memperbarui tipe ujian.']);
    }

    public function status(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'status' => 'required'
        ])->validate();
        $data = Ujian::where('id', '=', $id)->first();
        $data->update([
            'active' => $valid['status']
        ]);
        return response()->json(['message' => 'Berhasil mengubah status']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Ujian::where('id', '=', $id)->first();
        $data->delete();
        return response()->json(['message' => 'Berhasil menghapus tipe ujian.']);
    }
}

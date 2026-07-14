<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required|unique:kelas,nama',
            'tingkat' => 'required|exists:tingkats,id',
            'deskripsi' => 'nullable|max:100'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute mapel sudah digunakan',
            'exists' => ':attribute tidak tersedia di database',
            'max' => ':attribute maksimal 100 huruf termasuk spasi'
        ])->validate();

        Kelas::create([
            'nama' => $valid['nama'],
            'slug' => Str::slug($valid['nama']),
            'tingkat_id' => $valid['tingkat'],
            'deskripsi' => $valid['deskripsi']
        ]);

        return response()->json(['message' => 'Berhasil membuat kelas baru.']);
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

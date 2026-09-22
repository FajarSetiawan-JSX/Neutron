<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetTentorResource;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = User::whereHas('role', function ($query) {
            $query->where('nama', '=', 'Pengajar');
        });
        if ($request->filled('search')) {
            $data = $data->where('name', 'like', '%' . $request->search . '%');
        }
        return GetTentorResource::collection($data->with('kelas.kelas', 'mapel.mapel')->paginate(8)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|between:9,13'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => 'email sudah terdaftar',
            'between' => 'Digit harus 9 hingga 13 digit'
        ])->validate();
        $data = User::where('phone_hash', '=', hash_hmac('sha256', $valid['phone'], config('app.key')))->exists();
        if ($data) {
            return response()->json(['message' => 'Nomor Telp sudah terdaftar'], 409);
        }
        DB::beginTransaction();
        try {
            $role = Role::where('nama', '=', 'Pengajar')->first();
            $role->user()->create([
                'name' => $valid['nama'],
                'slug' => Str::slug($valid['nama']),
                'email' => $valid['email'],
                'phone' => encrypt($valid['phone']),
                'phone_hash' => hash_hmac('sha256', $valid['phone'], config('app.key')),
                'password' => Hash::make('password'),
                'email_verified_at' => now()
            ]);
            DB::commit();
            return response()->json(['message' => 'Berhasil menambah pengajar baru.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function status(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'status' => 'required'
        ])->validate();
        $data = User::where('id', '=', $id)->first();
        $data->update([
            'active' => $valid['status']
        ]);
        return response()->json(['message' => 'Berhasil mengubah status akun']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function reset($id)
    {
        $data = User::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'Data tentor tidak ditemukan.'], 404);
        }
        $data->update([
            'password' => Hash::make('password')
        ]);
        return response()->json(['message' => 'Berhasil menguatur ulang password tentor']);
    }

    public function kelasAvailable($id)
    {
        $tentor = User::where('id', '=', $id)->first();
        if (!$tentor) {
            return response()->json(['message' => 'Tentor tidak terdaftar'], 404);
        }
        $kelas = Kelas::whereDoesntHave('wali')->orWhereHas('wali.wali', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->get();
        return response()->json(['kelases' => $kelas]);
    }

    public function kelas(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'tentor' => 'required|exists:users,id',
            'kelas' => 'array',
            'kelas.*' => 'exists:kelas,id'
        ], [
            'required' => 'Id Tentor wajib ada',
            'exists' => 'id :attribute tidak ditemukan'
        ])->validate();
        DB::beginTransaction();
        try {
            $tentor = User::where('id', '=', $valid['tentor'])->first();
            $tentor->kelas()->delete();
            if (!empty($valid['kelas'])) {
                foreach ($valid['kelas'] as $id) {
                    $tentor->kelas()->create([
                        'kelas_id' => $id
                    ]);
                }
            }
            DB::commit();
            if (!empty($valid['kelas'])) {
                return response()->json(['message' => 'Berhasil menguatur kelas wali.']);
            } else {
                return response()->json(['message' => 'Berhasil mengeluarkan tentor dari kelas.']);
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

    public function mapelAvailable()
    {
        $mapel = Mapel::get();
        return response()->json(['mapel' => $mapel]);
    }

    public function mapel(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'tentor' => 'required|exists:users,id',
            'mapel' => 'array',
            'mapel.*' => 'exists:mapels,id'
        ], [
            'required' => 'Id Tentor wajib ada',
            'exists' => 'id :attribute tidak ditemukan'
        ])->validate();
        DB::beginTransaction();
        try {
            $tentor = User::where('id', '=', $valid['tentor'])->first();
            $tentor->mapel()->delete();
            if (!empty($valid['mapel'])) {
                foreach ($valid['mapel'] as $id) {
                    $tentor->mapel()->create([
                        'mapel_id' => $id
                    ]);
                }
            }
            DB::commit();
            if (!empty($valid['mapel'])) {
                return response()->json(['message' => 'Berhasil mengatur mapel 🫡']);
            } else {
                return response()->json(['message' => 'Berhasil melepas mapel dari tentor 🥲']);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

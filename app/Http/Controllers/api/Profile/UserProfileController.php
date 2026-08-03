<?php

namespace App\Http\Controllers\api\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserProfileController extends Controller
{
    public function profile(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|between:9,12'
        ], [
            'required' => ':attribute wajib diisi',
            'unique' => ':attribute telah digunakan, silahkan ganti :attribute',
            'between' => 'Minimal 9 digit dan maksimal 12 digit.'
        ])->validate();
        $user = Auth::user();
        $user->update([
            'name' => $valid['name'],
            'slug' => Str::slug($valid['name']),
            'email' => $valid['email'],
            'phone' => $valid['phone']
        ]);
        return response()->json(['message' => 'Berhasil memperbarui profile']);
    }

    public function image(Request $request)
    {
        $valid = validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'required' => 'File wajib diupload',
            'image' => 'File harus berupa gambar',
            'mimes' => 'Format file harus jpg, jpeg atau png',
            'max' => 'Maksimal ukuran file 2MB'
        ])->validate();
        $user = Auth::user();
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $file = $valid['image'];
        $filename = now()->timestamp . '-' . $user->slug . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->putFileAs('avatar', $file, $filename);
        $user->update([
            'avatar' => 'avatar/' . $filename
        ]);
        return response()->json(['message' => 'Berhasil upload foto']);
    }

    public function password(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'password' => 'required',
            'newPassword' => [
                'required',
                'min:8',
                'regex:/[A-Z]/', // minimal 1 huruf besar
                'regex:/[0-9]/', // minimal 1 angka
            ],
            'confirm' => 'required|same:newPassword'
        ], [
            'required' => ':attribute wajib diisi',
            'min' => 'Minimal 8 karakter',
            'regex' => 'Password baru harus mengandung minimal 1 huruf besar dan 1 angka',
            'same' => 'Konfirmasi password tidak identik'
        ])->validate();
        $user = User::where('id', '=', $id)->first();
        if (!Hash::check($valid['password'], $user->password)) {
            return response()->json(['message' => 'Password saat ini yang anda masukan salah.'], 404);
        }
        $user->update([
            'password' => Hash::make($valid['newPassword'])
        ]);
        return response()->json(['message' => 'Berhasil mengubah password']);
    }
}

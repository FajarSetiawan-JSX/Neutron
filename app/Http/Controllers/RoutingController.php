<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;

class RoutingController extends Controller
{
    public function Welcome()
    {
        $tutors = User::whereHas('role', function ($query) {
            $query->where('nama', '!=', 'Admin');
        })->count();
        $mapels = Mapel::get()->count();
        $classes = Kelas::get()->count();
        $students = Siswa::get()->count();
        return Inertia::render('Welcome', [
            'pengajar' => $tutors ?? 0,
            'mapel' => $mapels ?? 0,
            'kelas' => $classes ?? 0,
            'siswa' => $students ?? 0,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}

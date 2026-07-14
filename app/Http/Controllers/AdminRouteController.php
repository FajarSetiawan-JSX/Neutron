<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminRouteController extends Controller
{
    public function home()
    {
        return Inertia::render('Admin/Home');
    }
    public function tentor()
    {
        return Inertia::render('Admin/Tentor');
    }
    public function mapel()
    {
        return Inertia::render('Admin/Mapel');
    }
    public function tahun()
    {
        $tahun = TahunAjaran::where('active', '=', 1)->first();
        return Inertia::render('Admin/Tahun', ['tahun' => $tahun]);
    }
    public function siswa()
    {
        return Inertia::render('Admin/Siswa');
    }
    public function presensi()
    {
        return Inertia::render('Admin/Presensi');
    }
    public function nilai()
    {
        return Inertia::render('Admin/Nilai');
    }

    public function tingkat()
    {
        $tingkat = Jenjang::with('tingkat')->get();
        return Inertia::render('Admin/Tingkat', ['levels' => $tingkat]);
    }
    public function kelas()
    {
        return Inertia::render('Admin/Kelas');
    }
}

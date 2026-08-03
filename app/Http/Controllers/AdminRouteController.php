<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Tingkat;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminRouteController extends Controller
{
    public function home()
    {
        $TA = TahunAjaran::where('active', '=', true)->first();
        $students = Siswa::count();
        $tentors = User::whereHas('role', function ($query) {
            $query->where('nama', '=', 'Pengajar');
        })->count();
        $mapels = Mapel::count();
        $kelas = Kelas::count();
        return Inertia::render('Admin/Home', ['tahun' => $TA, 'siswa' => $students, 'tentor' => $tentors, 'mapel' => $mapels, 'kelas' => $kelas]);
    }
    public function tentor()
    {
        return Inertia::render('Admin/Tentor');
    }
    public function mapel()
    {
        $label = [];
        $data = [];
        $mapel = Mapel::with('siswa')->get();
        $mapel->map(function ($item) use (&$label, &$data) {
            $label[] = $item->singkatan;
            $data[] = $item->siswa()->count();
        });
        return Inertia::render('Admin/Mapel', ['label' => $label, 'data' => $data]);
    }
    public function tahun()
    {
        $tahun = TahunAjaran::where('active', '=', 1)->first();
        $label = [];
        $jumlah = [];
        $datas = TahunAjaran::with('logs')->latest()->take(5)->get();
        $datas->map(function ($item) use (&$label, &$jumlah) {
            $label[] = $item->tahun;
            $jumlah[] = $item->logs->count();
            return;
        });
        return Inertia::render('Admin/Tahun', ['tahun' => $tahun, 'label' => $label, 'jumlah' => $jumlah]);
    }
    public function ujian()
    {
        $data = Ujian::query();
        $total = $data->count();
        $active = $data->where('active', '=',  true)->count();
        $nonactive = $data->where('active', '=',  false)->count();
        return Inertia::render('Admin/Ujian', ['total' => $total, 'active' => $active, 'nonactive' => $nonactive]);
    }

    public function siswa()
    {
        $jenjang = Jenjang::query()->get();
        $tingkat = Tingkat::with('jenjang')->get();
        $kelas = Kelas::query()->get();
        $mapel = Mapel::query()->get();
        $TA = TahunAjaran::where('active', '=', 1)->first();
        $sd = Siswa::whereHas('kelas.kelas.tingkat.jenjang', function($query){
            $query->where('slug', '=', 'SD');
        })->count();
        $smp = Siswa::whereHas('kelas.kelas.tingkat.jenjang', function($query){
            $query->where('slug', '=', 'SMP');
        })->count();
        $sma = Siswa::whereHas('kelas.kelas.tingkat.jenjang', function($query){
            $query->where('slug', '=', 'SMA');
        })->count();
        return Inertia::render('Admin/Siswa', ['jenjangs' => $jenjang, 'tingkats' => $tingkat, 'kelases' => $kelas, 'ta' => $TA, 'sd' => $sd, 'smp' => $smp, 'sma' => $sma, 'mapels' => $mapel]);
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
        $tingkat = Tingkat::count();
        $jenjang = Jenjang::count();
        $label = [];
        $data = [];
        $kelas = Kelas::with('siswa');
        $jumlah = $kelas->count();
        $kelas->get()->map(function ($item) use (&$label, &$data) {
            $label[] = $item->nama;
            $data[] = $item->siswa()->count();
        });
        return Inertia::render('Admin/Kelas', ['tingkat' => $tingkat, 'jenjang' => $jenjang, 'kelas' => $jumlah, 'label' => $label, 'data' => $data]);
    }
}

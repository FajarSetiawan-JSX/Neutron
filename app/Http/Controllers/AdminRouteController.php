<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Tingkat;
use App\Models\Ujian;
use App\Models\User;
use Carbon\Carbon;
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
        $kelastotal = Kelas::count();
        $labelMapel = [];
        $dataMapel = [];
        $mapelTerbanyak = Mapel::withCount('siswa')->orderByDesc('siswa_count')->limit(5)->get();
        foreach ($mapelTerbanyak as $mapel) {
            $labelMapel[] = $mapel->singkatan;
            $dataMapel[] = $mapel->siswa_count;
        }
        $labelKelas = [];
        $dataKelas = [];
        $kelasTerbanyak  = Kelas::whereHas('siswa.tahun', function ($q) {
            $q->where('active', '=', 1);
        })->withCount('siswa')->orderByDesc('siswa_count')->limit(5)->get();
        foreach ($kelasTerbanyak as $kelas) {
            $labelKelas[] = $kelas->nama;
            $dataKelas[] = $kelas->siswa_count;
        }
        return Inertia::render('Admin/Home', ['tahun' => $TA, 'siswa' => $students, 'tentor' => $tentors, 'mapel' => $mapels, 'kelas' => $kelastotal, 'labelmapel' => $labelMapel, 'datamapel' => $dataMapel, 'labelkelas' => $labelKelas, 'datakelas' => $dataKelas]);
    }
    public function tentor()
    {
        $total = User::where('role_id', '=', 2)->count();
        $mapel = [];
        $data = [];
        $collections = Mapel::with(['tentor'])->get();
        foreach ($collections as $collection) {
            $mapel[] = $collection->singkatan;
            $data[] = $collection->tentor()->count();
        }
        return Inertia::render('Admin/Tentor', ['total' => $total, 'data' => $data, 'label' => $mapel]);
    }
    public function tentorrombel($slug)
    {
        $user = User::where('slug', '=', $slug)->whereHas('role', function ($query) {
            $query->where('nama', '=', 'Pengajar');
        })->with(['mapel.mapel'])->first();
        $id = $user->id;
        $tingkat = Tingkat::with(['jenjang'])->get();
        $ta = TahunAjaran::where('active', '=', 1)->first();
        $label = [];
        $data = [];
        $rombels = Rombel::where('tahun_id', '=', $ta->id)->whereHas('subjek.tentor', function ($q) use ($id) {
            $q->where('id', '=', $id);
        })->with(['siswa'])->get();
        foreach ($rombels as $rombel) {
            $label[] = $rombel->name;
            $data[] = $rombel->siswa()->count();
        }
        return Inertia::render('Admin/RombelTentor', ['tentor' => $user, 'ta' => $ta, 'tingkat' => $tingkat, 'label' => $label, 'data' => $data]);
    }

    public function tentorrombelsiswa($id)
    {
        $rombel = Rombel::where('id', '=', $id)->with(['tingkat', 'subjek.tentor', 'subjek.mapel', 'tingkat', 'siswa', 'tahun', 'pertemuan'])->first();
        return Inertia::render('Admin/RombelSiswa', ['rombel' => $rombel]);
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
        $sd = Siswa::whereHas('kelas.kelas.tingkat.jenjang', function ($query) {
            $query->where('slug', '=', 'SD');
        })->count();
        $smp = Siswa::whereHas('kelas.kelas.tingkat.jenjang', function ($query) {
            $query->where('slug', '=', 'SMP');
        })->count();
        $sma = Siswa::whereHas('kelas.kelas.tingkat.jenjang', function ($query) {
            $query->where('slug', '=', 'SMA');
        })->count();
        $data = array_fill(0, 12, 0);
        $tahun = now()->year;
        $siswaPerBulan = Siswa::query()->whereYear('created_at', now()->year)->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')->groupByRaw('MONTH(created_at)')->pluck('total', 'bulan');
        foreach ($siswaPerBulan as $bulan => $total) {
            $data[$bulan - 1] = $total;
        }
        $off = Siswa::where('status', '=', 0)->where('lulus', '=', 1)->count();
        $nokelas = Siswa::whereDoesntHave('kelas.tahun', function ($s) use ($TA) {
            $s->where('id', '=', $TA->id);
        })->count();
        $nomapel = Siswa::whereDoesntHave('kelas.tahun', function ($s) use ($TA) {
            $s->where('id', '=', $TA->id);
        })->whereDoesntHave('mapel')->count();
        return Inertia::render('Admin/Siswa', ['jenjangs' => $jenjang, 'tingkats' => $tingkat, 'kelases' => $kelas, 'ta' => $TA, 'sd' => $sd, 'smp' => $smp, 'sma' => $sma, 'mapels' => $mapel, 'data' => $data, 'tahun' => $tahun, 'off' => $off, 'noklas' => $nokelas, 'nomapel' => $nomapel]);
    }

    public function informasi($nis)
    {
        $siswa = Siswa::where('nis', '=', $nis)->first();
        if (!$siswa) {
            return abort(404, 'Siswa tidak ditemukan');
        }
        $ta = TahunAjaran::where('active', '=', 1)->first();
        $avg = Nilai::whereHas('absensi.siswa.siswa', function ($query) use ($siswa) {
            $query->where('id', '=', $siswa->id);
        })->whereHas('absensi.siswa.rombel.tahun', function ($query) use ($ta) {
            $query->where('id', '=', $ta->id);
        })->avg('nilai');
        $pertemuan = Pertemuan::where('tipe_id', '=', 1)->whereHas('rombel.tahun', function ($query) use ($ta) {
            $query->where('id', '=', $ta->id);
        })->whereHas('rombel.siswa.siswa', function ($q) use ($siswa) {
            $q->where('id', '=', $siswa->id);
        })->count();
        $hadir = Absensi::whereHas('pertemuan', function ($q) use ($siswa) {
            $q->where('tipe_id', '=', 1);
        })->whereHas('siswa.siswa', function ($x) use ($siswa) {
            $x->where('id', '=', $siswa->id);
        })->whereHas('pertemuan.rombel.tahun', function ($query) use ($ta) {
            $query->where('id', '=', $ta->id);
        })->count();
        $tidak = $pertemuan - $hadir;
        $persentase = $pertemuan > 0 ? ($hadir / $pertemuan) * 100 : 0;

        $rombels = Rombel::whereHas('siswa.siswa', function ($query) use ($siswa) {
            $query->where('id', '=', $siswa->id);
        })->where('tahun_id', '=', $ta->id)->with('subjek.mapel', 'pertemuan.absensi.nilai')->get();
        $label = [];
        $data = [];
        foreach ($rombels as $rombel) {
            $label[] = $rombel->subjek->mapel->singkatan;
            $nilai = $rombel->pertemuan
                ->flatMap(function ($pertemuan) use ($siswa) {
                    return $pertemuan->absensi
                        ->filter(function ($absensi) use ($siswa) {
                            return $absensi->siswa->siswa_id == $siswa->id;
                        })->pluck('nilai.nilai');
                })->filter()->avg();
            $data[] = round($nilai ?? 0, 2);
        }

        return Inertia::render('Admin/DetailSiswa', ['siswa' => $siswa, 'ta' => $ta, 'kelas' => $siswa->kelasSekarang->kelas ?? 'belum memilih kelas', 'avg' => $avg ?? 0, 'hadir' => $hadir, 'tidak' => $tidak, 'persentase' => $persentase, 'label' => $label, 'data' => $data, 'phone' => decrypt($siswa->phone), 'ortu' => decrypt($siswa->phone_ortu)]);
    }

    public function rombelsiswa($nis)
    {
        $ta = TahunAjaran::where('active', '=', 1)->first();
        $siswa = Siswa::where('nis', '=', $nis)->first();
        $kelas = KelasSiswa::where('siswa_id', '=', $siswa->id)->where('tahun_id', '=', $ta->id)->with(['kelas.tingkat'])->first();
        if (!$kelas) {
            return abort(403, $siswa->nama . ' Belum terdaftar pada kelas manapun pada Tahun Ajaran ' . $ta->tahun);
        }
        if ($siswa->status == 0) {
            return abort(403, 'Anda tidak diizinkan untuk mengakses rombel karena ' . $siswa->nama . ' bukan siswa aktif');
        }
        return Inertia::render('Admin/SiswaRombel', ['ta' => $ta, 'siswa' => $siswa, 'kelassiswa' => $kelas]);
    }

    public function rombeleditpengajar($id)
    {
        $rombel = Rombel::where('id', '=', $id)->with(['tahun', 'tingkat', 'subjek.tentor'])->first();
        if (!$rombel) {
            abort(404, 'Rombel tidak ditemukan');
        }
        $tentor = User::where('role_id', '=', 2)->with(['mapel.mapel'])->get();
        $result = $tentor->map(function ($t) {
            return [
                'id' => $t->id,
                'nama' => $t->name,
                'subjek' => $t->mapel?->map(function ($m) {
                    return [
                        'id' => $m->id,
                        'mapel' => $m->mapel->nama,
                    ];
                })
            ];
        });
        return Inertia::render('Admin/RombelEdit', ['rombel' => $rombel, 'tentors' => $result]);
    }

    public function presensi()
    {
        $tahun = TahunAjaran::where('active', '=', 1)->first();
        $tingkat = Tingkat::all();
        $jenjang = Jenjang::all();
        $total = Absensi::whereHas('pertemuan.rombel.tahun', function ($query) {
            $query->where('active', '=', 1);
        })->count();
        $persentase = ($total / 1000000) * 100;
        $day = [];
        $h = [];
        $t = [];
        $pertemuans = Pertemuan::where('tipe_id', '=', 1)->whereHas('rombel.tahun', function ($q) use ($tahun) {
            $q->where('id', '=', $tahun->id);
        })->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])->with(['absensi', 'rombel.siswa'])->get();
        Carbon::setLocale('id');
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i);
            $day[] = $tanggal->translatedFormat('l, d M');
            $hadir = 0;
            $tidak = 0;
            $pertemuanHariIni = $pertemuans->filter(function ($pertemuan) use ($tanggal) {
                return $pertemuan->created_at->isSameDay($tanggal);
            });
            foreach ($pertemuanHariIni as $pertemuan) {
                $jumlahHadir = $pertemuan->absensi->count();
                $jumlahSiswa = $pertemuan->rombel->siswa->count();
                $hadir += $jumlahHadir;
                $tidak += $jumlahSiswa - $jumlahHadir;
            }
            $h[] = $hadir;
            $t[] = $tidak;
        }
        return Inertia::render('Admin/Presensi', ['tahun' => $tahun, 'tingkat' => $tingkat, 'jenjang' => $jenjang, 'total' => $total, 'persentase' => $persentase, 'hari' => $day, 'hadir' => $h, 'tidak' => $t]);
    }

    public function nilai()
    {
        $tahun = TahunAjaran::where('active', '=', 1)->first();
        $tingkat = Tingkat::get();
        $jenjang = Jenjang::get();
        $nilai = Nilai::whereHas('absensi.pertemuan.rombel.tahun', function ($query) use ($tahun) {
            $query->where('id', '=', $tahun->id);
        });
        $min = $nilai->min('nilai');
        $max = $nilai->max('nilai');
        $avg = $nilai->avg('nilai');
        return Inertia::render('Admin/Nilai', ['tahun' => $tahun, 'tingkat' => $tingkat, 'jenjang' => $jenjang, 'min' => $min, 'max' => $max, 'avg' => $avg]);
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
    public function kelasDetail($slug)
    {
        $kelas = Kelas::where('slug', '=', $slug)->first();
        if (!$kelas) {
            abort(404, 'Kelas tidak ditemukan');
        }
        $ta = TahunAjaran::where('active', '=', 1)->first();
        return Inertia::render('Admin/KelasDetail', ['kelas' => $kelas, 'ta' => $ta]);
    }

    public function rombel()
    {
        $ta = TahunAjaran::where('active', '=', 1)->first();
        $mapels = Mapel::query()->get();
        $rombels = Rombel::where('tahun_id', '=', $ta->id)->with('subjek.mapel');
        $mapel = [];
        $jumlah = [];
        foreach ($mapels as $m) {
            $mapel[] = $m->singkatan;
            $jumlah[] = $rombels->whereHas('subjek.mapel', function ($r) use ($m) {
                $r->where('id', '=', $m->id);
            })->get()->count();
        }
        return Inertia::render('Admin/Rombel', ['ta' => $ta, 'mapel' => $mapel, 'jumlah' => $jumlah]);
    }

    public function alumni()
    {
        $ta = TahunAjaran::whereHas('alumni')->with(['alumni'])->get();
        $label = [];
        $data = [];
        foreach ($ta as $list) {
            $label[] = $list->tahun;
            $data[] = $list->alumni()->count();
        }
        return Inertia::render('Admin/Alumni', ['label' => $label, 'data' => $data]);
    }

    public function kelulusan()
    {
        $ta = TahunAjaran::where('active', '=', 1)->first();
        return Inertia::render('Admin/Kelulusan', ['ta' => $ta]);
    }

    public function sistem()
    {
        return Inertia::render('Admin/Sistem');
    }
}

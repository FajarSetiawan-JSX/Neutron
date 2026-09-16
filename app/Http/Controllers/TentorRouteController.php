<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\KelasSiswa;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pertemuan;
use App\Models\Rombel;
use App\Models\RombelSiswa;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Tingkat;
use App\Models\Tipe;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TentorRouteController extends Controller
{
    public function home()
    {
        $ta = TahunAjaran::where('active', '=', 1)->first();
        $siswawali = KelasSiswa::whereHas('kelas.wali.wali', function ($query) {
            $query->where('id', '=', Auth::user()->id);
        })->where('tahun_id', '=', $ta->id)->count();
        $totalsiswarombel = RombelSiswa::whereHas('rombel.subjek.tentor', function ($query) {
            $query->where('id', '=', Auth::user()->id);
        })->whereHas('rombel', function ($q) use ($ta) {
            $q->where('tahun_id', '=', $ta->id);
        })->count();
        $rombels = Rombel::whereHas('subjek.tentor', function ($query) {
            $query->where('id', '=', Auth::user()->id);
        })->where('tahun_id', '=', $ta->id);
        $totalrombel = $rombels->count();
        $rombels = $rombels->with(['siswa'])->get();

        $labelrombel = [];
        $datarombel = [];
        foreach ($rombels as $rombel) {
            $labelrombel[] = $rombel->name;
            $datarombel[] = $rombel->siswa()->count();
        }
        $labelkelas = [];
        $datakelas = [];
        $kelases = Kelas::whereHas('wali.wali', function ($query) {
            $query->where('id', '=', Auth::user()->id);
        })->whereHas('siswa.tahun', function ($q) use ($ta) {
            $q->where('id', '=', $ta->id);
        })->with(['siswa'])->get();
        foreach ($kelases as $kelas) {
            $labelkelas[] = $kelas->nama;
            $datakelas[] = $kelas->siswa()->count();
        }
        $labelmapel = [];
        $datamapel = [];
        $mapels = Mapel::whereHas('tentor.tentor', function ($query) {
            $query->where('id', '=', Auth::user()->id);
        })->with(['siswa'])->get();
        foreach ($mapels as $mapel) {
            $labelmapel[] = $mapel->singkatan ?? $mapel->nama;
            $datamapel[] = $mapel->siswa()->count();
        }

        return Inertia::render('Tentor/Home', ['siswawali' => $siswawali, 'totalrombel' => $totalrombel, 'siswarombel' => $totalsiswarombel, 'datarombel' => $datarombel, 'labelrombel' => $labelrombel, 'datakelas' => $datakelas, 'labelkelas' => $labelkelas, 'datamapel' => $datamapel, 'labelmapel' => $labelmapel, 'ta' => $ta]);
    }

    public function kelas()
    {
        $tingkat = Tingkat::all();
        return Inertia::render('Tentor/Kelas', ['tingkats' => $tingkat]);
    }

    public function kelasdetail($id)
    {
        $kelas = Kelas::where('id', '=', $id)->with(['tingkat', 'wali.wali'])->first();
        $siswas = Siswa::whereHas('kelas.kelas', function ($query) use ($kelas) {
            $query->where('id', '=', $kelas->id);
        })->whereHas('kelas.tahun', function ($q) {
            $q->where('active', '=', 1);
        });
        $ta = TahunAjaran::where('active', '=', 1)->first();
        return Inertia::render('Tentor/KelasDetail', ['kelas' => $kelas, 'total' => $siswas->count(), 'aktif' => $siswas->where('status', '=', 1)->count(), 'ta' => $ta]);
    }

    public function rombel()
    {
        $ta = TahunAjaran::where('active', '=', 1)->first();
        $tingkats = Tingkat::all();
        return Inertia::render('Tentor/Rombel', ['ta' => $ta, 'tingkats' => $tingkats]);
    }

    public function rombeldetail($id)
    {
        $rombel = Rombel::where('id', '=', $id)->with(['subjek.tentor', 'subjek.mapel', 'tahun', 'siswa', 'tingkat.jenjang'])->first();
        if (!$rombel) {
            return abort(404, 'Rombel tidak ditemukan');
        }
        return Inertia::render('Tentor/RombelDetail', ['rombel' => $rombel]);
    }

    public function rombeldetailsiswa($id)
    {
        $rombel = Rombel::where('id', '=', $id)->with(['subjek.tentor', 'subjek.mapel', 'tahun', 'siswa', 'tingkat.jenjang'])->first();
        if (!$rombel) {
            return abort(404, 'Rombel tidak ditemukan');
        }
        return Inertia::render('Tentor/RombelDetailSiswa', ['rombel' => $rombel]);
    }

    public function absen($id)
    {
        $pertemuan = Pertemuan::where('id', '=', $id)->with(['rombel.tingkat', 'rombel.tahun', 'rombel.siswa.siswa', 'absensi'])->first();
        if (!$pertemuan) {
            abort(404, 'ID Pertemuan tidak ditemukan');
        }
        $result = $pertemuan->rombel->siswa->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->siswa->nama,
                'nis' => $item->siswa->nis,
                'sekolah' => $item->siswa->sekolah,
                'kelas' => $item->siswa->kelasSekarang->kelas->nama,
                'status' => $item->siswa->status
            ];
        });
        return Inertia::render('Tentor/Absen', ['pertemuan' => $pertemuan, 'siswa' => $result]);
    }

    public function nilai($id)
    {
        $pertemuan = Pertemuan::where('id', '=', $id)->with(['rombel.tingkat', 'rombel.tahun', 'rombel.siswa.siswa', 'absensi'])->first();
        if (!$pertemuan) {
            abort(404, 'ID Pertemuan tidak ditemukan');
        }
        $types = Ujian::query()->get();
        $result = $pertemuan->rombel->siswa->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->siswa->nama,
                'nis' => $item->siswa->nis,
                'kelas' => $item->siswa->kelasSekarang->kelas->nama,
            ];
        });
        return Inertia::render('Tentor/Nilai', ['pertemuan' => $pertemuan, 'siswa' => $result, 'types' => $types]);
    }

    public function tambahan($id)
    {
        $rombel = Rombel::where('id', '=', $id)->with('tahun')->first();
        if (!$rombel) {
            abort(404, 'Rombel tidak ada');
        }
        $siswas = RombelSiswa::where('rombel_id', '=', $id)->with('siswa')->get();
        $result = $siswas->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->siswa->nama,
                'nis' => $item->siswa->nis,
                'sekolah' => $item->siswa->sekolah,
                'kelas' => $item->siswa->kelasSekarang
            ];
        });
        return Inertia::render('Tentor/Tambahan', ['siswas' => $result, 'rombel' => $rombel]);
    }

    public function detailpertemuan($id)
    {
        $pertemuan = Pertemuan::where('id', '=', $id)->with('rombel.tahun', 'rombel.subjek.mapel', 'absensi', 'tipe', 'rombel.siswa')->first();
        if (!$pertemuan) {
            abort(404, 'Server Error!');
        }
        if ($pertemuan->selesai != 1) {
            abort(409, 'Selesaikan Pertemuan terlebih dahulu');
        }
        $total = $pertemuan->rombel->siswa()->count() ?? 0;
        $hadir = $pertemuan->absensi()->count() ?? 0;
        $persentase = ($hadir / $total) * 100;
        $nilai = Nilai::whereHas('absensi.pertemuan', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->avg('nilai');
        $ujian = 'Tidak ada ujian';
        if ($nilai) {
            $ujian = Ujian::whereHas('nilai.absensi.pertemuan', function ($query) use ($id) {
                $query->where('id', '=', $id);
            })->value('nama');
        }
        $pertemuan = [
            'id' => $pertemuan->id,
            'rombel' => $pertemuan->rombel->name,
            'mapel' => $pertemuan->rombel->subjek->mapel->nama,
            'materi' => $pertemuan->materi,
            'pertemuan' => $pertemuan->pertemuan,
            'tipe' => $pertemuan->tipe->nama,
            'total' => $total,
            'absen' => $hadir,
            'persentase' => $persentase,
            'nilai' => $nilai ?? 0,
            'ujian' => $ujian,
            'tanggal' => $pertemuan->created_at,
        ];
        return Inertia::render('Tentor/DetailPertemuan', ['pertemuan' => $pertemuan]);
    }
}

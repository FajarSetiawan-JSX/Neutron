<?php

namespace Database\Seeders;

use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Tipe;
use App\Models\Ujian;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Role::create([
            'nama' => 'Admin',
            'slug' => 'admin'
        ]);
        Role::create([
            'nama' => 'Pengajar',
            'slug' => 'pengajar'
        ]);
        $hp1 = '1234567';
        $hp2 = '1111111';
        User::factory()->create([
            'name' => 'Admin',
            'slug' => Str::slug('Admin'),
            'role_id' => 1,
            'email' => 'admin@example.com',
            'phone' => encrypt($hp1),
            'phone_hash' => hash('sha256', $hp1),
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => 'Pengajar',
            'slug' => Str::slug('Pengajar S.Pd.,'),
            'role_id' => 2,
            'email' => 'pengajar@example.com',
            'phone' => encrypt($hp2),
            'phone_hash' => hash('sha256', $hp2),
            'password' => Hash::make('password'),
        ]);
        //Tipe ujian
        $evaluasi = Ujian::create([
            'nama' => 'Evaluasi',
            'slug' => 'evaluasi',
            'deskripsi' => 'Evaluasi harian setiap kali pertemuan guna mengetahui kemampuan siswa memahami materi.'
        ]);
        $standar = Ujian::create([
            'nama' => 'Standar',
            'slug' => 'standar',
            'deskripsi' => 'Ujian dilaksanakan setiap akhir bab.'
        ]);
        $standar = Ujian::create([
            'nama' => 'Try Out',
            'slug' => 'try-out',
            'deskripsi' => 'TRY OUT bagi kelas 6 9 dan 12 untuk mempersiapkan masuk ke PTN/PTS dan sebagainya.'
        ]);
        $gladi = Ujian::create([
            'nama' => 'Gladi Bersih',
            'slug' => 'gladi bersih',
            'deskripsi' => 'Ujian rutin yang dilaksanakan sebelum TPA atau sejenisnya.'
        ]);
        //jenjang
        $sd = Jenjang::create([
            'nama' => "Sekolah Dasar",
            'slug' => "SD",
            'subtitle' => "Tingkat Dasar",
        ]);
        $smp = Jenjang::create([
            'nama' => 'Sekolah Menengah Pertama',
            'slug' => 'SMP',
            'subtitle' => 'Tingkat Menengah'
        ]);
        $sma = Jenjang::create([
            'nama' => 'Sekolah Menengah Atas',
            'slug' => 'SMA',
            'subtitle' => 'Tingkat Akhir'
        ]);
        //tingkat
        $sd->tingkat()->create([
            'tingkat' => 1
        ]);
        $sd->tingkat()->create([
            'tingkat' => 2
        ]);
        $sd->tingkat()->create([
            'tingkat' => 3
        ]);
        $sd->tingkat()->create([
            'tingkat' => 4
        ]);
        $sd->tingkat()->create([
            'tingkat' => 5
        ]);
        $sd->tingkat()->create([
            'tingkat' => 6
        ]);
        $smp->tingkat()->create([
            'tingkat' => 7
        ]);
        $smp->tingkat()->create([
            'tingkat' => 8
        ]);
        $smp->tingkat()->create([
            'tingkat' => 9
        ]);
        $sma->tingkat()->create([
            'tingkat' => 10
        ]);
        $sma->tingkat()->create([
            'tingkat' => 11
        ]);
        $sma->tingkat()->create([
            'tingkat' => 12
        ]);

        //Tahun ajaran
        TahunAjaran::create([
            'tahun' => '2026 / 2027',
            'active' => true
        ]);

        //Tipe
        Tipe::create([
            'nama' => 'Pertemuan',
            'slug' => 'pertemuan'
        ]);
        Tipe::create([
            'nama' => 'Tambahan',
            'slug' => 'tambahan'
        ]);
    }
}

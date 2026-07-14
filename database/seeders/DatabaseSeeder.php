<?php

namespace Database\Seeders;

use App\Models\Jenjang;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Role;
use App\Models\Siswa;
use App\Models\TahunAjaran;
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
        User::factory()->create([
            'name' => 'Admin',
            'slug' => Str::slug('Admin'),
            'role_id' => 1,
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
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
            'subtitle' => 'ingkat Menengah'
        ]);
        $sma = Jenjang::create([
            'nama' => 'Sekolah Menengah Atas',
            'slug' => 'SMA',
            'subtitle' => 'Tingkat Akhir'
        ]);
        //tingkat
        $sd4 = $sd->tingkat()->create([
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
        $smp9 = $smp->tingkat()->create([
            'tingkat' => 9
        ]);
        $sma->tingkat()->create([
            'tingkat' => 10
        ]);
        $sma11 = $sma->tingkat()->create([
            'tingkat' => 11
        ]);
        $sma->tingkat()->create([
            'tingkat' => 12
        ]);
        //user pengajar
        $ari = User::factory()->create([
            'name' => 'Pengajar',
            'slug' => Str::slug('Pengajar'),
            'role_id' => 2,
            'email' => 'pengajar@example.com',
            'password' => Hash::make('password'),
        ]);
        //Tahun ajaran
        $TA2024_2025 = TahunAjaran::create([
            'tahun' => '2024 / 2025',
            'active' => false
        ]);
        $TA2025_2026 = TahunAjaran::create([
            'tahun' => '2025 / 2026',
            'active' => false
        ]);
        $TA2026_2027 = TahunAjaran::create([
            'tahun' => '2026 / 2027',
            'active' => true
        ]);
        $ipa = Mapel::create([
            'nama' => 'Ilmu Pengetahuan Alam',
            'slug' => 'ilmu-pengetahuan-alam',
            'singkatan' => 'IPA'
        ]);

        $erik = Siswa::create([
            'nama' => 'Erik Pratama',
            'slug' => Str::slug('Erik Pratama'),
            'nis' => '202600001',
            'sekolah' => 'SMA Negeri 1 Jakarta',
            'alamat' => 'Jakarta',
            'phone' => '081234567890',
        ]);

        $ari->mapel()->create([
            'mapel_id' => $ipa->id
        ]);

        $erik->mapel()->create([
            'mapel_id' => $ipa->id
        ]);

        $nana = Siswa::create([
            'nama' => 'Nana Safira',
            'slug' => Str::slug('Nana Safira'),
            'nis' => '202600002',
            'sekolah' => 'SMA Negeri 1 Jakarta',
            'alamat' => 'Jakarta',
            'phone' => '081298765432',
        ]);
        $nana->mapel()->create([
            'mapel_id' => $ipa->id
        ]);
    }
}

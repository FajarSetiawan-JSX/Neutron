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
            'name' => 'Admin Purbalingga',
            'slug' => Str::slug('Admin Purbalingga'),
            'role_id' => 1,
            'email' => 'purbalingga@neutron.pbg',
            'phone' => encrypt($hp1),
            'phone_hash' => hash('sha256', $hp1),
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => 'Hikmawati Nur Maulida',
            'slug' => Str::slug('Hikmawati Nur Maulida'),
            'role_id' => 2,
            'email' => 'hikmawatinm.03@gmail.com',
            'phone' => encrypt('6285600304525'),
            'phone_hash' => hash('sha256', '6285600304525'),
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => 'Petrina Ayun Nur Elma',
            'slug' => Str::slug('Petrina Ayun Nur Elma'),
            'role_id' => 2,
            'email' => 'petrinaayun@gmail.com',
            'phone' => encrypt('6285890436498'),
            'phone_hash' => hash('sha256', '6285890436498'),
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => 'Anistyatun Nur Azizah',
            'slug' => Str::slug('Anistyatun Nur Azizah'),
            'role_id' => 2,
            'email' => 'anistyatunazizah@gmail.com',
            'phone' => encrypt('6281229080107'),
            'phone_hash' => hash('sha256', '6281229080107'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Deni Eliawati',
            'slug' => Str::slug('Deni Eliawati'),
            'role_id' => 2,
            'email' => 'dhenieliawati@gmail.com',
            'phone' => encrypt('6285870550636'),
            'phone_hash' => hash('sha256', '6285870550636'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Nur Indah Puspita Sari',
            'slug' => Str::slug('Nur Indah Puspita Sari'),
            'role_id' => 2,
            'email' => 'nurindahpspt@gmail.com',
            'phone' => encrypt('6287857428214'),
            'phone_hash' => hash('sha256', '6287857428214'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Alfina Ainaya Malihah',
            'slug' => Str::slug('Alfina Ainaya Malihah'),
            'role_id' => 2,
            'email' => 'alfinaaainayaa@gmail.com',
            'phone' => encrypt('6289671342169'),
            'phone_hash' => hash('sha256', '6289671342169'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Silvia Deka Litzahra Fajlia Nissa',
            'slug' => Str::slug('Silvia Deka Litzahra Fajlia Nissa'),
            'role_id' => 2,
            'email' => 'silviadeka21@gmail.com',
            'phone' => encrypt('6282147804684'),
            'phone_hash' => hash('sha256', '6282147804684'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Annisa Nur Amalia',
            'slug' => Str::slug('Annisa Nur Amalia'),
            'role_id' => 2,
            'email' => 'annisaaamalia09@gmail.com',
            'phone' => encrypt('6282324328268'),
            'phone_hash' => hash('sha256', '6282324328268'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Sabrina Trissanji',
            'slug' => Str::slug('Sabrina Trissanji'),
            'role_id' => 2,
            'email' => 'sabrinatriss14@gmail.com',
            'phone' => encrypt('6281321209522'),
            'phone_hash' => hash('sha256', '6281321209522'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Qonita Mumtaz Reyhanah',
            'slug' => Str::slug('Qonita Mumtaz Reyhanah'),
            'role_id' => 2,
            'email' => 'qonitareyhanah@gmail.com',
            'phone' => encrypt('6285859789146'),
            'phone_hash' => hash('sha256', '6285859789146'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Dwi Septiani',
            'slug' => Str::slug('Dwi Septiani'),
            'role_id' => 2,
            'email' => 'dwiseptiani933@gmail.com',
            'phone' => encrypt('6285842574537'),
            'phone_hash' => hash('sha256', '6285842574537'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Devita Rosdiana',
            'slug' => Str::slug('Devita Rosdiana'),
            'role_id' => 2,
            'email' => 'deva.rthemys14@gmail.com',
            'phone' => encrypt('6285227741144'),
            'phone_hash' => hash('sha256', '6285227741144'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Ariyanto',
            'slug' => Str::slug('Ariyanto'),
            'role_id' => 2,
            'email' => 'ariyantotrik@gmail.com',
            'phone' => encrypt('6285747871935'),
            'phone_hash' => hash('sha256', '6285747871935'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Tinuk Setyowati',
            'slug' => Str::slug('Tinuk Setyowati'),
            'role_id' => 2,
            'email' => 'sofiacllg@gmail.com',
            'phone' => encrypt('6281325217506'),
            'phone_hash' => hash('sha256', '6281325217506'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Ali Zulfikar',
            'slug' => Str::slug('Ali Zulfikar'),
            'role_id' => 2,
            'email' => 'queen05032018@gmail.com',
            'phone' => encrypt('6285865949649'),
            'phone_hash' => hash('sha256', '6285865949649'),
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Arini Nur Lathifah',
            'slug' => Str::slug('Arini Nur Lathifah'),
            'role_id' => 2,
            'email' => 'arininurlathifah57@gmail.com',
            'phone' => encrypt('6289603134063'),
            'phone_hash' => hash('sha256', '6289603134063'),
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



        Siswa::create([
            'nama' => 'AMRU PRAMUDHITA P',
            'slug' => Str::slug('AMRU PRAMUDHITA P'),
            'nis' => '31-337-007-6',
            'sekolah' => 'SMA N1 KEMANGKON',
            'alamat' => null,
            'phone' => encrypt('6289647698080'),
            'phone_hash' => hash('sha256', '6289647698080'),
            'phone_ortu' => encrypt('6285842522810'),
            'phone_ortu_hash' => hash('sha256', '6285842522810'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAYLA SYAUQIYA RAHMA',
            'slug' => Str::slug('NAYLA SYAUQIYA RAHMA'),
            'nis' => '31-337-008-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281413396436'),
            'phone_hash' => hash('sha256', '6281413396436'),
            'phone_ortu' => encrypt('6285842913952'),
            'phone_ortu_hash' => hash('sha256', '6285842913952'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FATA MIFTAKHURRIZKI',
            'slug' => Str::slug('FATA MIFTAKHURRIZKI'),
            'nis' => '31-337-009-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628971000609'),
            'phone_hash' => hash('sha256', '628971000609'),
            'phone_ortu' => encrypt('62895622910203'),
            'phone_ortu_hash' => hash('sha256', '62895622910203'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'QUEENA ATHALLAH N',
            'slug' => Str::slug('QUEENA ATHALLAH N'),
            'nis' => '21-337-010-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628976651976'),
            'phone_hash' => hash('sha256', '628976651976'),
            'phone_ortu' => encrypt('6285866229610'),
            'phone_ortu_hash' => hash('sha256', '6285866229610'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HAYYA MAAJIDAH',
            'slug' => Str::slug('HAYYA MAAJIDAH'),
            'nis' => '31-337-010-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282125204804'),
            'phone_hash' => hash('sha256', '6282125204804'),
            'phone_ortu' => encrypt('6285726212974'),
            'phone_ortu_hash' => hash('sha256', '6285726212974'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD DAVIN I',
            'slug' => Str::slug('MUHAMMAD DAVIN I'),
            'nis' => '32-337-001-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285842179427'),
            'phone_hash' => hash('sha256', '6285842179427'),
            'phone_ortu' => encrypt('6285741705708'),
            'phone_ortu_hash' => hash('sha256', '6285741705708'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AZHAR FAIRUZ ARKAN',
            'slug' => Str::slug('AZHAR FAIRUZ ARKAN'),
            'nis' => '21-337-012-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895634495154'),
            'phone_hash' => hash('sha256', '62895634495154'),
            'phone_ortu' => encrypt('6287737026707'),
            'phone_ortu_hash' => hash('sha256', '6287737026707'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'JUANITA SALMA NADIRA',
            'slug' => Str::slug('JUANITA SALMA NADIRA'),
            'nis' => '31-337-011-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289658085667'),
            'phone_hash' => hash('sha256', '6289658085667'),
            'phone_ortu' => encrypt('6281327560599'),
            'phone_ortu_hash' => hash('sha256', '6281327560599'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FAIZAL HANUNG S',
            'slug' => Str::slug('FAIZAL HANUNG S'),
            'nis' => '21-337-013-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282111016385'),
            'phone_hash' => hash('sha256', '6282111016385'),
            'phone_ortu' => encrypt('6285867411509'),
            'phone_ortu_hash' => hash('sha256', '6285867411509'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BILQIS CEYSHA A',
            'slug' => Str::slug('BILQIS CEYSHA A'),
            'nis' => '31-337-012-6',
            'sekolah' => 'SMA N1 BUKATEJA',
            'alamat' => null,
            'phone' => encrypt('6281228793508'),
            'phone_hash' => hash('sha256', '6281228793508'),
            'phone_ortu' => encrypt('6281215119286'),
            'phone_ortu_hash' => hash('sha256', '6281215119286'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'VARENZHA NUR ASH SHYAM',
            'slug' => Str::slug('VARENZHA NUR ASH SHYAM'),
            'nis' => '21-337-014-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287850860630'),
            'phone_hash' => hash('sha256', '6287850860630'),
            'phone_ortu' => encrypt('628191426195'),
            'phone_ortu_hash' => hash('sha256', '628191426195'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD RADYA PANGESTU',
            'slug' => Str::slug('MUHAMMAD RADYA PANGESTU'),
            'nis' => '33-337-007-6',
            'sekolah' => 'SMP IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285712448104'),
            'phone_hash' => hash('sha256', '6285712448104'),
            'phone_ortu' => encrypt('6282243370160'),
            'phone_ortu_hash' => hash('sha256', '6282243370160'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AJENG NUR INTANI',
            'slug' => Str::slug('AJENG NUR INTANI'),
            'nis' => '21-337-015-6',
            'sekolah' => 'SMA N1 KUTASARI',
            'alamat' => null,
            'phone' => encrypt('6285866165103'),
            'phone_hash' => hash('sha256', '6285866165103'),
            'phone_ortu' => encrypt('628532828866'),
            'phone_ortu_hash' => hash('sha256', '628532828866'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NOUMIRA FATHMA ZULAIKA',
            'slug' => Str::slug('NOUMIRA FATHMA ZULAIKA'),
            'nis' => '21-337-016-6',
            'sekolah' => 'SMA N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6288225320449'),
            'phone_hash' => hash('sha256', '6288225320449'),
            'phone_ortu' => encrypt('6285227564123'),
            'phone_ortu_hash' => hash('sha256', '6285227564123'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARFAN ASHFA R',
            'slug' => Str::slug('ARFAN ASHFA R'),
            'nis' => '31-337-014-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285728811253'),
            'phone_hash' => hash('sha256', '6285728811253'),
            'phone_ortu' => encrypt('628562524022'),
            'phone_ortu_hash' => hash('sha256', '628562524022'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AIDA NAJLA HANISAH',
            'slug' => Str::slug('AIDA NAJLA HANISAH'),
            'nis' => '21-337-017-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281327430594'),
            'phone_hash' => hash('sha256', '6281327430594'),
            'phone_ortu' => encrypt('6282328047828'),
            'phone_ortu_hash' => hash('sha256', '6282328047828'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DAVIANDHIRA ZIVVA',
            'slug' => Str::slug('DAVIANDHIRA ZIVVA'),
            'nis' => '31-337-015-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281317177662'),
            'phone_hash' => hash('sha256', '6281317177662'),
            'phone_ortu' => encrypt('62816695477'),
            'phone_ortu_hash' => hash('sha256', '62816695477'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALFANNURA KHAIRAN ABDILLAH',
            'slug' => Str::slug('ALFANNURA KHAIRAN ABDILLAH'),
            'nis' => '21-337-018-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282226194325'),
            'phone_hash' => hash('sha256', '6282226194325'),
            'phone_ortu' => encrypt('6281392285741'),
            'phone_ortu_hash' => hash('sha256', '6281392285741'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'M. ATHAR MAHESWARA JUSTIANSAH',
            'slug' => Str::slug('M. ATHAR MAHESWARA JUSTIANSAH'),
            'nis' => '11-337-001-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281325840977'),
            'phone_hash' => hash('sha256', '6281325840977'),
            'phone_ortu' => encrypt('628134291088'),
            'phone_ortu_hash' => hash('sha256', '628134291088'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KHAIRUNNISA ELMA MAZEA',
            'slug' => Str::slug('KHAIRUNNISA ELMA MAZEA'),
            'nis' => '33-337-010-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628358523281'),
            'phone_hash' => hash('sha256', '628358523281'),
            'phone_ortu' => encrypt('6285726587689'),
            'phone_ortu_hash' => hash('sha256', '6285726587689'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'M ALARIK PRAMUDI',
            'slug' => Str::slug('M ALARIK PRAMUDI'),
            'nis' => '13-337-001-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281325841167'),
            'phone_hash' => hash('sha256', '6281325841167'),
            'phone_ortu' => encrypt('6282134291088'),
            'phone_ortu_hash' => hash('sha256', '6282134291088'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALTRIA R. WIJAYA',
            'slug' => Str::slug('ALTRIA R. WIJAYA'),
            'nis' => '11-337-002-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281325883345'),
            'phone_hash' => hash('sha256', '6281325883345'),
            'phone_ortu' => encrypt('6282237655253'),
            'phone_ortu_hash' => hash('sha256', '6282237655253'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DAFFA ALFREDA D',
            'slug' => Str::slug('DAFFA ALFREDA D'),
            'nis' => '31-337-017-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281324496653'),
            'phone_hash' => hash('sha256', '6281324496653'),
            'phone_ortu' => encrypt('6282112306890'),
            'phone_ortu_hash' => hash('sha256', '6282112306890'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'REGAN MUHAMMAD AZALIA',
            'slug' => Str::slug('REGAN MUHAMMAD AZALIA'),
            'nis' => '31-337-018-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289604050299'),
            'phone_hash' => hash('sha256', '6289604050299'),
            'phone_ortu' => encrypt('6285848163153'),
            'phone_ortu_hash' => hash('sha256', '6285848163153'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'LEILA ASNA H',
            'slug' => Str::slug('LEILA ASNA H'),
            'nis' => '31-337-019-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628818587988'),
            'phone_hash' => hash('sha256', '628818587988'),
            'phone_ortu' => encrypt('628121531865'),
            'phone_ortu_hash' => hash('sha256', '628121531865'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ZAHRA AFIFAH HAKIM',
            'slug' => Str::slug('ZAHRA AFIFAH HAKIM'),
            'nis' => '31-337-020-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289514916582'),
            'phone_hash' => hash('sha256', '6289514916582'),
            'phone_ortu' => encrypt('62895801037905'),
            'phone_ortu_hash' => hash('sha256', '62895801037905'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AMANDA CHUSNIA R',
            'slug' => Str::slug('AMANDA CHUSNIA R'),
            'nis' => '33-337-012-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285725079807'),
            'phone_hash' => hash('sha256', '6285725079807'),
            'phone_ortu' => encrypt('6281542941450'),
            'phone_ortu_hash' => hash('sha256', '6281542941450'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ZIDNY ZULKARNAEN AL FAQIH',
            'slug' => Str::slug('ZIDNY ZULKARNAEN AL FAQIH'),
            'nis' => '13-337-002-6',
            'sekolah' => 'HARAP DIGANTI',
            'alamat' => null,
            'phone' => encrypt('6282323479299'),
            'phone_hash' => hash('sha256', '6282323479299'),
            'phone_ortu' => encrypt('6285228011573'),
            'phone_ortu_hash' => hash('sha256', '6285228011573'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'PIJAR RAYA AISYZAHRA',
            'slug' => Str::slug('PIJAR RAYA AISYZAHRA'),
            'nis' => '31-337-021-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289696013945'),
            'phone_hash' => hash('sha256', '6289696013945'),
            'phone_ortu' => encrypt('6281327999111'),
            'phone_ortu_hash' => hash('sha256', '6281327999111'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SEKAR MELATI',
            'slug' => Str::slug('SEKAR MELATI'),
            'nis' => '31-337-022-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289670280370'),
            'phone_hash' => hash('sha256', '6289670280370'),
            'phone_ortu' => encrypt('6282227060389'),
            'phone_ortu_hash' => hash('sha256', '6282227060389'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'IBRAHIM SATYA N',
            'slug' => Str::slug('IBRAHIM SATYA N'),
            'nis' => '33-337-014-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281390092019'),
            'phone_hash' => hash('sha256', '6281390092019'),
            'phone_ortu' => encrypt('6281390092019'),
            'phone_ortu_hash' => hash('sha256', '6281390092019'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FARIZA MUDHIA R',
            'slug' => Str::slug('FARIZA MUDHIA R'),
            'nis' => '31-337-023-6',
            'sekolah' => 'SMA N1 REMBANG PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62882007118180'),
            'phone_hash' => hash('sha256', '62882007118180'),
            'phone_ortu' => encrypt('6281326724008'),
            'phone_ortu_hash' => hash('sha256', '6281326724008'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'M. FAKHREZA AZHAR',
            'slug' => Str::slug('M. FAKHREZA AZHAR'),
            'nis' => '31-337-024-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289604038776'),
            'phone_hash' => hash('sha256', '6289604038776'),
            'phone_ortu' => encrypt('62816693646'),
            'phone_ortu_hash' => hash('sha256', '62816693646'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AISYAH AYUDIA INARA KUSUMA',
            'slug' => Str::slug('AISYAH AYUDIA INARA KUSUMA'),
            'nis' => '33-337-015-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895406695698'),
            'phone_hash' => hash('sha256', '62895406695698'),
            'phone_ortu' => encrypt('628562630389'),
            'phone_ortu_hash' => hash('sha256', '628562630389'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AZZAM KHAIRUL G',
            'slug' => Str::slug('AZZAM KHAIRUL G'),
            'nis' => '33-337-016-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282138313962'),
            'phone_hash' => hash('sha256', '6282138313962'),
            'phone_ortu' => encrypt('6281320003480'),
            'phone_ortu_hash' => hash('sha256', '6281320003480'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NADIA AQIELA CHAIRANI',
            'slug' => Str::slug('NADIA AQIELA CHAIRANI'),
            'nis' => '22-337-002-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285641349290'),
            'phone_hash' => hash('sha256', '6285641349290'),
            'phone_ortu' => encrypt('6282223149947'),
            'phone_ortu_hash' => hash('sha256', '6282223149947'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SEKAR ESSYA RAKHMADANI',
            'slug' => Str::slug('SEKAR ESSYA RAKHMADANI'),
            'nis' => '31-337-001-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289527309878'),
            'phone_hash' => hash('sha256', '6289527309878'),
            'phone_ortu' => encrypt('628991560341'),
            'phone_ortu_hash' => hash('sha256', '628991560341'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARRSIL KHAIRAN KHAIRINSYAH',
            'slug' => Str::slug('ARRSIL KHAIRAN KHAIRINSYAH'),
            'nis' => '21-337-001-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6288214889589'),
            'phone_hash' => hash('sha256', '6288214889589'),
            'phone_ortu' => encrypt('6281292548854'),
            'phone_ortu_hash' => hash('sha256', '6281292548854'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AZKA ZHAFIR U',
            'slug' => Str::slug('AZKA ZHAFIR U'),
            'nis' => '33-337-001-6',
            'sekolah' => 'SMP N1 BOJONGSARI',
            'alamat' => null,
            'phone' => encrypt('6285848704088'),
            'phone_hash' => hash('sha256', '6285848704088'),
            'phone_ortu' => encrypt('6285878735022'),
            'phone_ortu_hash' => hash('sha256', '6285878735022'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'UFAIRA NAILA NUR AFIFA',
            'slug' => Str::slug('UFAIRA NAILA NUR AFIFA'),
            'nis' => '23-337-001-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281329686153'),
            'phone_hash' => hash('sha256', '6281329686153'),
            'phone_ortu' => encrypt('6285881037279'),
            'phone_ortu_hash' => hash('sha256', '6285881037279'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NIESHA ATHALLAH',
            'slug' => Str::slug('NIESHA ATHALLAH'),
            'nis' => '23-337-003-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285122010078'),
            'phone_hash' => hash('sha256', '6285122010078'),
            'phone_ortu' => encrypt('6285869979777'),
            'phone_ortu_hash' => hash('sha256', '6285869979777'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RAFFIANDRA NAUFAL ATMAJA',
            'slug' => Str::slug('RAFFIANDRA NAUFAL ATMAJA'),
            'nis' => '23-337-002-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285848188000'),
            'phone_hash' => hash('sha256', '6285848188000'),
            'phone_ortu' => encrypt('628122722301'),
            'phone_ortu_hash' => hash('sha256', '628122722301'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ANNISA ANANDA MULIA',
            'slug' => Str::slug('ANNISA ANANDA MULIA'),
            'nis' => '23-337-004-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285865783209'),
            'phone_hash' => hash('sha256', '6285865783209'),
            'phone_ortu' => encrypt('6285641459490'),
            'phone_ortu_hash' => hash('sha256', '6285641459490'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SHAKINA NAFEEZA PUTRI',
            'slug' => Str::slug('SHAKINA NAFEEZA PUTRI'),
            'nis' => '33-337-002-6',
            'sekolah' => 'SMP N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('62882001058665'),
            'phone_hash' => hash('sha256', '62882001058665'),
            'phone_ortu' => encrypt('6282325532125'),
            'phone_ortu_hash' => hash('sha256', '6282325532125'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SABRINA AZALYA S',
            'slug' => Str::slug('SABRINA AZALYA S'),
            'nis' => '33-337-003-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285700398559'),
            'phone_hash' => hash('sha256', '6285700398559'),
            'phone_ortu' => encrypt('6285700398559'),
            'phone_ortu_hash' => hash('sha256', '6285700398559'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NIKHLAH KHOIRUNNISYA',
            'slug' => Str::slug('NIKHLAH KHOIRUNNISYA'),
            'nis' => '33-337-004-6',
            'sekolah' => 'SMP N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628813792477'),
            'phone_hash' => hash('sha256', '628813792477'),
            'phone_ortu' => encrypt('62885291194606'),
            'phone_ortu_hash' => hash('sha256', '62885291194606'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RAFAT KHAIRY QUSHAYYI',
            'slug' => Str::slug('RAFAT KHAIRY QUSHAYYI'),
            'nis' => '33-337-005-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285221669960'),
            'phone_hash' => hash('sha256', '6285221669960'),
            'phone_ortu' => encrypt('6282227008089'),
            'phone_ortu_hash' => hash('sha256', '6282227008089'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DWI ANDIKA SATYA W',
            'slug' => Str::slug('DWI ANDIKA SATYA W'),
            'nis' => '31-337-002-6',
            'sekolah' => 'SMA N1 KUTASARI',
            'alamat' => null,
            'phone' => encrypt('6285201532929'),
            'phone_hash' => hash('sha256', '6285201532929'),
            'phone_ortu' => encrypt('6287882908222'),
            'phone_ortu_hash' => hash('sha256', '6287882908222'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NOFASA DWI UJI A',
            'slug' => Str::slug('NOFASA DWI UJI A'),
            'nis' => '31-337-003-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6283844212229'),
            'phone_hash' => hash('sha256', '6283844212229'),
            'phone_ortu' => encrypt('6281225298298'),
            'phone_ortu_hash' => hash('sha256', '6281225298298'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GATHFAN ABDILAH FIRDAUS',
            'slug' => Str::slug('GATHFAN ABDILAH FIRDAUS'),
            'nis' => '31-337-004-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287749989221'),
            'phone_hash' => hash('sha256', '6287749989221'),
            'phone_ortu' => encrypt('6287896618608'),
            'phone_ortu_hash' => hash('sha256', '6287896618608'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GISELLA CHRISTYA PRAMESWARI',
            'slug' => Str::slug('GISELLA CHRISTYA PRAMESWARI'),
            'nis' => '31-337-005-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6285283805611'),
            'phone_hash' => hash('sha256', '6285283805611'),
            'phone_ortu' => encrypt('6285291700080'),
            'phone_ortu_hash' => hash('sha256', '6285291700080'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALETHA KHAIRA ADRISTI',
            'slug' => Str::slug('ALETHA KHAIRA ADRISTI'),
            'nis' => '31-337-006-6',
            'sekolah' => 'SMA N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6282310358588'),
            'phone_hash' => hash('sha256', '6282310358588'),
            'phone_ortu' => encrypt('6285200488883'),
            'phone_ortu_hash' => hash('sha256', '6285200488883'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GHAITSA MALVA ALIFIA',
            'slug' => Str::slug('GHAITSA MALVA ALIFIA'),
            'nis' => '21-337-003-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285706296260'),
            'phone_hash' => hash('sha256', '6285706296260'),
            'phone_ortu' => encrypt('6282137765800'),
            'phone_ortu_hash' => hash('sha256', '6282137765800'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'JELITA NURDIANI',
            'slug' => Str::slug('JELITA NURDIANI'),
            'nis' => '21-337-004-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285869579253'),
            'phone_hash' => hash('sha256', '6285869579253'),
            'phone_ortu' => encrypt('6285600458133'),
            'phone_ortu_hash' => hash('sha256', '6285600458133'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DESTIANA SAHLA W',
            'slug' => Str::slug('DESTIANA SAHLA W'),
            'nis' => '21-337-005-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282325537119'),
            'phone_hash' => hash('sha256', '6282325537119'),
            'phone_ortu' => encrypt('6281382047992'),
            'phone_ortu_hash' => hash('sha256', '6281382047992'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KHEYLLA DWI P',
            'slug' => Str::slug('KHEYLLA DWI P'),
            'nis' => '21-337-006-6',
            'sekolah' => 'SMA N1 BUKATEJA',
            'alamat' => null,
            'phone' => encrypt('6282226810417'),
            'phone_hash' => hash('sha256', '6282226810417'),
            'phone_ortu' => encrypt('628291772000'),
            'phone_ortu_hash' => hash('sha256', '628291772000'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CHYNTIA MILISIA CHRISTY',
            'slug' => Str::slug('CHYNTIA MILISIA CHRISTY'),
            'nis' => '22-337-001-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6285640988543'),
            'phone_hash' => hash('sha256', '6285640988543'),
            'phone_ortu' => encrypt('6281542722288'),
            'phone_ortu_hash' => hash('sha256', '6281542722288'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KARIMA FAIRUZ ZAKIYYA',
            'slug' => Str::slug('KARIMA FAIRUZ ZAKIYYA'),
            'nis' => '21-337-007-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282220264127'),
            'phone_hash' => hash('sha256', '6282220264127'),
            'phone_ortu' => encrypt('6285227948885'),
            'phone_ortu_hash' => hash('sha256', '6285227948885'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KAYLA HAQANI FII. AMANILAH',
            'slug' => Str::slug('KAYLA HAQANI FII. AMANILAH'),
            'nis' => '21-337-008-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285701905585'),
            'phone_hash' => hash('sha256', '6285701905585'),
            'phone_ortu' => encrypt('6285664306618'),
            'phone_ortu_hash' => hash('sha256', '6285664306618'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AZZALEA GRACE KHALIQADZAHIN',
            'slug' => Str::slug('AZZALEA GRACE KHALIQADZAHIN'),
            'nis' => '21-337-009-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62882003760341'),
            'phone_hash' => hash('sha256', '62882003760341'),
            'phone_ortu' => encrypt('6285225181802'),
            'phone_ortu_hash' => hash('sha256', '6285225181802'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SHAQUILLE ATHARRAYHAN ZIDANE',
            'slug' => Str::slug('SHAQUILLE ATHARRAYHAN ZIDANE'),
            'nis' => '33-337-006-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('62895400747157'),
            'phone_hash' => hash('sha256', '62895400747157'),
            'phone_ortu' => encrypt('62895612459819'),
            'phone_ortu_hash' => hash('sha256', '62895612459819'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SALWA HANIYAH',
            'slug' => Str::slug('SALWA HANIYAH'),
            'nis' => '21-337-011-6',
            'sekolah' => 'SMA N1 BUKATEJA',
            'alamat' => null,
            'phone' => encrypt('6285785728980'),
            'phone_hash' => hash('sha256', '6285785728980'),
            'phone_ortu' => encrypt('6281227426939'),
            'phone_ortu_hash' => hash('sha256', '6281227426939'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GARNETA NATHANIA S',
            'slug' => Str::slug('GARNETA NATHANIA S'),
            'nis' => '60-337-001-6',
            'sekolah' => 'SD PIUS PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285142966521'),
            'phone_hash' => hash('sha256', '6285142966521'),
            'phone_ortu' => encrypt('6282133385646'),
            'phone_ortu_hash' => hash('sha256', '6282133385646'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FARHAN FADLU F',
            'slug' => Str::slug('FARHAN FADLU F'),
            'nis' => '32-337-002-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285742701722'),
            'phone_hash' => hash('sha256', '6285742701722'),
            'phone_ortu' => encrypt('6288902808984'),
            'phone_ortu_hash' => hash('sha256', '6288902808984'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BAGAS ANGGA KESUMA',
            'slug' => Str::slug('BAGAS ANGGA KESUMA'),
            'nis' => '31-337-013-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281327752000'),
            'phone_hash' => hash('sha256', '6281327752000'),
            'phone_ortu' => encrypt('6281327752000'),
            'phone_ortu_hash' => hash('sha256', '6281327752000'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ANINDYA PUTRI M',
            'slug' => Str::slug('ANINDYA PUTRI M'),
            'nis' => '33-337-008-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282134778681'),
            'phone_hash' => hash('sha256', '6282134778681'),
            'phone_ortu' => encrypt('628156986011'),
            'phone_ortu_hash' => hash('sha256', '628156986011'),
            'status' => true,
            'lulus' => false,
        ]);

        $phone = '62' . fake()->numerify('##########');

        Siswa::create([
            'nama' => 'MUHAMMAD FAIZ RISYADI',
            'slug' => Str::slug('MUHAMMAD FAIZ RISYADI'),
            'nis' => '60-337-002-6',
            'sekolah' => 'SD IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt($phone),
            'phone_hash' => hash('sha256', $phone),
            'phone_ortu' => encrypt('628156918854'),
            'phone_ortu_hash' => hash('sha256', '628156918854'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ELISABETH CHERYL ALIKA PUTRI KUSUMA',
            'slug' => Str::slug('ELISABETH CHERYL ALIKA PUTRI KUSUMA'),
            'nis' => '60-337-003-6',
            'sekolah' => 'SD PIUS PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895397452233'),
            'phone_hash' => hash('sha256', '62895397452233'),
            'phone_ortu' => encrypt('628954220000'),
            'phone_ortu_hash' => hash('sha256', '628954220000'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ADHA ADINNUHA SIGIT WIBOWO',
            'slug' => Str::slug('ADHA ADINNUHA SIGIT WIBOWO'),
            'nis' => '33-337-009-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285713167071'),
            'phone_hash' => hash('sha256', '6285713167071'),
            'phone_ortu' => encrypt('6285842555670'),
            'phone_ortu_hash' => hash('sha256', '6285842555670'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ORVIN BETHAN ALLISON',
            'slug' => Str::slug('ORVIN BETHAN ALLISON'),
            'nis' => '31-337-016-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281329869595'),
            'phone_hash' => hash('sha256', '6281329869595'),
            'phone_ortu' => encrypt('6282136083455'),
            'phone_ortu_hash' => hash('sha256', '6282136083455'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALZENA PUSPA JANEETA',
            'slug' => Str::slug('ALZENA PUSPA JANEETA'),
            'nis' => '33-337-011-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282134259743'),
            'phone_hash' => hash('sha256', '6282134259743'),
            'phone_ortu' => encrypt('6281233226154'),
            'phone_ortu_hash' => hash('sha256', '6281233226154'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'META FAYZA ALINE',
            'slug' => Str::slug('META FAYZA ALINE'),
            'nis' => '33-337-013-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287710459052'),
            'phone_hash' => hash('sha256', '6287710459052'),
            'phone_ortu' => encrypt('628994439308'),
            'phone_ortu_hash' => hash('sha256', '628994439308'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MICHELLE ANGELICA SUMAKUL',
            'slug' => Str::slug('MICHELLE ANGELICA SUMAKUL'),
            'nis' => '23-337-005-6',
            'sekolah' => 'SMP N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6281328832265'),
            'phone_hash' => hash('sha256', '6281328832265'),
            'phone_ortu' => encrypt('6281327144453'),
            'phone_ortu_hash' => hash('sha256', '6281327144453'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AMADEA SINANTYA',
            'slug' => Str::slug('AMADEA SINANTYA'),
            'nis' => '31-337-025-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6283896159222'),
            'phone_hash' => hash('sha256', '6283896159222'),
            'phone_ortu' => encrypt('628971007888'),
            'phone_ortu_hash' => hash('sha256', '628971007888'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NADINE ALIFIA ZAHRA',
            'slug' => Str::slug('NADINE ALIFIA ZAHRA'),
            'nis' => '31-337-026-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('6282136054034'),
            'phone_hash' => hash('sha256', '6282136054034'),
            'phone_ortu' => encrypt('6282226920420'),
            'phone_ortu_hash' => hash('sha256', '6282226920420'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SCHOLASTICA LARASATI',
            'slug' => Str::slug('SCHOLASTICA LARASATI'),
            'nis' => '60-337-004-6',
            'sekolah' => 'SD PIUS PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285801050578'),
            'phone_hash' => hash('sha256', '6285801050578'),
            'phone_ortu' => encrypt('6281226706905'),
            'phone_ortu_hash' => hash('sha256', '6281226706905'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SEVIAN MAHARDIKAARDHANI',
            'slug' => Str::slug('SEVIAN MAHARDIKAARDHANI'),
            'nis' => '60-337-005-6',
            'sekolah' => 'SD N2 KALIMANAH WETAN',
            'alamat' => null,
            'phone' => encrypt('6283856532042'),
            'phone_hash' => hash('sha256', '6283856532042'),
            'phone_ortu' => encrypt('6282122820116'),
            'phone_ortu_hash' => hash('sha256', '6282122820116'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NARELLA ANDIKA KINANTI',
            'slug' => Str::slug('NARELLA ANDIKA KINANTI'),
            'nis' => '33-337-017-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281563958643'),
            'phone_hash' => hash('sha256', '6281563958643'),
            'phone_ortu' => encrypt('6285880339441'),
            'phone_ortu_hash' => hash('sha256', '6285880339441'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DANISH AIMAR SANNI',
            'slug' => Str::slug('DANISH AIMAR SANNI'),
            'nis' => '33-337-020-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281225899200'),
            'phone_hash' => hash('sha256', '6281225899200'),
            'phone_ortu' => encrypt('628129736272'),
            'phone_ortu_hash' => hash('sha256', '628129736272'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RIFQI ANATOMI',
            'slug' => Str::slug('RIFQI ANATOMI'),
            'nis' => '31-337-027-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628818561557'),
            'phone_hash' => hash('sha256', '628818561557'),
            'phone_ortu' => encrypt('6281326410468'),
            'phone_ortu_hash' => hash('sha256', '6281326410468'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NADIA PUTRI J',
            'slug' => Str::slug('NADIA PUTRI J'),
            'nis' => '31-337-028-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285219444337'),
            'phone_hash' => hash('sha256', '6285219444337'),
            'phone_ortu' => encrypt('6285287899003'),
            'phone_ortu_hash' => hash('sha256', '6285287899003'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KEYSARLA IBNU MAMAN',
            'slug' => Str::slug('KEYSARLA IBNU MAMAN'),
            'nis' => '21-337-019-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62882006597558'),
            'phone_hash' => hash('sha256', '62882006597558'),
            'phone_ortu' => encrypt('62882003540543'),
            'phone_ortu_hash' => hash('sha256', '62882003540543'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AMIRA ESHAL A',
            'slug' => Str::slug('AMIRA ESHAL A'),
            'nis' => '11-337-003-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285878732613'),
            'phone_hash' => hash('sha256', '6285878732613'),
            'phone_ortu' => encrypt('6285549090392'),
            'phone_ortu_hash' => hash('sha256', '6285549090392'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AQILA CAHYA FADHILA',
            'slug' => Str::slug('AQILA CAHYA FADHILA'),
            'nis' => '31-337-029-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281382364509'),
            'phone_hash' => hash('sha256', '6281382364509'),
            'phone_ortu' => encrypt('6282136444922'),
            'phone_ortu_hash' => hash('sha256', '6282136444922'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'THOMAS ANTONIEO J',
            'slug' => Str::slug('THOMAS ANTONIEO J'),
            'nis' => '33-337-018-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285975290186'),
            'phone_hash' => hash('sha256', '6285975290186'),
            'phone_ortu' => encrypt('6281542885338'),
            'phone_ortu_hash' => hash('sha256', '6281542885338'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SYIFANA ALYA R',
            'slug' => Str::slug('SYIFANA ALYA R'),
            'nis' => '31-337-030-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289504038624'),
            'phone_hash' => hash('sha256', '6289504038624'),
            'phone_ortu' => encrypt('62895357409637'),
            'phone_ortu_hash' => hash('sha256', '62895357409637'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KHOLID SAIFULLOH',
            'slug' => Str::slug('KHOLID SAIFULLOH'),
            'nis' => '33-337-021-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6282325915415'),
            'phone_hash' => hash('sha256', '6282325915415'),
            'phone_ortu' => encrypt('62895322350835'),
            'phone_ortu_hash' => hash('sha256', '62895322350835'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD NASHIRUL HAQ',
            'slug' => Str::slug('MUHAMMAD NASHIRUL HAQ'),
            'nis' => '31-337-031-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281545588981'),
            'phone_hash' => hash('sha256', '6281545588981'),
            'phone_ortu' => encrypt('62895322350835'),
            'phone_ortu_hash' => hash('sha256', '62895322350835'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'UMAR HANIF ABDULQOHHAR',
            'slug' => Str::slug('UMAR HANIF ABDULQOHHAR'),
            'nis' => '60-337-006-6',
            'sekolah' => 'MI ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('62895322350835'),
            'phone_hash' => hash('sha256', '62895322350835'),
            'phone_ortu' => encrypt('62895322350835'),
            'phone_ortu_hash' => hash('sha256', '62895322350835'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NEYSHA MAHYA KIRANA',
            'slug' => Str::slug('NEYSHA MAHYA KIRANA'),
            'nis' => '32-337-003-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('628975806906'),
            'phone_hash' => hash('sha256', '628975806906'),
            'phone_ortu' => encrypt('62895634495082'),
            'phone_ortu_hash' => hash('sha256', '62895634495082'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GHAISAN FAEYZA ADEVI A',
            'slug' => Str::slug('GHAISAN FAEYZA ADEVI A'),
            'nis' => '60-337-007-6',
            'sekolah' => 'MI ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('62877863579911'),
            'phone_hash' => hash('sha256', '62877863579911'),
            'phone_ortu' => encrypt('62877863579911'),
            'phone_ortu_hash' => hash('sha256', '62877863579911'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BILLIAN TEGAR',
            'slug' => Str::slug('BILLIAN TEGAR'),
            'nis' => '31-337-032-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282228112784'),
            'phone_hash' => hash('sha256', '6282228112784'),
            'phone_ortu' => encrypt('6281328061324'),
            'phone_ortu_hash' => hash('sha256', '6281328061324'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SHAFIRA KHAIRINA DIAN KHANSA',
            'slug' => Str::slug('SHAFIRA KHAIRINA DIAN KHANSA'),
            'nis' => '11-337-004-6',
            'sekolah' => 'SMA N1 BUKATEJA',
            'alamat' => null,
            'phone' => encrypt('62895613040135'),
            'phone_hash' => hash('sha256', '62895613040135'),
            'phone_ortu' => encrypt('6285882153178'),
            'phone_ortu_hash' => hash('sha256', '6285882153178'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CALLISTA AZZARIN NUR A',
            'slug' => Str::slug('CALLISTA AZZARIN NUR A'),
            'nis' => '31-337-033-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281391491608'),
            'phone_hash' => hash('sha256', '6281391491608'),
            'phone_ortu' => encrypt('6281329445477'),
            'phone_ortu_hash' => hash('sha256', '6281329445477'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MAHILA NUR NARARRYA',
            'slug' => Str::slug('MAHILA NUR NARARRYA'),
            'nis' => '33-337-022-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285742974512'),
            'phone_hash' => hash('sha256', '6285742974512'),
            'phone_ortu' => encrypt('6285747766021'),
            'phone_ortu_hash' => hash('sha256', '6285747766021'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MAULANA RAFI S',
            'slug' => Str::slug('MAULANA RAFI S'),
            'nis' => '31-337-034-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282135202072'),
            'phone_hash' => hash('sha256', '6282135202072'),
            'phone_ortu' => encrypt('6281329676115'),
            'phone_ortu_hash' => hash('sha256', '6281329676115'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DAVIN RAFIF N',
            'slug' => Str::slug('DAVIN RAFIF N'),
            'nis' => '31-337-035-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895357410918'),
            'phone_hash' => hash('sha256', '62895357410918'),
            'phone_ortu' => encrypt('628156981935'),
            'phone_ortu_hash' => hash('sha256', '628156981935'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ADHYASTA AL CHASDITAMA',
            'slug' => Str::slug('ADHYASTA AL CHASDITAMA'),
            'nis' => '60-337-008-6',
            'sekolah' => 'SD IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281322685699'),
            'phone_hash' => hash('sha256', '6281322685699'),
            'phone_ortu' => encrypt('6281322685699'),
            'phone_ortu_hash' => hash('sha256', '6281322685699'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARGYA ZARIAT F',
            'slug' => Str::slug('ARGYA ZARIAT F'),
            'nis' => '31-337-036-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895423452699'),
            'phone_hash' => hash('sha256', '62895423452699'),
            'phone_ortu' => encrypt('6281804891888'),
            'phone_ortu_hash' => hash('sha256', '6281804891888'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GABRIELLA VALENTINO TJANDRA',
            'slug' => Str::slug('GABRIELLA VALENTINO TJANDRA'),
            'nis' => '33-337-023-6',
            'sekolah' => 'SMP ST BORROMEUS',
            'alamat' => null,
            'phone' => encrypt('6289607505090'),
            'phone_hash' => hash('sha256', '6289607505090'),
            'phone_ortu' => encrypt('6285640094649'),
            'phone_ortu_hash' => hash('sha256', '6285640094649'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HANANIA NAURA AUNI',
            'slug' => Str::slug('HANANIA NAURA AUNI'),
            'nis' => '23-337-006-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281328765452'),
            'phone_hash' => hash('sha256', '6281328765452'),
            'phone_ortu' => encrypt('6282313862242'),
            'phone_ortu_hash' => hash('sha256', '6282313862242'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'OMARHAEN SANDITRA P',
            'slug' => Str::slug('OMARHAEN SANDITRA P'),
            'nis' => '31-337-037-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628122701067'),
            'phone_hash' => hash('sha256', '628122701067'),
            'phone_ortu' => encrypt('6282289303939'),
            'phone_ortu_hash' => hash('sha256', '6282289303939'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KENZIE ALFARIZQI HUSEN',
            'slug' => Str::slug('KENZIE ALFARIZQI HUSEN'),
            'nis' => '33-337-024-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285227370022'),
            'phone_hash' => hash('sha256', '6285227370022'),
            'phone_ortu' => encrypt('6282136733356'),
            'phone_ortu_hash' => hash('sha256', '6282136733356'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SEBASTIAN ABIWARA PRADANA K',
            'slug' => Str::slug('SEBASTIAN ABIWARA PRADANA K'),
            'nis' => '23-337-007-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285799326810'),
            'phone_hash' => hash('sha256', '6285799326810'),
            'phone_ortu' => encrypt('6285643435104'),
            'phone_ortu_hash' => hash('sha256', '6285643435104'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BHATARA ABHIMANYU RAJENDRA',
            'slug' => Str::slug('BHATARA ABHIMANYU RAJENDRA'),
            'nis' => '31-337-038-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285227003859'),
            'phone_hash' => hash('sha256', '6285227003859'),
            'phone_ortu' => encrypt('6285779911342'),
            'phone_ortu_hash' => hash('sha256', '6285779911342'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'M. RAFIF AFHAM',
            'slug' => Str::slug('M. RAFIF AFHAM'),
            'nis' => '31-337-039-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285233580826'),
            'phone_hash' => hash('sha256', '6285233580826'),
            'phone_ortu' => encrypt('6282143681213'),
            'phone_ortu_hash' => hash('sha256', '6282143681213'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AFIQA PUTRI QONITA',
            'slug' => Str::slug('AFIQA PUTRI QONITA'),
            'nis' => '22-337-003-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282135151276'),
            'phone_hash' => hash('sha256', '6282135151276'),
            'phone_ortu' => encrypt('6285640856559'),
            'phone_ortu_hash' => hash('sha256', '6285640856559'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALMIRA RIENATA FIONY',
            'slug' => Str::slug('ALMIRA RIENATA FIONY'),
            'nis' => '31-337-042-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281393334149'),
            'phone_hash' => hash('sha256', '6281393334149'),
            'phone_ortu' => encrypt('6281227939496'),
            'phone_ortu_hash' => hash('sha256', '6281227939496'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SISKA AULIANA',
            'slug' => Str::slug('SISKA AULIANA'),
            'nis' => '33-337-025-6',
            'sekolah' => 'SMP N1 KALIMANAH',
            'alamat' => null,
            'phone' => encrypt('6282247068941'),
            'phone_hash' => hash('sha256', '6282247068941'),
            'phone_ortu' => encrypt('6287782153096'),
            'phone_ortu_hash' => hash('sha256', '6287782153096'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BINTANG ARVA ABHINAYA',
            'slug' => Str::slug('BINTANG ARVA ABHINAYA'),
            'nis' => '21-337-020-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628156999654'),
            'phone_hash' => hash('sha256', '628156999654'),
            'phone_ortu' => encrypt('6285600787933'),
            'phone_ortu_hash' => hash('sha256', '6285600787933'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SYAHWA AL KHALIFI',
            'slug' => Str::slug('SYAHWA AL KHALIFI'),
            'nis' => '31-337-040-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('62882007863108'),
            'phone_hash' => hash('sha256', '62882007863108'),
            'phone_ortu' => encrypt('6285227678498'),
            'phone_ortu_hash' => hash('sha256', '6285227678498'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NURIL ANBIYA WAFA',
            'slug' => Str::slug('NURIL ANBIYA WAFA'),
            'nis' => '31-337-041-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281275822032'),
            'phone_hash' => hash('sha256', '6281275822032'),
            'phone_ortu' => encrypt('6281328056266'),
            'phone_ortu_hash' => hash('sha256', '6281328056266'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DHARMA ALIF S',
            'slug' => Str::slug('DHARMA ALIF S'),
            'nis' => '31-337-043-6',
            'sekolah' => 'SMA N1 KEMANGKON',
            'alamat' => null,
            'phone' => encrypt('6281327956500'),
            'phone_hash' => hash('sha256', '6281327956500'),
            'phone_ortu' => encrypt('6285842625487'),
            'phone_ortu_hash' => hash('sha256', '6285842625487'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KAYSHA ZHAFIRA F',
            'slug' => Str::slug('KAYSHA ZHAFIRA F'),
            'nis' => '33-337-027-6',
            'sekolah' => 'SMP N3 MREBET',
            'alamat' => null,
            'phone' => encrypt('6282115500559'),
            'phone_hash' => hash('sha256', '6282115500559'),
            'phone_ortu' => encrypt('6282324404336'),
            'phone_ortu_hash' => hash('sha256', '6282324404336'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RADITYA DZAKI P',
            'slug' => Str::slug('RADITYA DZAKI P'),
            'nis' => '33-337-026-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282237659619'),
            'phone_hash' => hash('sha256', '6282237659619'),
            'phone_ortu' => encrypt('6281391821186'),
            'phone_ortu_hash' => hash('sha256', '6281391821186'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CARISSA ZHITA X',
            'slug' => Str::slug('CARISSA ZHITA X'),
            'nis' => '60-337-009-6',
            'sekolah' => 'SD PIUS PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282220111617'),
            'phone_hash' => hash('sha256', '6282220111617'),
            'phone_ortu' => encrypt('6282220666300'),
            'phone_ortu_hash' => hash('sha256', '6282220666300'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BRYAN KHALFANI H',
            'slug' => Str::slug('BRYAN KHALFANI H'),
            'nis' => '31-337-044-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285227239000'),
            'phone_hash' => hash('sha256', '6285227239000'),
            'phone_ortu' => encrypt('6281227688495'),
            'phone_ortu_hash' => hash('sha256', '6281227688495'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DESRISA AYU SUKARSO',
            'slug' => Str::slug('DESRISA AYU SUKARSO'),
            'nis' => '31-337-045-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628176797037'),
            'phone_hash' => hash('sha256', '628176797037'),
            'phone_ortu' => encrypt('6281882831873'),
            'phone_ortu_hash' => hash('sha256', '6281882831873'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SYIFA NURJANNAH',
            'slug' => Str::slug('SYIFA NURJANNAH'),
            'nis' => '33-337-028-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628176797037'),
            'phone_hash' => hash('sha256', '628176797037'),
            'phone_ortu' => encrypt('6282323184017'),
            'phone_ortu_hash' => hash('sha256', '6282323184017'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ZHAFRAN NASHIK P',
            'slug' => Str::slug('ZHAFRAN NASHIK P'),
            'nis' => '31-337-046-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281327318890'),
            'phone_hash' => hash('sha256', '6281327318890'),
            'phone_ortu' => encrypt('6289512618237'),
            'phone_ortu_hash' => hash('sha256', '6289512618237'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FITRIYAH KUROTUL AINI',
            'slug' => Str::slug('FITRIYAH KUROTUL AINI'),
            'nis' => '23-337-008-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285867114547'),
            'phone_hash' => hash('sha256', '6285867114547'),
            'phone_ortu' => encrypt('62895340386670'),
            'phone_ortu_hash' => hash('sha256', '62895340386670'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FATHA WIJDAN SYANDANA',
            'slug' => Str::slug('FATHA WIJDAN SYANDANA'),
            'nis' => '31-337-047-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628112701784'),
            'phone_hash' => hash('sha256', '628112701784'),
            'phone_ortu' => encrypt('6285871488189'),
            'phone_ortu_hash' => hash('sha256', '6285871488189'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAFIZA DE NEIRA',
            'slug' => Str::slug('NAFIZA DE NEIRA'),
            'nis' => '31-337-048-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285788615497'),
            'phone_hash' => hash('sha256', '6285788615497'),
            'phone_ortu' => encrypt('6285740376625'),
            'phone_ortu_hash' => hash('sha256', '6285740376625'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NADIA AGATHA ROYANI',
            'slug' => Str::slug('NADIA AGATHA ROYANI'),
            'nis' => '32-337-004-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285280780500'),
            'phone_hash' => hash('sha256', '6285280780500'),
            'phone_ortu' => encrypt('6287837215168'),
            'phone_ortu_hash' => hash('sha256', '6287837215168'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SALWA PITRA ANGGRAENI',
            'slug' => Str::slug('SALWA PITRA ANGGRAENI'),
            'nis' => '32-337-005-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285839375488'),
            'phone_hash' => hash('sha256', '6285839375488'),
            'phone_ortu' => encrypt('6285280862230'),
            'phone_ortu_hash' => hash('sha256', '6285280862230'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FINA NAILATUL I',
            'slug' => Str::slug('FINA NAILATUL I'),
            'nis' => '11-337-005-6',
            'sekolah' => 'SMA N 2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281262352132'),
            'phone_hash' => hash('sha256', '6281262352132'),
            'phone_ortu' => encrypt('6283863056249'),
            'phone_ortu_hash' => hash('sha256', '6283863056249'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DAFFA UMAR AL DZAKI',
            'slug' => Str::slug('DAFFA UMAR AL DZAKI'),
            'nis' => '31-337-049-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282328479966'),
            'phone_hash' => hash('sha256', '6282328479966'),
            'phone_ortu' => encrypt('6282328479966'),
            'phone_ortu_hash' => hash('sha256', '6282328479966'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RANIA KHANSA KHAIRUNNISA',
            'slug' => Str::slug('RANIA KHANSA KHAIRUNNISA'),
            'nis' => '31-337-050-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285641547351'),
            'phone_hash' => hash('sha256', '6285641547351'),
            'phone_ortu' => encrypt('6285842609751'),
            'phone_ortu_hash' => hash('sha256', '6285842609751'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ANNARA NASYWA C',
            'slug' => Str::slug('ANNARA NASYWA C'),
            'nis' => '33-337-019-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281234567890'),
            'phone_hash' => hash('sha256', '6281234567890'),
            'phone_ortu' => encrypt('6281542904889'),
            'phone_ortu_hash' => hash('sha256', '6281542904889'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'JIHAN NUZULA F',
            'slug' => Str::slug('JIHAN NUZULA F'),
            'nis' => '33-337-029-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285883095240'),
            'phone_hash' => hash('sha256', '6285883095240'),
            'phone_ortu' => encrypt('628234194167'),
            'phone_ortu_hash' => hash('sha256', '628234194167'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARYA WIRANATA',
            'slug' => Str::slug('ARYA WIRANATA'),
            'nis' => '21-337-021-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('6281225046672'),
            'phone_hash' => hash('sha256', '6281225046672'),
            'phone_ortu' => encrypt('6285239200094'),
            'phone_ortu_hash' => hash('sha256', '6285239200094'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAHARI NOVISA P',
            'slug' => Str::slug('NAHARI NOVISA P'),
            'nis' => '31-337-051-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281392925152'),
            'phone_hash' => hash('sha256', '6281392925152'),
            'phone_ortu' => encrypt('6282242867256'),
            'phone_ortu_hash' => hash('sha256', '6282242867256'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAZHIRA LUTFIYANA SALSABILA',
            'slug' => Str::slug('NAZHIRA LUTFIYANA SALSABILA'),
            'nis' => '11-337-006-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281391231230'),
            'phone_hash' => hash('sha256', '6281391231230'),
            'phone_ortu' => encrypt('6283876124671'),
            'phone_ortu_hash' => hash('sha256', '6283876124671'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SION HAMONANGAN S',
            'slug' => Str::slug('SION HAMONANGAN S'),
            'nis' => '31-337-052-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('6281392493304'),
            'phone_hash' => hash('sha256', '6281392493304'),
            'phone_ortu' => encrypt('6282324844680'),
            'phone_ortu_hash' => hash('sha256', '6282324844680'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SALSABILA NAZIHA P',
            'slug' => Str::slug('SALSABILA NAZIHA P'),
            'nis' => '21-337-022-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282132801796'),
            'phone_hash' => hash('sha256', '6282132801796'),
            'phone_ortu' => encrypt('6289620485702'),
            'phone_ortu_hash' => hash('sha256', '6289620485702'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HASTU WIJI NUGROHO',
            'slug' => Str::slug('HASTU WIJI NUGROHO'),
            'nis' => '31-337-053-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6282221949174'),
            'phone_hash' => hash('sha256', '6282221949174'),
            'phone_ortu' => encrypt('6281339286471'),
            'phone_ortu_hash' => hash('sha256', '6281339286471'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AULIYAUNISA',
            'slug' => Str::slug('AULIYAUNISA'),
            'nis' => '31-337-055-6',
            'sekolah' => 'SMA N1 BUKATEJA',
            'alamat' => null,
            'phone' => encrypt('6281226779548'),
            'phone_hash' => hash('sha256', '6281226779548'),
            'phone_ortu' => encrypt('6282325531117'),
            'phone_ortu_hash' => hash('sha256', '6282325531117'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FAISAL AZHAR ALRAHMA',
            'slug' => Str::slug('FAISAL AZHAR ALRAHMA'),
            'nis' => '31-337-054-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281327036771'),
            'phone_hash' => hash('sha256', '6281327036771'),
            'phone_ortu' => encrypt('6285329176492'),
            'phone_ortu_hash' => hash('sha256', '6285329176492'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CARDINA RIZKI SAHAJA',
            'slug' => Str::slug('CARDINA RIZKI SAHAJA'),
            'nis' => '21-337-023-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('6285826313446'),
            'phone_hash' => hash('sha256', '6285826313446'),
            'phone_ortu' => encrypt('6285600517233'),
            'phone_ortu_hash' => hash('sha256', '6285600517233'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SASQIA KHANSA A',
            'slug' => Str::slug('SASQIA KHANSA A'),
            'nis' => '31-337-056-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285713676670'),
            'phone_hash' => hash('sha256', '6285713676670'),
            'phone_ortu' => encrypt('6285600408828'),
            'phone_ortu_hash' => hash('sha256', '6285600408828'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CALISTA HELGA DWI KIRANI',
            'slug' => Str::slug('CALISTA HELGA DWI KIRANI'),
            'nis' => '31-337-057-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281542667200'),
            'phone_hash' => hash('sha256', '6281542667200'),
            'phone_ortu' => encrypt('6285871034199'),
            'phone_ortu_hash' => hash('sha256', '6285871034199'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NABILA LUTHFIANA',
            'slug' => Str::slug('NABILA LUTHFIANA'),
            'nis' => '31-337-058-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281220719794'),
            'phone_hash' => hash('sha256', '6281220719794'),
            'phone_ortu' => encrypt('6282324404127'),
            'phone_ortu_hash' => hash('sha256', '6282324404127'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KEIRA LARASATI',
            'slug' => Str::slug('KEIRA LARASATI'),
            'nis' => '31-337-059-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285329737222'),
            'phone_hash' => hash('sha256', '6285329737222'),
            'phone_ortu' => encrypt('6281232130056'),
            'phone_ortu_hash' => hash('sha256', '6281232130056'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RAFID ZIKRI K',
            'slug' => Str::slug('RAFID ZIKRI K'),
            'nis' => '33-337-030-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285290280976'),
            'phone_hash' => hash('sha256', '6285290280976'),
            'phone_ortu' => encrypt('6285329918964'),
            'phone_ortu_hash' => hash('sha256', '6285329918964'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KEANU CELIO SUMARSONO',
            'slug' => Str::slug('KEANU CELIO SUMARSONO'),
            'nis' => '21-337-024-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285877158285'),
            'phone_hash' => hash('sha256', '6285877158285'),
            'phone_ortu' => encrypt('6281542367922'),
            'phone_ortu_hash' => hash('sha256', '6281542367922'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'M ALFIAN RIZQIE M',
            'slug' => Str::slug('M ALFIAN RIZQIE M'),
            'nis' => '23-337-009-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281228530016'),
            'phone_hash' => hash('sha256', '6281228530016'),
            'phone_ortu' => encrypt('6282135509722'),
            'phone_ortu_hash' => hash('sha256', '6282135509722'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ABDULLAH IZZAN S',
            'slug' => Str::slug('ABDULLAH IZZAN S'),
            'nis' => '60-337-010-6',
            'sekolah' => 'SD N2 KALIMANAH WETAN',
            'alamat' => null,
            'phone' => encrypt('6285811111218'),
            'phone_hash' => hash('sha256', '6285811111218'),
            'phone_ortu' => encrypt('6285811111218'),
            'phone_ortu_hash' => hash('sha256', '6285811111218'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'VIKTORIA VIORHEA PRIMADONA ZULKARNAIN',
            'slug' => Str::slug('VIKTORIA VIORHEA PRIMADONA ZULKARNAIN'),
            'nis' => '31-337-060-6',
            'sekolah' => 'SMA N1 BUKATEJA',
            'alamat' => null,
            'phone' => encrypt('6285647711155'),
            'phone_hash' => hash('sha256', '6285647711155'),
            'phone_ortu' => encrypt('62895358972002'),
            'phone_ortu_hash' => hash('sha256', '62895358972002'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NADINE ALEXANDRA CHAERUDIN',
            'slug' => Str::slug('NADINE ALEXANDRA CHAERUDIN'),
            'nis' => '23-337-010-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285726424242'),
            'phone_hash' => hash('sha256', '6285726424242'),
            'phone_ortu' => encrypt('6285848364577'),
            'phone_ortu_hash' => hash('sha256', '6285848364577'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KAYLA ANINDYA ARYAN PUTRI',
            'slug' => Str::slug('KAYLA ANINDYA ARYAN PUTRI'),
            'nis' => '32-337-006-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282290987040'),
            'phone_hash' => hash('sha256', '6282290987040'),
            'phone_ortu' => encrypt('6287764693593'),
            'phone_ortu_hash' => hash('sha256', '6287764693593'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AGUSTI RANGGA',
            'slug' => Str::slug('AGUSTI RANGGA'),
            'nis' => '21-337-025-6',
            'sekolah' => 'MAN 1 BANYUMAS',
            'alamat' => null,
            'phone' => encrypt('6285226384980'),
            'phone_hash' => hash('sha256', '6285226384980'),
            'phone_ortu' => encrypt('6282220160660'),
            'phone_ortu_hash' => hash('sha256', '6282220160660'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DAIVA ARKA CARINDRA',
            'slug' => Str::slug('DAIVA ARKA CARINDRA'),
            'nis' => '21-337-026-6',
            'sekolah' => 'SMA N1 PURWOKERTO',
            'alamat' => null,
            'phone' => encrypt('6282242247928'),
            'phone_hash' => hash('sha256', '6282242247928'),
            'phone_ortu' => encrypt('6288985450057'),
            'phone_ortu_hash' => hash('sha256', '6288985450057'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAYAKA IBNU DZAKI',
            'slug' => Str::slug('NAYAKA IBNU DZAKI'),
            'nis' => '33-337-031-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285869311413'),
            'phone_hash' => hash('sha256', '6285869311413'),
            'phone_ortu' => encrypt('6281392614473'),
            'phone_ortu_hash' => hash('sha256', '6281392614473'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'LINGGA OKTAVIAJI PUTRA DWIJA',
            'slug' => Str::slug('LINGGA OKTAVIAJI PUTRA DWIJA'),
            'nis' => '33-337-032-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281327692245'),
            'phone_hash' => hash('sha256', '6281327692245'),
            'phone_ortu' => encrypt('6285135310383'),
            'phone_ortu_hash' => hash('sha256', '6285135310383'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GHANI RASYID NUGROHO',
            'slug' => Str::slug('GHANI RASYID NUGROHO'),
            'nis' => '31-337-061-6',
            'sekolah' => 'SMA N1 KEMANGKON',
            'alamat' => null,
            'phone' => encrypt('6281327558205'),
            'phone_hash' => hash('sha256', '6281327558205'),
            'phone_ortu' => encrypt('6285701933516'),
            'phone_ortu_hash' => hash('sha256', '6285701933516'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALIA ZHAFIRA DZAKIYYATUNNISA',
            'slug' => Str::slug('ALIA ZHAFIRA DZAKIYYATUNNISA'),
            'nis' => '33-337-033-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285227441752'),
            'phone_hash' => hash('sha256', '6285227441752'),
            'phone_ortu' => encrypt('6285799242511'),
            'phone_ortu_hash' => hash('sha256', '6285799242511'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MAHARANI',
            'slug' => Str::slug('MAHARANI'),
            'nis' => '21-337-027-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285727649233'),
            'phone_hash' => hash('sha256', '6285727649233'),
            'phone_ortu' => encrypt('6287730635336'),
            'phone_ortu_hash' => hash('sha256', '6287730635336'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ADEEVA AFSHEEN MYESHA',
            'slug' => Str::slug('ADEEVA AFSHEEN MYESHA'),
            'nis' => '60-337-011-6',
            'sekolah' => 'SD IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281325640010'),
            'phone_hash' => hash('sha256', '6281325640010'),
            'phone_ortu' => encrypt('6281325640010'),
            'phone_ortu_hash' => hash('sha256', '6281325640010'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARYA ALRAZIE FATHUROHMAN',
            'slug' => Str::slug('ARYA ALRAZIE FATHUROHMAN'),
            'nis' => '32-337-007-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282139638442'),
            'phone_hash' => hash('sha256', '6282139638442'),
            'phone_ortu' => encrypt('6285225043885'),
            'phone_ortu_hash' => hash('sha256', '6285225043885'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HANUM AYU PUSPITA',
            'slug' => Str::slug('HANUM AYU PUSPITA'),
            'nis' => '21-337-028-6',
            'sekolah' => 'SMA N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('628895228609'),
            'phone_hash' => hash('sha256', '628895228609'),
            'phone_ortu' => encrypt('6288905495245'),
            'phone_ortu_hash' => hash('sha256', '6288905495245'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NARENDRA RAYA AR RASYID',
            'slug' => Str::slug('NARENDRA RAYA AR RASYID'),
            'nis' => '21-337-029-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281227627743'),
            'phone_hash' => hash('sha256', '6281227627743'),
            'phone_ortu' => encrypt('62895320723577'),
            'phone_ortu_hash' => hash('sha256', '62895320723577'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GHANIYYA AYU MEIRA',
            'slug' => Str::slug('GHANIYYA AYU MEIRA'),
            'nis' => '21-337-00207-6',
            'sekolah' => 'SMA N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6281390450149'),
            'phone_hash' => hash('sha256', '6281390450149'),
            'phone_ortu' => encrypt('6289530121797'),
            'phone_ortu_hash' => hash('sha256', '6289530121797'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => "AURA PUSPA NUR'AINI",
            'slug' => Str::slug("AURA PUSPA NUR'AINI"),
            'nis' => '33-337-034-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285540531990'),
            'phone_hash' => hash('sha256', '6285540531990'),
            'phone_ortu' => encrypt('6282323185325'),
            'phone_ortu_hash' => hash('sha256', '6282323185325'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CARISSA VINA K',
            'slug' => Str::slug('CARISSA VINA K'),
            'nis' => '33-337-035-6',
            'sekolah' => 'SMP N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62896657090161'),
            'phone_hash' => hash('sha256', '62896657090161'),
            'phone_ortu' => encrypt('6281388577182'),
            'phone_ortu_hash' => hash('sha256', '6281388577182'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RADITYA ARI PRADANA',
            'slug' => Str::slug('RADITYA ARI PRADANA'),
            'nis' => '33-337-036-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281943337444'),
            'phone_hash' => hash('sha256', '6281943337444'),
            'phone_ortu' => encrypt('6287730632943'),
            'phone_ortu_hash' => hash('sha256', '6287730632943'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DPC. ATANDITA V B',
            'slug' => Str::slug('DPC. ATANDITA V B'),
            'nis' => '31-337-062-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6281391161118'),
            'phone_hash' => hash('sha256', '6281391161118'),
            'phone_ortu' => encrypt('6281227555499'),
            'phone_ortu_hash' => hash('sha256', '6281227555499'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KHUMAIRA NUR FAUZIA',
            'slug' => Str::slug('KHUMAIRA NUR FAUZIA'),
            'nis' => '31-337-063-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282241094575'),
            'phone_hash' => hash('sha256', '6282241094575'),
            'phone_ortu' => encrypt('6281389017380'),
            'phone_ortu_hash' => hash('sha256', '6281389017380'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SULISTYO WAHYU ABDULLAH',
            'slug' => Str::slug('SULISTYO WAHYU ABDULLAH'),
            'nis' => '33-337-037-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281228349786'),
            'phone_hash' => hash('sha256', '6281228349786'),
            'phone_ortu' => encrypt('62882006637568'),
            'phone_ortu_hash' => hash('sha256', '62882006637568'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ABRAR ZUDHI FAIZAL',
            'slug' => Str::slug('ABRAR ZUDHI FAIZAL'),
            'nis' => '31-337-064-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('6281548919583'),
            'phone_hash' => hash('sha256', '6281548919583'),
            'phone_ortu' => encrypt('6281548200241'),
            'phone_ortu_hash' => hash('sha256', '6281548200241'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ANARGYA NATHAN N',
            'slug' => Str::slug('ANARGYA NATHAN N'),
            'nis' => '11-337-007-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6282221949174'),
            'phone_hash' => hash('sha256', '6282221949174'),
            'phone_ortu' => encrypt('6281339286472'),
            'phone_ortu_hash' => hash('sha256', '6281339286472'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'TIARA SYASTRIANDINI',
            'slug' => Str::slug('TIARA SYASTRIANDINI'),
            'nis' => '31-337-065-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285601822499'),
            'phone_hash' => hash('sha256', '6285601822499'),
            'phone_ortu' => encrypt('6285591627411'),
            'phone_ortu_hash' => hash('sha256', '6285591627411'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BUNGA ANINDYA KUSUMA WARDHANI',
            'slug' => Str::slug('BUNGA ANINDYA KUSUMA WARDHANI'),
            'nis' => '31-337-066-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282227700779'),
            'phone_hash' => hash('sha256', '6282227700779'),
            'phone_ortu' => encrypt('6285226441456'),
            'phone_ortu_hash' => hash('sha256', '6285226441456'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARIFA KHAIRA UMMAH',
            'slug' => Str::slug('ARIFA KHAIRA UMMAH'),
            'nis' => '21-337-030-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628122997879'),
            'phone_hash' => hash('sha256', '628122997879'),
            'phone_ortu' => encrypt('6285775219150'),
            'phone_ortu_hash' => hash('sha256', '6285775219150'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NACITA PANDIA FATHIINAH H',
            'slug' => Str::slug('NACITA PANDIA FATHIINAH H'),
            'nis' => '11-337-008-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62856433964396'),
            'phone_hash' => hash('sha256', '62856433964396'),
            'phone_ortu' => encrypt('6285848173666'),
            'phone_ortu_hash' => hash('sha256', '6285848173666'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ESHAN AGHA DHIAOUDDANISH',
            'slug' => Str::slug('ESHAN AGHA DHIAOUDDANISH'),
            'nis' => '31-337-067-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62816640323'),
            'phone_hash' => hash('sha256', '62816640323'),
            'phone_ortu' => encrypt('6289526845220'),
            'phone_ortu_hash' => hash('sha256', '6289526845220'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FREYA ANIES NASYARROUNAQ',
            'slug' => Str::slug('FREYA ANIES NASYARROUNAQ'),
            'nis' => '31-337-068-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281520366053'),
            'phone_hash' => hash('sha256', '6281520366053'),
            'phone_ortu' => encrypt('6285842604603'),
            'phone_ortu_hash' => hash('sha256', '6285842604603'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AQILA PUTRI W',
            'slug' => Str::slug('AQILA PUTRI W'),
            'nis' => '11-337-009-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('62813270005412'),
            'phone_hash' => hash('sha256', '62813270005412'),
            'phone_ortu' => encrypt('6281326509279'),
            'phone_ortu_hash' => hash('sha256', '6281326509279'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KAMILA HUSNA A',
            'slug' => Str::slug('KAMILA HUSNA A'),
            'nis' => '33-337-038-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281802500771'),
            'phone_hash' => hash('sha256', '6281802500771'),
            'phone_ortu' => encrypt('6281802500771'),
            'phone_ortu_hash' => hash('sha256', '6281802500771'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALLYSSA VIONA N',
            'slug' => Str::slug('ALLYSSA VIONA N'),
            'nis' => '60-337-012-6',
            'sekolah' => 'SD N1 KAJONGAN',
            'alamat' => null,
            'phone' => encrypt('6285747774675'),
            'phone_hash' => hash('sha256', '6285747774675'),
            'phone_ortu' => encrypt('6289527324387'),
            'phone_ortu_hash' => hash('sha256', '6289527324387'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ATIKA ZAHRA RATIFA',
            'slug' => Str::slug('ATIKA ZAHRA RATIFA'),
            'nis' => '23-337-011-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281391442333'),
            'phone_hash' => hash('sha256', '6281391442333'),
            'phone_ortu' => encrypt('6281353496808'),
            'phone_ortu_hash' => hash('sha256', '6281353496808'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FAISHA NUR AZKIYA',
            'slug' => Str::slug('FAISHA NUR AZKIYA'),
            'nis' => '32-337-008-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281542612164'),
            'phone_hash' => hash('sha256', '6281542612164'),
            'phone_ortu' => encrypt('6285641543052'),
            'phone_ortu_hash' => hash('sha256', '6285641543052'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'PRATAMA LANGGENG SAPUTRA',
            'slug' => Str::slug('PRATAMA LANGGENG SAPUTRA'),
            'nis' => '23-337-012-6',
            'sekolah' => 'SMP N1 REMBANG',
            'alamat' => null,
            'phone' => encrypt('6281285548971'),
            'phone_hash' => hash('sha256', '6281285548971'),
            'phone_ortu' => encrypt('6282223151241'),
            'phone_ortu_hash' => hash('sha256', '6282223151241'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAFISHA NUR AZIZA',
            'slug' => Str::slug('NAFISHA NUR AZIZA'),
            'nis' => '23-337-013-6',
            'sekolah' => 'SMP N5 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282266010604'),
            'phone_hash' => hash('sha256', '6282266010604'),
            'phone_ortu' => encrypt('628121789829'),
            'phone_ortu_hash' => hash('sha256', '628121789829'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NITA OLIFIANA',
            'slug' => Str::slug('NITA OLIFIANA'),
            'nis' => '31-337-069-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281326474887'),
            'phone_hash' => hash('sha256', '6281326474887'),
            'phone_ortu' => encrypt('6285727611005'),
            'phone_ortu_hash' => hash('sha256', '6285727611005'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NARENDRA FARHAD',
            'slug' => Str::slug('NARENDRA FARHAD'),
            'nis' => '31-337-070-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282242993183'),
            'phone_hash' => hash('sha256', '6282242993183'),
            'phone_ortu' => encrypt('6285731077954'),
            'phone_ortu_hash' => hash('sha256', '6285731077954'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FINO FAJAR HABIBIE',
            'slug' => Str::slug('FINO FAJAR HABIBIE'),
            'nis' => '33-337-039-6',
            'sekolah' => 'SMP N5 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285743217494'),
            'phone_hash' => hash('sha256', '6285743217494'),
            'phone_ortu' => encrypt('6285878734183'),
            'phone_ortu_hash' => hash('sha256', '6285878734183'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ADELIA RAISSA NABILA',
            'slug' => Str::slug('ADELIA RAISSA NABILA'),
            'nis' => '21-337-031-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285712955824'),
            'phone_hash' => hash('sha256', '6285712955824'),
            'phone_ortu' => encrypt('6285801548460'),
            'phone_ortu_hash' => hash('sha256', '6285801548460'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALISHA GHINA KHAIRUNNISA',
            'slug' => Str::slug('ALISHA GHINA KHAIRUNNISA'),
            'nis' => '31-337-071-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281281696722'),
            'phone_hash' => hash('sha256', '6281281696722'),
            'phone_ortu' => encrypt('6281362899005'),
            'phone_ortu_hash' => hash('sha256', '6281362899005'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD MIRZA PATRIA',
            'slug' => Str::slug('MUHAMMAD MIRZA PATRIA'),
            'nis' => '60-337-013-6',
            'sekolah' => 'MI ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285712955824'),
            'phone_hash' => hash('sha256', '6285712955824'),
            'phone_ortu' => encrypt('6285641884264'),
            'phone_ortu_hash' => hash('sha256', '6285641884264'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GHAISANI SYADZA',
            'slug' => Str::slug('GHAISANI SYADZA'),
            'nis' => '31-337-072-6',
            'sekolah' => 'SMA N1 KUTASARI',
            'alamat' => null,
            'phone' => encrypt('62852918300830'),
            'phone_hash' => hash('sha256', '62852918300830'),
            'phone_ortu' => encrypt('6285842738840'),
            'phone_ortu_hash' => hash('sha256', '6285842738840'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HUSAIN AMMAR IBRAHIM',
            'slug' => Str::slug('HUSAIN AMMAR IBRAHIM'),
            'nis' => '21-337-032-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895385075792'),
            'phone_hash' => hash('sha256', '62895385075792'),
            'phone_ortu' => encrypt('62895397463388'),
            'phone_ortu_hash' => hash('sha256', '62895397463388'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ANUGRAH HAYFA',
            'slug' => Str::slug('ANUGRAH HAYFA'),
            'nis' => '31-337-073-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281327009614'),
            'phone_hash' => hash('sha256', '6281327009614'),
            'phone_ortu' => encrypt('6285867113075'),
            'phone_ortu_hash' => hash('sha256', '6285867113075'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SAIKHAN PRAMADHANI',
            'slug' => Str::slug('SAIKHAN PRAMADHANI'),
            'nis' => '32-337-009-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282134280468'),
            'phone_hash' => hash('sha256', '6282134280468'),
            'phone_ortu' => encrypt('6282134914121'),
            'phone_ortu_hash' => hash('sha256', '6282134914121'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DINDA AMANDA A',
            'slug' => Str::slug('DINDA AMANDA A'),
            'nis' => '21-337-033-6',
            'sekolah' => 'SMA N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6282112260605'),
            'phone_hash' => hash('sha256', '6282112260605'),
            'phone_ortu' => encrypt('6281128512015'),
            'phone_ortu_hash' => hash('sha256', '6281128512015'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KINANTHI ANANTA WIBOWO',
            'slug' => Str::slug('KINANTHI ANANTA WIBOWO'),
            'nis' => '13-337-003-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282322094482'),
            'phone_hash' => hash('sha256', '6282322094482'),
            'phone_ortu' => encrypt('6282322094482'),
            'phone_ortu_hash' => hash('sha256', '6282322094482'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HAFIDH NURRAFI',
            'slug' => Str::slug('HAFIDH NURRAFI'),
            'nis' => '21-337-034-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285328831176'),
            'phone_hash' => hash('sha256', '6285328831176'),
            'phone_ortu' => encrypt('6285875549367'),
            'phone_ortu_hash' => hash('sha256', '6285875549367'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD ABDILAH KHARSIN',
            'slug' => Str::slug('MUHAMMAD ABDILAH KHARSIN'),
            'nis' => '31-337-074-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285742010225'),
            'phone_hash' => hash('sha256', '6285742010225'),
            'phone_ortu' => encrypt('6287816567726'),
            'phone_ortu_hash' => hash('sha256', '6287816567726'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARNELITA QUEENZYA PUTRI',
            'slug' => Str::slug('ARNELITA QUEENZYA PUTRI'),
            'nis' => '33-337-041-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285600006304'),
            'phone_hash' => hash('sha256', '6285600006304'),
            'phone_ortu' => encrypt('6288220080824'),
            'phone_ortu_hash' => hash('sha256', '6288220080824'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARFA ZAKY S',
            'slug' => Str::slug('ARFA ZAKY S'),
            'nis' => '33-337-042-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281393086699'),
            'phone_hash' => hash('sha256', '6281393086699'),
            'phone_ortu' => encrypt('6289508927120'),
            'phone_ortu_hash' => hash('sha256', '6289508927120'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALODIA NAURA S',
            'slug' => Str::slug('ALODIA NAURA S'),
            'nis' => '31-337-075-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282242127744'),
            'phone_hash' => hash('sha256', '6282242127744'),
            'phone_ortu' => encrypt('6289510663803'),
            'phone_ortu_hash' => hash('sha256', '6289510663803'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'JUSTIAN ESA MAHARANI',
            'slug' => Str::slug('JUSTIAN ESA MAHARANI'),
            'nis' => '31-337-076-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895423131450'),
            'phone_hash' => hash('sha256', '62895423131450'),
            'phone_ortu' => encrypt('6281393666900'),
            'phone_ortu_hash' => hash('sha256', '6281393666900'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'QUEENSHA NAYAKA ROBI',
            'slug' => Str::slug('QUEENSHA NAYAKA ROBI'),
            'nis' => '32-337-010-6',
            'sekolah' => 'SMA N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6285643862406'),
            'phone_hash' => hash('sha256', '6285643862406'),
            'phone_ortu' => encrypt('6282220995550'),
            'phone_ortu_hash' => hash('sha256', '6282220995550'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GALANG HUDA ALFARO',
            'slug' => Str::slug('GALANG HUDA ALFARO'),
            'nis' => '60-337-014-6',
            'sekolah' => 'MI ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281235049476'),
            'phone_hash' => hash('sha256', '6281235049476'),
            'phone_ortu' => encrypt('6285227481767'),
            'phone_ortu_hash' => hash('sha256', '6285227481767'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BINTANY GHALIN IZZATI',
            'slug' => Str::slug('BINTANY GHALIN IZZATI'),
            'nis' => '11-337-012-6',
            'sekolah' => 'SMA N1 SOKARAJA',
            'alamat' => null,
            'phone' => encrypt('6289514145057'),
            'phone_hash' => hash('sha256', '6289514145057'),
            'phone_ortu' => encrypt('6281327999990'),
            'phone_ortu_hash' => hash('sha256', '6281327999990'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RIZKA GITA RAMADHANI',
            'slug' => Str::slug('RIZKA GITA RAMADHANI'),
            'nis' => '33-337-043-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281229705454'),
            'phone_hash' => hash('sha256', '6281229705454'),
            'phone_ortu' => encrypt('6281327105068'),
            'phone_ortu_hash' => hash('sha256', '6281327105068'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALINKA FELICIA Z',
            'slug' => Str::slug('ALINKA FELICIA Z'),
            'nis' => '54-337-001-6',
            'sekolah' => 'SD N1 TLAHAB',
            'alamat' => null,
            'phone' => encrypt('6281213034116'),
            'phone_hash' => hash('sha256', '6281213034116'),
            'phone_ortu' => encrypt('6281213034116'),
            'phone_ortu_hash' => hash('sha256', '6281213034116'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KAYLA OKTA AURA CINTA',
            'slug' => Str::slug('KAYLA OKTA AURA CINTA'),
            'nis' => '31-337-077-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285868866374'),
            'phone_hash' => hash('sha256', '6285868866374'),
            'phone_ortu' => encrypt('6285879579794'),
            'phone_ortu_hash' => hash('sha256', '6285879579794'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AISYAH FARAHDINA',
            'slug' => Str::slug('AISYAH FARAHDINA'),
            'nis' => '13-337-004-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281477018910'),
            'phone_hash' => hash('sha256', '6281477018910'),
            'phone_ortu' => encrypt('6281477018910'),
            'phone_ortu_hash' => hash('sha256', '6281477018910'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RADITYA RIZQI',
            'slug' => Str::slug('RADITYA RIZQI'),
            'nis' => '33-337-044-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282322439284'),
            'phone_hash' => hash('sha256', '6282322439284'),
            'phone_ortu' => encrypt('6281327421874'),
            'phone_ortu_hash' => hash('sha256', '6281327421874'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SHAFIYAA MARYAM',
            'slug' => Str::slug('SHAFIYAA MARYAM'),
            'nis' => '54-337-002-6',
            'sekolah' => 'SD N1 PURBALINGGA LOR',
            'alamat' => null,
            'phone' => encrypt('6287734574554'),
            'phone_hash' => hash('sha256', '6287734574554'),
            'phone_ortu' => encrypt('6287734574554'),
            'phone_ortu_hash' => hash('sha256', '6287734574554'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HASNA NINDYA DZIHNI',
            'slug' => Str::slug('HASNA NINDYA DZIHNI'),
            'nis' => '31-337-078-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285641755617'),
            'phone_hash' => hash('sha256', '6285641755617'),
            'phone_ortu' => encrypt('6281211346263'),
            'phone_ortu_hash' => hash('sha256', '6281211346263'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DANISH RAJENDRA PUTRA ARDHNA',
            'slug' => Str::slug('DANISH RAJENDRA PUTRA ARDHNA'),
            'nis' => '54-337-003-6',
            'sekolah' => 'SD PURBA ADHI SUTA',
            'alamat' => null,
            'phone' => encrypt('628112600382'),
            'phone_hash' => hash('sha256', '628112600382'),
            'phone_ortu' => encrypt('628112600382'),
            'phone_ortu_hash' => hash('sha256', '628112600382'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DANISWARA SAKHA',
            'slug' => Str::slug('DANISWARA SAKHA'),
            'nis' => '33-337-045-6',
            'sekolah' => 'SMP N1 KALIMANAH',
            'alamat' => null,
            'phone' => encrypt('6285783837777'),
            'phone_hash' => hash('sha256', '6285783837777'),
            'phone_ortu' => encrypt('6285643381007'),
            'phone_ortu_hash' => hash('sha256', '6285643381007'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ANGGIT SUSENO',
            'slug' => Str::slug('ANGGIT SUSENO'),
            'nis' => '33-337-047-6',
            'sekolah' => 'SMP N2 KEMANGKON',
            'alamat' => null,
            'phone' => encrypt('6282147565032'),
            'phone_hash' => hash('sha256', '6282147565032'),
            'phone_ortu' => encrypt('6281578227591'),
            'phone_ortu_hash' => hash('sha256', '6281578227591'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD ZIDANE A',
            'slug' => Str::slug('MUHAMMAD ZIDANE A'),
            'nis' => '33-337-052-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628884151151'),
            'phone_hash' => hash('sha256', '628884151151'),
            'phone_ortu' => encrypt('6281328005653'),
            'phone_ortu_hash' => hash('sha256', '6281328005653'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NESHA SYIFA W',
            'slug' => Str::slug('NESHA SYIFA W'),
            'nis' => '33-337-040-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6288216539532'),
            'phone_hash' => hash('sha256', '6288216539532'),
            'phone_ortu' => encrypt('6282242350885'),
            'phone_ortu_hash' => hash('sha256', '6282242350885'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NADYA ASANKA',
            'slug' => Str::slug('NADYA ASANKA'),
            'nis' => '31-337-084-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281934148231'),
            'phone_hash' => hash('sha256', '6281934148231'),
            'phone_ortu' => encrypt('6285726866411'),
            'phone_ortu_hash' => hash('sha256', '6285726866411'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HASYA AISY IHYA',
            'slug' => Str::slug('HASYA AISY IHYA'),
            'nis' => '33-337-046-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281359907442'),
            'phone_hash' => hash('sha256', '6281359907442'),
            'phone_ortu' => encrypt('6282265091959'),
            'phone_ortu_hash' => hash('sha256', '6282265091959'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAFISA ZAHRATUSITA',
            'slug' => Str::slug('NAFISA ZAHRATUSITA'),
            'nis' => '31-337-079-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628123581473'),
            'phone_hash' => hash('sha256', '628123581473'),
            'phone_ortu' => encrypt('628123581473'),
            'phone_ortu_hash' => hash('sha256', '628123581473'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KEYLA HITRA K',
            'slug' => Str::slug('KEYLA HITRA K'),
            'nis' => '21-337-035-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281393533188'),
            'phone_hash' => hash('sha256', '6281393533188'),
            'phone_ortu' => encrypt('6281228900917'),
            'phone_ortu_hash' => hash('sha256', '6281228900917'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD GIBRAL GHAISAN Y',
            'slug' => Str::slug('MUHAMMAD GIBRAL GHAISAN Y'),
            'nis' => '60-337-015-6',
            'sekolah' => 'SD IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281239670699'),
            'phone_hash' => hash('sha256', '6281239670699'),
            'phone_ortu' => encrypt('6281239670699'),
            'phone_ortu_hash' => hash('sha256', '6281239670699'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'URUBAN AULIA SAM ARYAWAN',
            'slug' => Str::slug('URUBAN AULIA SAM ARYAWAN'),
            'nis' => '33-337-049-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281325288354'),
            'phone_hash' => hash('sha256', '6281325288354'),
            'phone_ortu' => encrypt('6281215407174'),
            'phone_ortu_hash' => hash('sha256', '6281215407174'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RAKHA DANUJA W J',
            'slug' => Str::slug('RAKHA DANUJA W J'),
            'nis' => '31-337-083-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281327608467'),
            'phone_hash' => hash('sha256', '6281327608467'),
            'phone_ortu' => encrypt('6285227026622'),
            'phone_ortu_hash' => hash('sha256', '6285227026622'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'TEGUH BUDIONO',
            'slug' => Str::slug('TEGUH BUDIONO'),
            'nis' => '33-337-048-6',
            'sekolah' => 'SMP IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282325529201'),
            'phone_hash' => hash('sha256', '6282325529201'),
            'phone_ortu' => encrypt('6281227239872'),
            'phone_ortu_hash' => hash('sha256', '6281227239872'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'TIARA PUSPITA RANI',
            'slug' => Str::slug('TIARA PUSPITA RANI'),
            'nis' => '31-337-080-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287794245593'),
            'phone_hash' => hash('sha256', '6287794245593'),
            'phone_ortu' => encrypt('6283105000288'),
            'phone_ortu_hash' => hash('sha256', '6283105000288'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ABDILLAH HASAN AR ROYYAN',
            'slug' => Str::slug('ABDILLAH HASAN AR ROYYAN'),
            'nis' => '21-337-036-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287731165953'),
            'phone_hash' => hash('sha256', '6287731165953'),
            'phone_ortu' => encrypt('6288221785177'),
            'phone_ortu_hash' => hash('sha256', '6288221785177'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KAISHAN NUNO JANDIN',
            'slug' => Str::slug('KAISHAN NUNO JANDIN'),
            'nis' => '32-337-011-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285742356353'),
            'phone_hash' => hash('sha256', '6285742356353'),
            'phone_ortu' => encrypt('628112602866'),
            'phone_ortu_hash' => hash('sha256', '628112602866'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AYA ATIYYATUL SHAHILDA',
            'slug' => Str::slug('AYA ATIYYATUL SHAHILDA'),
            'nis' => '21-337-037-6',
            'sekolah' => 'SMA N1 KEMANGKON',
            'alamat' => null,
            'phone' => encrypt('6282134323698'),
            'phone_hash' => hash('sha256', '6282134323698'),
            'phone_ortu' => encrypt('6281393025215'),
            'phone_ortu_hash' => hash('sha256', '6281393025215'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALFIAN AFIF',
            'slug' => Str::slug('ALFIAN AFIF'),
            'nis' => '33-337-050-6',
            'sekolah' => 'SMP N1 KALIMANAH',
            'alamat' => null,
            'phone' => encrypt('62895341739690'),
            'phone_hash' => hash('sha256', '62895341739690'),
            'phone_ortu' => encrypt('62895341739690'),
            'phone_ortu_hash' => hash('sha256', '62895341739690'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD RAYYAN MUSTOLIH',
            'slug' => Str::slug('MUHAMMAD RAYYAN MUSTOLIH'),
            'nis' => '31-337-081-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289618663824'),
            'phone_hash' => hash('sha256', '6289618663824'),
            'phone_ortu' => encrypt('6281366122691'),
            'phone_ortu_hash' => hash('sha256', '6281366122691'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KENZIE HANIF MUSYAFA',
            'slug' => Str::slug('KENZIE HANIF MUSYAFA'),
            'nis' => '21-337-038-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281326846698'),
            'phone_hash' => hash('sha256', '6281326846698'),
            'phone_ortu' => encrypt('6281327198881'),
            'phone_ortu_hash' => hash('sha256', '6281327198881'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD YUDHA SATYA WIGUNA (IPS)',
            'slug' => Str::slug('MUHAMMAD YUDHA SATYA WIGUNA (IPS)'),
            'nis' => '21-337-039-6',
            'sekolah' => 'SMA N1 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6282223225304'),
            'phone_hash' => hash('sha256', '6282223225304'),
            'phone_ortu' => encrypt('6282243051118'),
            'phone_ortu_hash' => hash('sha256', '6282243051118'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BRILIAN DWI PUTRI',
            'slug' => Str::slug('BRILIAN DWI PUTRI'),
            'nis' => '31-337-082-6',
            'sekolah' => 'SMA N1 BUKATEJA',
            'alamat' => null,
            'phone' => encrypt('6285168177823'),
            'phone_hash' => hash('sha256', '6285168177823'),
            'phone_ortu' => encrypt('6281391276218'),
            'phone_ortu_hash' => hash('sha256', '6281391276218'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FATHIR NOOR FIRDAUS',
            'slug' => Str::slug('FATHIR NOOR FIRDAUS'),
            'nis' => '11-337-010-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6282322606464'),
            'phone_hash' => hash('sha256', '6282322606464'),
            'phone_ortu' => encrypt('6282313084007'),
            'phone_ortu_hash' => hash('sha256', '6282313084007'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GALYA BIDARIE ALFARIZZA WARDHANI',
            'slug' => Str::slug('GALYA BIDARIE ALFARIZZA WARDHANI'),
            'nis' => '22-337-004-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6281228671012'),
            'phone_hash' => hash('sha256', '6281228671012'),
            'phone_ortu' => encrypt('6282226705070'),
            'phone_ortu_hash' => hash('sha256', '6282226705070'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GLADYS MIKAILA PARAMITHA WARDHANI',
            'slug' => Str::slug('GLADYS MIKAILA PARAMITHA WARDHANI'),
            'nis' => '21-337-040-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6281228671013'),
            'phone_hash' => hash('sha256', '6281228671013'),
            'phone_ortu' => encrypt('6282226705070'),
            'phone_ortu_hash' => hash('sha256', '6282226705070'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SYIFA NUR RAHMAN',
            'slug' => Str::slug('SYIFA NUR RAHMAN'),
            'nis' => '31-337-085-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6283869050130'),
            'phone_hash' => hash('sha256', '6283869050130'),
            'phone_ortu' => encrypt('62858544575171'),
            'phone_ortu_hash' => hash('sha256', '62858544575171'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SHERENA KHANZA A',
            'slug' => Str::slug('SHERENA KHANZA A'),
            'nis' => '13-337-005-6',
            'sekolah' => 'SMP N3 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285640998676'),
            'phone_hash' => hash('sha256', '6285640998676'),
            'phone_ortu' => encrypt('6285200423534'),
            'phone_ortu_hash' => hash('sha256', '6285200423534'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ERON KENZIE TARAKA',
            'slug' => Str::slug('ERON KENZIE TARAKA'),
            'nis' => '11-337-011-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282133116332'),
            'phone_hash' => hash('sha256', '6282133116332'),
            'phone_ortu' => encrypt('6285200423534'),
            'phone_ortu_hash' => hash('sha256', '6285200423534'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ATHAYA ZAHWA AURELLIA',
            'slug' => Str::slug('ATHAYA ZAHWA AURELLIA'),
            'nis' => '33-337-051-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6282234838103'),
            'phone_hash' => hash('sha256', '6282234838103'),
            'phone_ortu' => encrypt('6285226558118'),
            'phone_ortu_hash' => hash('sha256', '6285226558118'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'YESIKA ALICIA R',
            'slug' => Str::slug('YESIKA ALICIA R'),
            'nis' => '54-337-004-6',
            'sekolah' => 'SD N1 PURBALINGGA LOR',
            'alamat' => null,
            'phone' => encrypt('6282322434083'),
            'phone_hash' => hash('sha256', '6282322434083'),
            'phone_ortu' => encrypt('6282198667813'),
            'phone_ortu_hash' => hash('sha256', '6282198667813'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RAIHAN ARKANANTA S',
            'slug' => Str::slug('RAIHAN ARKANANTA S'),
            'nis' => '33-337-053-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281215414580'),
            'phone_hash' => hash('sha256', '6281215414580'),
            'phone_ortu' => encrypt('6285328367689'),
            'phone_ortu_hash' => hash('sha256', '6285328367689'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALZAM BERNADINE',
            'slug' => Str::slug('ALZAM BERNADINE'),
            'nis' => '21-337-041-6',
            'sekolah' => 'SMA N1 REMBANG PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285824495955'),
            'phone_hash' => hash('sha256', '6285824495955'),
            'phone_ortu' => encrypt('6282280724840'),
            'phone_ortu_hash' => hash('sha256', '6282280724840'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ELSA AULIYA P',
            'slug' => Str::slug('ELSA AULIYA P'),
            'nis' => '31-337-086-6',
            'sekolah' => 'SMA N1 KEMANGKON',
            'alamat' => null,
            'phone' => encrypt('62881392600162'),
            'phone_hash' => hash('sha256', '62881392600162'),
            'phone_ortu' => encrypt('62888216198005'),
            'phone_ortu_hash' => hash('sha256', '62888216198005'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RISKA AMANDA S',
            'slug' => Str::slug('RISKA AMANDA S'),
            'nis' => '31-337-088-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6281330571518'),
            'phone_hash' => hash('sha256', '6281330571518'),
            'phone_ortu' => encrypt('6285385938249'),
            'phone_ortu_hash' => hash('sha256', '6285385938249'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AZKIA NUR FADILA',
            'slug' => Str::slug('AZKIA NUR FADILA'),
            'nis' => '33-337-054-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6289506056656'),
            'phone_hash' => hash('sha256', '6289506056656'),
            'phone_ortu' => encrypt('6281226754154'),
            'phone_ortu_hash' => hash('sha256', '6281226754154'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SALSABILA NUR A',
            'slug' => Str::slug('SALSABILA NUR A'),
            'nis' => '31-337-087-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289516851260'),
            'phone_hash' => hash('sha256', '6289516851260'),
            'phone_ortu' => encrypt('6281226754154'),
            'phone_ortu_hash' => hash('sha256', '6281226754154'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALMIRA JAUZA P A',
            'slug' => Str::slug('ALMIRA JAUZA P A'),
            'nis' => '11-337-013-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62888983568884'),
            'phone_hash' => hash('sha256', '62888983568884'),
            'phone_ortu' => encrypt('628883646086543'),
            'phone_ortu_hash' => hash('sha256', '628883646086543'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HAGAN DANUPUTRA M',
            'slug' => Str::slug('HAGAN DANUPUTRA M'),
            'nis' => '33-337-055-6',
            'sekolah' => 'SMP IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281326830863'),
            'phone_hash' => hash('sha256', '6281326830863'),
            'phone_ortu' => encrypt('6281327007484'),
            'phone_ortu_hash' => hash('sha256', '6281327007484'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GADING MOHAN R',
            'slug' => Str::slug('GADING MOHAN R'),
            'nis' => '31-337-090-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895411182981'),
            'phone_hash' => hash('sha256', '62895411182981'),
            'phone_ortu' => encrypt('6289527722395'),
            'phone_ortu_hash' => hash('sha256', '6289527722395'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BINTANG ATHARRAYHAN S',
            'slug' => Str::slug('BINTANG ATHARRAYHAN S'),
            'nis' => '33-337-056-6',
            'sekolah' => 'SMP N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282135775577'),
            'phone_hash' => hash('sha256', '6282135775577'),
            'phone_ortu' => encrypt('6285647757990'),
            'phone_ortu_hash' => hash('sha256', '6285647757990'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HISANAH FADHILLAH',
            'slug' => Str::slug('HISANAH FADHILLAH'),
            'nis' => '32-337-012-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895634535322'),
            'phone_hash' => hash('sha256', '62895634535322'),
            'phone_ortu' => encrypt('62895377120970'),
            'phone_ortu_hash' => hash('sha256', '62895377120970'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DANIEL JORDAN S',
            'slug' => Str::slug('DANIEL JORDAN S'),
            'nis' => '32-337-013-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282324852223'),
            'phone_hash' => hash('sha256', '6282324852223'),
            'phone_ortu' => encrypt('6281328503408'),
            'phone_ortu_hash' => hash('sha256', '6281328503408'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GHENDIES PUTRY A',
            'slug' => Str::slug('GHENDIES PUTRY A'),
            'nis' => '31-337-089-6',
            'sekolah' => 'SMA MUHAMMADIYAH 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282392530833'),
            'phone_hash' => hash('sha256', '6282392530833'),
            'phone_ortu' => encrypt('6287791161360'),
            'phone_ortu_hash' => hash('sha256', '6287791161360'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAFEESHA ANHAER',
            'slug' => Str::slug('NAFEESHA ANHAER'),
            'nis' => '11-337-014-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285228444344'),
            'phone_hash' => hash('sha256', '6285228444344'),
            'phone_ortu' => encrypt('6281380216868'),
            'phone_ortu_hash' => hash('sha256', '6281380216868'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MEDINA RAHMA',
            'slug' => Str::slug('MEDINA RAHMA'),
            'nis' => '11-337-015-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289696234678'),
            'phone_hash' => hash('sha256', '6289696234678'),
            'phone_ortu' => encrypt('6281315474335'),
            'phone_ortu_hash' => hash('sha256', '6281315474335'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DINANDA MAHESWARA ARDHANI',
            'slug' => Str::slug('DINANDA MAHESWARA ARDHANI'),
            'nis' => '33-337-057-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6282235559585'),
            'phone_hash' => hash('sha256', '6282235559585'),
            'phone_ortu' => encrypt('6282235559585'),
            'phone_ortu_hash' => hash('sha256', '6282235559585'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'VALENCIA NAZWA C',
            'slug' => Str::slug('VALENCIA NAZWA C'),
            'nis' => '11-337-016-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289501263210'),
            'phone_hash' => hash('sha256', '6289501263210'),
            'phone_ortu' => encrypt('6285794575757'),
            'phone_ortu_hash' => hash('sha256', '6285794575757'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KEYLA AUDREY M',
            'slug' => Str::slug('KEYLA AUDREY M'),
            'nis' => '21-337-042-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287734795145'),
            'phone_hash' => hash('sha256', '6287734795145'),
            'phone_ortu' => encrypt('6285291319161'),
            'phone_ortu_hash' => hash('sha256', '6285291319161'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'YUDA FATIN ALQODAR',
            'slug' => Str::slug('YUDA FATIN ALQODAR'),
            'nis' => '11-337-017-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('6285728100180'),
            'phone_hash' => hash('sha256', '6285728100180'),
            'phone_ortu' => encrypt('6285640405124'),
            'phone_ortu_hash' => hash('sha256', '6285640405124'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SARAH AZZAHRA',
            'slug' => Str::slug('SARAH AZZAHRA'),
            'nis' => '11-337-018-6',
            'sekolah' => 'SMA N2 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285624434993'),
            'phone_hash' => hash('sha256', '6285624434993'),
            'phone_ortu' => encrypt('6285801526420'),
            'phone_ortu_hash' => hash('sha256', '6285801526420'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RAFIF GHANA AL AQSA',
            'slug' => Str::slug('RAFIF GHANA AL AQSA'),
            'nis' => '60-337-016-6',
            'sekolah' => 'MI ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6282243570471'),
            'phone_hash' => hash('sha256', '6282243570471'),
            'phone_ortu' => encrypt('6282243570471'),
            'phone_ortu_hash' => hash('sha256', '6282243570471'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ECCA NAELA ILMIRA',
            'slug' => Str::slug('ECCA NAELA ILMIRA'),
            'nis' => '32-337-014-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289669751664'),
            'phone_hash' => hash('sha256', '6289669751664'),
            'phone_ortu' => encrypt('6281281724121'),
            'phone_ortu_hash' => hash('sha256', '6281281724121'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUTIA SALMA N',
            'slug' => Str::slug('MUTIA SALMA N'),
            'nis' => '11-337-019-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281325483750'),
            'phone_hash' => hash('sha256', '6281325483750'),
            'phone_ortu' => encrypt('6281327100606'),
            'phone_ortu_hash' => hash('sha256', '6281327100606'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SYAHDA HAUR N',
            'slug' => Str::slug('SYAHDA HAUR N'),
            'nis' => '11-337-020-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281225265599'),
            'phone_hash' => hash('sha256', '6281225265599'),
            'phone_ortu' => encrypt('6285226301338'),
            'phone_ortu_hash' => hash('sha256', '6285226301338'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD ROSYID',
            'slug' => Str::slug('MUHAMMAD ROSYID'),
            'nis' => '11-337-021-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628134638176'),
            'phone_hash' => hash('sha256', '628134638176'),
            'phone_ortu' => encrypt('628135138896'),
            'phone_ortu_hash' => hash('sha256', '628135138896'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'EDININGTYAS HANDAYANI',
            'slug' => Str::slug('EDININGTYAS HANDAYANI'),
            'nis' => '31-337-091-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287827287553'),
            'phone_hash' => hash('sha256', '6287827287553'),
            'phone_ortu' => encrypt('6285747492768'),
            'phone_ortu_hash' => hash('sha256', '6285747492768'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HAZIQAH ATIQA FARAH',
            'slug' => Str::slug('HAZIQAH ATIQA FARAH'),
            'nis' => '11-337-022-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285702263166'),
            'phone_hash' => hash('sha256', '6285702263166'),
            'phone_ortu' => encrypt('628122218715'),
            'phone_ortu_hash' => hash('sha256', '628122218715'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BINTANG PAMUNGKAS',
            'slug' => Str::slug('BINTANG PAMUNGKAS'),
            'nis' => '21-337-043-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285228079015'),
            'phone_hash' => hash('sha256', '6285228079015'),
            'phone_ortu' => encrypt('6281391224400'),
            'phone_ortu_hash' => hash('sha256', '6281391224400'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CALLYSTA NAZURAH IFTIKHAR FAJRINA',
            'slug' => Str::slug('CALLYSTA NAZURAH IFTIKHAR FAJRINA'),
            'nis' => '11-337-024-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285797334015'),
            'phone_hash' => hash('sha256', '6285797334015'),
            'phone_ortu' => encrypt('628564776588'),
            'phone_ortu_hash' => hash('sha256', '628564776588'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ALTAF RAFIDAN',
            'slug' => Str::slug('ALTAF RAFIDAN'),
            'nis' => '11-337-023-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287731996954'),
            'phone_hash' => hash('sha256', '6287731996954'),
            'phone_ortu' => encrypt('6281393902523'),
            'phone_ortu_hash' => hash('sha256', '6281393902523'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'JOYCE GRACELLA W',
            'slug' => Str::slug('JOYCE GRACELLA W'),
            'nis' => '33-337-058-6',
            'sekolah' => 'SMP ST BORROMEUS',
            'alamat' => null,
            'phone' => encrypt('6285198216697'),
            'phone_hash' => hash('sha256', '6285198216697'),
            'phone_ortu' => encrypt('6282329621957'),
            'phone_ortu_hash' => hash('sha256', '6282329621957'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FAIRUZ ZAHRAAN ABDILLAH',
            'slug' => Str::slug('FAIRUZ ZAHRAAN ABDILLAH'),
            'nis' => '11-337-025-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281392163924'),
            'phone_hash' => hash('sha256', '6281392163924'),
            'phone_ortu' => encrypt('6281226688474'),
            'phone_ortu_hash' => hash('sha256', '6281226688474'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DAMARA FATIN Z',
            'slug' => Str::slug('DAMARA FATIN Z'),
            'nis' => '11-337-026-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62858810071687'),
            'phone_hash' => hash('sha256', '62858810071687'),
            'phone_ortu' => encrypt('6285601777686'),
            'phone_ortu_hash' => hash('sha256', '6285601777686'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FAVIAN PUTRA L',
            'slug' => Str::slug('FAVIAN PUTRA L'),
            'nis' => '11-337-029-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282226382149'),
            'phone_hash' => hash('sha256', '6282226382149'),
            'phone_ortu' => encrypt('6282226382149'),
            'phone_ortu_hash' => hash('sha256', '6282226382149'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RAFFA ALDI F',
            'slug' => Str::slug('RAFFA ALDI F'),
            'nis' => '11-337-028-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281225128156'),
            'phone_hash' => hash('sha256', '6281225128156'),
            'phone_ortu' => encrypt('6281548881078'),
            'phone_ortu_hash' => hash('sha256', '6281548881078'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'QANITA KHAIRUNNISA',
            'slug' => Str::slug('QANITA KHAIRUNNISA'),
            'nis' => '11-337-027-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62895321082590'),
            'phone_hash' => hash('sha256', '62895321082590'),
            'phone_ortu' => encrypt('6285647998205'),
            'phone_ortu_hash' => hash('sha256', '6285647998205'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'INAYAH MAHARANI',
            'slug' => Str::slug('INAYAH MAHARANI'),
            'nis' => '31-337-092-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289519676384'),
            'phone_hash' => hash('sha256', '6289519676384'),
            'phone_ortu' => encrypt('6285747492768'),
            'phone_ortu_hash' => hash('sha256', '6285747492768'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMAD RAFLI SETIAWAN',
            'slug' => Str::slug('MUHAMAD RAFLI SETIAWAN'),
            'nis' => '31-337-093-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6287812948563'),
            'phone_hash' => hash('sha256', '6287812948563'),
            'phone_ortu' => encrypt('62812281821119'),
            'phone_ortu_hash' => hash('sha256', '62812281821119'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD MIRZA UKAIL',
            'slug' => Str::slug('MUHAMMAD MIRZA UKAIL'),
            'nis' => '11-337-031-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281215162538'),
            'phone_hash' => hash('sha256', '6281215162538'),
            'phone_ortu' => encrypt('62855227294105'),
            'phone_ortu_hash' => hash('sha256', '62855227294105'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ZULFA ALIFATUL HAZNA',
            'slug' => Str::slug('ZULFA ALIFATUL HAZNA'),
            'nis' => '11-337-032-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628220165366'),
            'phone_hash' => hash('sha256', '628220165366'),
            'phone_ortu' => encrypt('62813284438115'),
            'phone_ortu_hash' => hash('sha256', '62813284438115'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD ABRIZAM',
            'slug' => Str::slug('MUHAMMAD ABRIZAM'),
            'nis' => '54-337-005-6',
            'sekolah' => 'MI ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281215830001'),
            'phone_hash' => hash('sha256', '6281215830001'),
            'phone_ortu' => encrypt('6281215830001'),
            'phone_ortu_hash' => hash('sha256', '6281215830001'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KHALIDA ZALFA AFITADEWI',
            'slug' => Str::slug('KHALIDA ZALFA AFITADEWI'),
            'nis' => '22-337-005-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285937092570'),
            'phone_hash' => hash('sha256', '6285937092570'),
            'phone_ortu' => encrypt('6285291159194'),
            'phone_ortu_hash' => hash('sha256', '6285291159194'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'RAFI APRILIO S',
            'slug' => Str::slug('RAFI APRILIO S'),
            'nis' => '31-337-094-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281215761549'),
            'phone_hash' => hash('sha256', '6281215761549'),
            'phone_ortu' => encrypt('6281288881255'),
            'phone_ortu_hash' => hash('sha256', '6281288881255'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMAD HABIB KURNIAWAN',
            'slug' => Str::slug('MUHAMAD HABIB KURNIAWAN'),
            'nis' => '31-337-095-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281328020448'),
            'phone_hash' => hash('sha256', '6281328020448'),
            'phone_ortu' => encrypt('6282220171607'),
            'phone_ortu_hash' => hash('sha256', '6282220171607'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ERINA RAHAYU',
            'slug' => Str::slug('ERINA RAHAYU'),
            'nis' => '31-337-097-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282225572224'),
            'phone_hash' => hash('sha256', '6282225572224'),
            'phone_ortu' => encrypt('6283876342980'),
            'phone_ortu_hash' => hash('sha256', '6283876342980'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KHAYLILA SEKAR',
            'slug' => Str::slug('KHAYLILA SEKAR'),
            'nis' => '11-337-030-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282136289993'),
            'phone_hash' => hash('sha256', '6282136289993'),
            'phone_ortu' => encrypt('6281327046996'),
            'phone_ortu_hash' => hash('sha256', '6281327046996'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DEWI ARISTA P',
            'slug' => Str::slug('DEWI ARISTA P'),
            'nis' => '11-337-033-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282225303345'),
            'phone_hash' => hash('sha256', '6282225303345'),
            'phone_ortu' => encrypt('6281327771088'),
            'phone_ortu_hash' => hash('sha256', '6281327771088'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'LAVIDA AIRA ELFARETTA',
            'slug' => Str::slug('LAVIDA AIRA ELFARETTA'),
            'nis' => '11-337-034-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6288238978113'),
            'phone_hash' => hash('sha256', '6288238978113'),
            'phone_ortu' => encrypt('628591032444'),
            'phone_ortu_hash' => hash('sha256', '628591032444'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD AZAM N S',
            'slug' => Str::slug('MUHAMMAD AZAM N S'),
            'nis' => '21-337-044-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285141000289'),
            'phone_hash' => hash('sha256', '6285141000289'),
            'phone_ortu' => encrypt('6281391288834'),
            'phone_ortu_hash' => hash('sha256', '6281391288834'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HASNA AUDITA A',
            'slug' => Str::slug('HASNA AUDITA A'),
            'nis' => '31-337-096-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6289698618700'),
            'phone_hash' => hash('sha256', '6289698618700'),
            'phone_ortu' => encrypt('6289528522495'),
            'phone_ortu_hash' => hash('sha256', '6289528522495'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MISCHA HAFSHA TUFFAHATI',
            'slug' => Str::slug('MISCHA HAFSHA TUFFAHATI'),
            'nis' => '33-337-059-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285869019726'),
            'phone_hash' => hash('sha256', '6285869019726'),
            'phone_ortu' => encrypt('6281903002334'),
            'phone_ortu_hash' => hash('sha256', '6281903002334'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAZHIF AULIA HAFID',
            'slug' => Str::slug('NAZHIF AULIA HAFID'),
            'nis' => '11-337-035-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62882005081137'),
            'phone_hash' => hash('sha256', '62882005081137'),
            'phone_ortu' => encrypt('6285227371664'),
            'phone_ortu_hash' => hash('sha256', '6285227371664'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAUFAL ZAFRAN AL ALAM',
            'slug' => Str::slug('NAUFAL ZAFRAN AL ALAM'),
            'nis' => '11-337-036-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('628132672320'),
            'phone_hash' => hash('sha256', '628132672320'),
            'phone_ortu' => encrypt('6285329983812'),
            'phone_ortu_hash' => hash('sha256', '6285329983812'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ARDANA YUDHA P',
            'slug' => Str::slug('ARDANA YUDHA P'),
            'nis' => '33-337-060-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285731433611'),
            'phone_hash' => hash('sha256', '6285731433611'),
            'phone_ortu' => encrypt('6281327102038'),
            'phone_ortu_hash' => hash('sha256', '6281327102038'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'LAKSITA RAHMA U',
            'slug' => Str::slug('LAKSITA RAHMA U'),
            'nis' => '11-337-039-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282325520525'),
            'phone_hash' => hash('sha256', '6282325520525'),
            'phone_ortu' => encrypt('6282133230947'),
            'phone_ortu_hash' => hash('sha256', '6282133230947'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD IQBAL AL FATIH',
            'slug' => Str::slug('MUHAMMAD IQBAL AL FATIH'),
            'nis' => '11-337-037-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281229874821'),
            'phone_hash' => hash('sha256', '6281229874821'),
            'phone_ortu' => encrypt('628122668877'),
            'phone_ortu_hash' => hash('sha256', '628122668877'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'DANIS FAEYZA H A',
            'slug' => Str::slug('DANIS FAEYZA H A'),
            'nis' => '11-337-038-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282141079194'),
            'phone_hash' => hash('sha256', '6282141079194'),
            'phone_ortu' => encrypt('6282326060016'),
            'phone_ortu_hash' => hash('sha256', '6282326060016'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CATUR SURYADINATA',
            'slug' => Str::slug('CATUR SURYADINATA'),
            'nis' => '31-337-098-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6289527309107'),
            'phone_hash' => hash('sha256', '6289527309107'),
            'phone_ortu' => encrypt('6282136185533'),
            'phone_ortu_hash' => hash('sha256', '6282136185533'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ZAHRA AMIRA R',
            'slug' => Str::slug('ZAHRA AMIRA R'),
            'nis' => '60-337-017-6',
            'sekolah' => 'SD N1 BOJONGSARI',
            'alamat' => null,
            'phone' => encrypt('6289541655505'),
            'phone_hash' => hash('sha256', '6289541655505'),
            'phone_ortu' => encrypt('6285723847954'),
            'phone_ortu_hash' => hash('sha256', '6285723847954'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AFKAR RASENDRIYA',
            'slug' => Str::slug('AFKAR RASENDRIYA'),
            'nis' => '33-337-061-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281918652572'),
            'phone_hash' => hash('sha256', '6281918652572'),
            'phone_ortu' => encrypt('6285227925021'),
            'phone_ortu_hash' => hash('sha256', '6285227925021'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MUHAMMAD AKMAL H',
            'slug' => Str::slug('MUHAMMAD AKMAL H'),
            'nis' => '32-337-015-6',
            'sekolah' => 'SMA N1 PADAMARA',
            'alamat' => null,
            'phone' => encrypt('6281326535276'),
            'phone_hash' => hash('sha256', '6281326535276'),
            'phone_ortu' => encrypt('6281328154916'),
            'phone_ortu_hash' => hash('sha256', '6281328154916'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'GHAIDA FADHISYAA AZ ZHAFIRA',
            'slug' => Str::slug('GHAIDA FADHISYAA AZ ZHAFIRA'),
            'nis' => '60-337-018-6',
            'sekolah' => 'MI ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6282324526650'),
            'phone_hash' => hash('sha256', '6282324526650'),
            'phone_ortu' => encrypt('6281329544141'),
            'phone_ortu_hash' => hash('sha256', '6281329544141'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NIZHAMUL NAILUN NABHAN',
            'slug' => Str::slug('NIZHAMUL NAILUN NABHAN'),
            'nis' => '11-337-042-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282221873104'),
            'phone_hash' => hash('sha256', '6282221873104'),
            'phone_ortu' => encrypt('628533903402'),
            'phone_ortu_hash' => hash('sha256', '628533903402'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FILZAH AULIA IZZATUNNISA',
            'slug' => Str::slug('FILZAH AULIA IZZATUNNISA'),
            'nis' => '13-337-006-6',
            'sekolah' => 'SMP N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6282341991516'),
            'phone_hash' => hash('sha256', '6282341991516'),
            'phone_ortu' => encrypt('62895341918139'),
            'phone_ortu_hash' => hash('sha256', '62895341918139'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'HUMAIRA MARRU KIROMA',
            'slug' => Str::slug('HUMAIRA MARRU KIROMA'),
            'nis' => '21-337-045-6',
            'sekolah' => 'MATIQ ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('628139148445'),
            'phone_hash' => hash('sha256', '628139148445'),
            'phone_ortu' => encrypt('628529955587'),
            'phone_ortu_hash' => hash('sha256', '628529955587'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'IHDA SAID MUNAWAR',
            'slug' => Str::slug('IHDA SAID MUNAWAR'),
            'nis' => '33-337-062-6',
            'sekolah' => 'MTSN 3 BANYUMAS',
            'alamat' => null,
            'phone' => encrypt('6285292806355'),
            'phone_hash' => hash('sha256', '6285292806355'),
            'phone_ortu' => encrypt('6281226699885'),
            'phone_ortu_hash' => hash('sha256', '6281226699885'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BAGUS WILUJENG K',
            'slug' => Str::slug('BAGUS WILUJENG K'),
            'nis' => '31-337-099-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6282136092691'),
            'phone_hash' => hash('sha256', '6282136092691'),
            'phone_ortu' => encrypt('6282136277227'),
            'phone_ortu_hash' => hash('sha256', '6282136277227'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'TAZKIA AZKA P',
            'slug' => Str::slug('TAZKIA AZKA P'),
            'nis' => '11-337-043-6',
            'sekolah' => 'SMA N1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285157300746'),
            'phone_hash' => hash('sha256', '6285157300746'),
            'phone_ortu' => encrypt('6281220168800'),
            'phone_ortu_hash' => hash('sha256', '6281220168800'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'JIHAN NUR AFIFAH',
            'slug' => Str::slug('JIHAN NUR AFIFAH'),
            'nis' => '33-337-063-6',
            'sekolah' => 'SMP ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6285236749911'),
            'phone_hash' => hash('sha256', '6285236749911'),
            'phone_ortu' => encrypt('628214386574'),
            'phone_ortu_hash' => hash('sha256', '628214386574'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KANAYA MAJDA S',
            'slug' => Str::slug('KANAYA MAJDA S'),
            'nis' => '60-337-019-6',
            'sekolah' => 'MI ISTIQOMAH SAMBAS',
            'alamat' => null,
            'phone' => encrypt('6281227244570'),
            'phone_hash' => hash('sha256', '6281227244570'),
            'phone_ortu' => encrypt('6281227244570'),
            'phone_ortu_hash' => hash('sha256', '6281227244570'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'BACHRI ANANDA BUDITANOTO',
            'slug' => Str::slug('BACHRI ANANDA BUDITANOTO'),
            'nis' => '11-337-040-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285189009530'),
            'phone_hash' => hash('sha256', '6285189009530'),
            'phone_ortu' => encrypt('6282221191384'),
            'phone_ortu_hash' => hash('sha256', '6282221191384'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KD FAISHAL T A',
            'slug' => Str::slug('KD FAISHAL T A'),
            'nis' => '22-337-006-6',
            'sekolah' => 'SMA AL-IRSYAD PURWOKERTO',
            'alamat' => null,
            'phone' => encrypt('6281391690556'),
            'phone_hash' => hash('sha256', '6281391690556'),
            'phone_ortu' => encrypt('6281391690556'),
            'phone_ortu_hash' => hash('sha256', '6281391690556'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'PRABOWO SOEGIARTO',
            'slug' => Str::slug('PRABOWO SOEGIARTO'),
            'nis' => '33-337-064-6',
            'sekolah' => 'SMP N 2 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6282170004117'),
            'phone_hash' => hash('sha256', '6282170004117'),
            'phone_ortu' => encrypt('6281310393417'),
            'phone_ortu_hash' => hash('sha256', '6281310393417'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'APIT OKA NURROKHMAN',
            'slug' => Str::slug('APIT OKA NURROKHMAN'),
            'nis' => '32-337-016-6',
            'sekolah' => 'SMAS MUHAMMADIYAH 2 BOBOTSARI',
            'alamat' => null,
            'phone' => encrypt('6285143675477'),
            'phone_hash' => hash('sha256', '6285143675477'),
            'phone_ortu' => encrypt('6281310393417'),
            'phone_ortu_hash' => hash('sha256', '6281310393417'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'CLARIESHA DARA NUR A',
            'slug' => Str::slug('CLARIESHA DARA NUR A'),
            'nis' => '31-337-100-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285600639971'),
            'phone_hash' => hash('sha256', '6285600639971'),
            'phone_ortu' => encrypt('6282227008117'),
            'phone_ortu_hash' => hash('sha256', '6282227008117'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'JEREMIA MARTIAR',
            'slug' => Str::slug('JEREMIA MARTIAR'),
            'nis' => '11-337-041-6',
            'sekolah' => 'SMA BRUDERAN PURWOKERTO',
            'alamat' => null,
            'phone' => encrypt('62895322352404'),
            'phone_hash' => hash('sha256', '62895322352404'),
            'phone_ortu' => encrypt('6285286402802'),
            'phone_ortu_hash' => hash('sha256', '6285286402802'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'SAFARAZ AKMA F',
            'slug' => Str::slug('SAFARAZ AKMA F'),
            'nis' => '60-337-020-6',
            'sekolah' => 'SD N1 PURBALINGGA WETAN',
            'alamat' => null,
            'phone' => encrypt('6285659379388'),
            'phone_hash' => hash('sha256', '6285659379388'),
            'phone_ortu' => encrypt('6282133214428'),
            'phone_ortu_hash' => hash('sha256', '6282133214428'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'NAILA KHAERUN NISSA',
            'slug' => Str::slug('NAILA KHAERUN NISSA'),
            'nis' => '31-337-101-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6281392629447'),
            'phone_hash' => hash('sha256', '6281392629447'),
            'phone_ortu' => encrypt('6282134452436'),
            'phone_ortu_hash' => hash('sha256', '6282134452436'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AYMAR RADINKA ALPRIDO',
            'slug' => Str::slug('AYMAR RADINKA ALPRIDO'),
            'nis' => '60-337-021-6',
            'sekolah' => 'SD IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('62816266938'),
            'phone_hash' => hash('sha256', '62816266938'),
            'phone_ortu' => encrypt('62816266938'),
            'phone_ortu_hash' => hash('sha256', '62816266938'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AQEELLA BAIDURI',
            'slug' => Str::slug('AQEELLA BAIDURI'),
            'nis' => '31-337-102-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6285100770079'),
            'phone_hash' => hash('sha256', '6285100770079'),
            'phone_ortu' => encrypt('6285136988430'),
            'phone_ortu_hash' => hash('sha256', '6285136988430'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'AWALIAH SARIFA R',
            'slug' => Str::slug('AWALIAH SARIFA R'),
            'nis' => '31-337-103-6',
            'sekolah' => 'SMA N1 REMBANG PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285640884264'),
            'phone_hash' => hash('sha256', '6285640884264'),
            'phone_ortu' => encrypt('6285715362657'),
            'phone_ortu_hash' => hash('sha256', '6285715362657'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FAIZAL RAHMAN L',
            'slug' => Str::slug('FAIZAL RAHMAN L'),
            'nis' => '11-337-045-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285213284302'),
            'phone_hash' => hash('sha256', '6285213284302'),
            'phone_ortu' => encrypt('6282137919884'),
            'phone_ortu_hash' => hash('sha256', '6282137919884'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'KHARISMA ALFIANA NUR ISNAINI',
            'slug' => Str::slug('KHARISMA ALFIANA NUR ISNAINI'),
            'nis' => '21-337-046-6',
            'sekolah' => 'SMA N1 PURWAREJA KLAMPOK',
            'alamat' => null,
            'phone' => encrypt('6287783992634'),
            'phone_hash' => hash('sha256', '6287783992634'),
            'phone_ortu' => encrypt('6285641176884'),
            'phone_ortu_hash' => hash('sha256', '6285641176884'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'MOZA PUTRI KHADI PRATAMA',
            'slug' => Str::slug('MOZA PUTRI KHADI PRATAMA'),
            'nis' => '31-337-104-6',
            'sekolah' => 'MAN 1 PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6285601736286'),
            'phone_hash' => hash('sha256', '6285601736286'),
            'phone_ortu' => encrypt('6285227606823'),
            'phone_ortu_hash' => hash('sha256', '6285227606823'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'FIONA ARTHA WARDHANI',
            'slug' => Str::slug('FIONA ARTHA WARDHANI'),
            'nis' => '60-337-022-6',
            'sekolah' => 'SD NEGERI 1 GANDASULI',
            'alamat' => null,
            'phone' => encrypt('6285728109920'),
            'phone_hash' => hash('sha256', '6285728109920'),
            'phone_ortu' => encrypt('6285641107578'),
            'phone_ortu_hash' => hash('sha256', '6285641107578'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'M RASYA ATHAYA',
            'slug' => Str::slug('M RASYA ATHAYA'),
            'nis' => '33-337-065-6',
            'sekolah' => 'SMP TELKOM PURWOKERTO',
            'alamat' => null,
            'phone' => encrypt('6281327839185'),
            'phone_hash' => hash('sha256', '6281327839185'),
            'phone_ortu' => encrypt('6282136783473'),
            'phone_ortu_hash' => hash('sha256', '6282136783473'),
            'status' => true,
            'lulus' => false,
        ]);

        Siswa::create([
            'nama' => 'ADLAN RIZKI SAPUTRA',
            'slug' => Str::slug('ADLAN RIZKI SAPUTRA'),
            'nis' => '60-337-023-6',
            'sekolah' => 'SD IT HARAPAN UMMAT PURBALINGGA',
            'alamat' => null,
            'phone' => encrypt('6281225571009'),
            'phone_hash' => hash('sha256', '6281225571009'),
            'phone_ortu' => encrypt('6281225571009'),
            'phone_ortu_hash' => hash('sha256', '6281225571009'),
            'status' => true,
            'lulus' => false,
        ]);
    }
}

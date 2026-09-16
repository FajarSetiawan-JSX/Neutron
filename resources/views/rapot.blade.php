```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rapor</title>
</head>

<body style="font-family: Helvetica, Arial, sans-serif; font-size: 10px; color: #1f2937; margin: 0; padding: 0;">

    <div style="width: 100%; padding: 18px 24px;">

        {{-- ===== KOP SURAT ===== --}}
        <table style="width: 100%; border-collapse: collapse; border-bottom: 3px double #1e3a8a; margin-bottom: 10px;">
            <tr>

                {{-- LOGO --}}
                <td style="width: 80px; text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('assets/neutron.png') }}" alt="Logo Neutron"
                        style="width: 60px; height: 60px;">
                </td>

                {{-- NAMA --}}
                <td style="text-align: center; vertical-align: middle;">

                    <div style="font-size: 20px; font-weight: bold; color: #ef4444; line-height: 1;">
                        NEUTRON
                    </div>

                    <div style="font-size: 11px; font-weight: bold; color: #374151; margin-top: 3px;">
                        PURBALINGGA
                    </div>

                    <div style="font-size: 8px; margin-top: 5px;">
                        Jl. Piere Tendean No.18, Purbalingga, Purbalingga Lor,
                        Kec. Purbalingga, Kabupaten Purbalingga,
                        Jawa Tengah 53311
                    </div>

                    <div style="font-size: 8px; margin-top: 2px;">
                        Telp 0857-2894-0755
                    </div>

                </td>

                <td style="width: 80px;"></td>

            </tr>
        </table>


        {{-- ===== JUDUL DOKUMEN ===== --}}
        <div style="text-align: center; margin: 10px 0 12px 0;">

            <div style="font-size: 13px; font-weight: bold; text-decoration: underline;">
                LAPORAN HASIL BELAJAR PESERTA DIDIK
            </div>

            <div style="font-size: 10px; margin-top: 3px;">
                {{ now()->locale('id')->translatedFormat('F Y') }} &ndash; TAHUN AJARAN {{ $tahun['tahun'] }}
            </div>

        </div>


        {{-- ===== IDENTITAS SISWA ===== --}}
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 12px; font-size: 9.5px;">

            <tr>
                <td style="width: 18%; padding: 2px 4px;">Nama Peserta Didik</td>
                <td style="width: 2%; padding: 2px 4px;">:</td>
                <td style="width: 30%; padding: 2px 4px; font-weight: bold;">
                    {{ $siswa['nama'] }}
                </td>

                <td style="width: 16%; padding: 2px 4px;">Sekolah</td>
                <td style="width: 2%; padding: 2px 4px;">:</td>
                <td style="width: 32%; padding: 2px 4px; font-weight: bold;">
                    {{ $siswa['sekolah'] }}
                </td>
            </tr>

            <tr>
                <td style="padding: 2px 4px;">NIS</td>
                <td style="padding: 2px 4px;">:</td>
                <td style="padding: 2px 4px; font-weight: bold;">
                    {{ $siswa['nis'] }}
                </td>

                <td style="padding: 2px 4px;">Tahun Ajaran</td>
                <td style="padding: 2px 4px;">:</td>
                <td style="padding: 2px 4px; font-weight: bold;">
                    {{ $tahun['tahun'] }}
                </td>
            </tr>

            <tr>
                <td style="padding: 2px 4px;">Kelas</td>
                <td style="padding: 2px 4px;">:</td>
                <td style="padding: 2px 4px; font-weight: bold;">
                    {{ $siswa['kelas'] }}
                </td>
            </tr>

        </table>


        {{-- ===== TABEL NILAI ===== --}}
        <table style="width: 100%; border-collapse: collapse; font-size: 9px; margin-bottom: 10px;">

            <thead>
                <tr>

                    <th
                        style="border: 1px solid #1e3a8a; padding: 5px;
                        background-color: #1e3a8a; color: #ffffff;
                        text-align: center; width: 4%;">
                        No
                    </th>

                    <th
                        style="border: 1px solid #1e3a8a; padding: 5px;
                        background-color: #1e3a8a; color: #ffffff;
                        text-align: center; width: 19%;">
                        Mata Pelajaran
                    </th>

                    <th
                        style="border: 1px solid #1e3a8a; padding: 5px;
                        background-color: #1e3a8a; color: #ffffff;
                        text-align: center; width: 10%;">
                        Rata-rata<br>Global
                    </th>

                    <th
                        style="border: 1px solid #1e3a8a; padding: 5px;
                        background-color: #1e3a8a; color: #ffffff;
                        text-align: center; width: 10%;">
                        Rata-rata
                    </th>

                    <th
                        style="border: 1px solid #1e3a8a; padding: 5px;
                        background-color: #1e3a8a; color: #ffffff;
                        text-align: center; width: 9%;">
                        Jenis
                    </th>

                    <th
                        style="border: 1px solid #1e3a8a; padding: 5px;
                        background-color: #1e3a8a; color: #ffffff;
                        text-align: center; width: 8%;">
                        Nilai
                    </th>

                    <th
                        style="border: 1px solid #1e3a8a; padding: 5px;
                        background-color: #1e3a8a; color: #ffffff;
                        text-align: center; width: 40%;">
                        Catatan
                    </th>

                </tr>
            </thead>


            <tbody>
                @foreach ($nilais as $index => $item)
                    @php
                        $jumlahNilai = count($item['nilai']);
                    @endphp

                    @foreach ($item['nilai'] as $nilaiIndex => $nilai)
                        <tr>

                            @if ($nilaiIndex === 0)
                                <td rowspan="{{ $jumlahNilai }}"
                                    style="border: 1px solid #1e3a8a;
                                    padding: 5px;
                                    text-align: center;
                                    vertical-align: middle;">
                                    {{ $index + 1 }}
                                </td>

                                <td rowspan="{{ $jumlahNilai }}"
                                    style="border: 1px solid #1e3a8a;
                                    padding: 5px;
                                    font-weight: bold;
                                    vertical-align: middle;">
                                    {{ $item['mapel'] }}
                                </td>

                                <td rowspan="{{ $jumlahNilai }}"
                                    style="border: 1px solid #1e3a8a;
                                    padding: 5px;
                                    text-align: center;
                                    vertical-align: middle;">
                                    {{ $item['global'] !== null ? round($item['global'], 2) : '-' }}
                                </td>

                                <td rowspan="{{ $jumlahNilai }}"
                                    style="border: 1px solid #1e3a8a;
                                    padding: 5px;
                                    text-align: center;
                                    font-weight: bold;
                                    vertical-align: middle;">
                                    {{ $item['avg'] !== null ? round($item['avg'], 2) : '-' }}
                                </td>
                            @endif

                            <td
                                style="border: 1px solid #1e3a8a;
                                padding: 5px;
                                text-align: center;
                                font-weight: bold;">
                                {{ $nilai['tipe'] }}
                            </td>

                            <td
                                style="border: 1px solid #1e3a8a;
                                padding: 5px;
                                text-align: center;
                                font-weight: bold;">
                                {{ $nilai['nilai'] }}
                            </td>

                            <td style="border: 1px solid #1e3a8a;
                                padding: 5px;">
                                {{ $nilai['catatan'] ?? '' }}
                            </td>

                        </tr>
                    @endforeach
                @endforeach


                {{-- ================= TOTAL ================= --}}

                @php

                    // Ambil semua global yang memiliki nilai
                    $globals = collect($nilais)->pluck('global')->filter(fn($value) => $value !== null);

                    // Ambil semua rata-rata siswa yang memiliki nilai
                    $avgs = collect($nilais)->pluck('avg')->filter(fn($value) => $value !== null);

                    // Rata-rata global seluruh mapel
                    $globalAkhir = $globals->count() ? $globals->avg() : null;

                    // Rata-rata siswa seluruh mapel
                    $rataAkhir = $avgs->count() ? $avgs->avg() : null;

                    // Predikat berdasarkan rata-rata akhir siswa
                    if ($rataAkhir === null) {
                        $predikat = '-';
                    } elseif ($rataAkhir >= 85) {
                        $predikat = 'A (Sangat Baik)';
                    } elseif ($rataAkhir >= 70) {
                        $predikat = 'B (Baik)';
                    } elseif ($rataAkhir >= 50) {
                        $predikat = 'C (Cukup)';
                    } else {
                        $predikat = 'D (Perlu Perbaikan)';
                    }

                @endphp


                <tr>

                    {{-- LABEL --}}
                    <td colspan="2"
                        style="border: 1px solid #1e3a8a;
                        padding: 5px;
                        background-color: #eef2ff;
                        font-weight: bold;
                        text-align: center;">
                        JUMLAH NILAI &amp; RATA-RATA AKHIR
                    </td>


                    {{-- GLOBAL --}}
                    <td
                        style="border: 1px solid #1e3a8a;
                        padding: 5px;
                        background-color: #eef2ff;
                        text-align: center;
                        font-weight: bold;">

                        {{ $globalAkhir !== null ? round($globalAkhir, 2) : '-' }}

                    </td>


                    {{-- RATA-RATA --}}
                    <td
                        style="border: 1px solid #1e3a8a;
                        padding: 5px;
                        background-color: #eef2ff;
                        text-align: center;
                        font-weight: bold;">

                        {{ $rataAkhir !== null ? round($rataAkhir, 2) : '-' }}

                    </td>


                    {{-- PREDIKAT --}}
                    <td colspan="3"
                        style="border: 1px solid #1e3a8a;
                        padding: 5px;
                        background-color: #eef2ff;
                        text-align: center;
                        font-weight: bold;">

                        Predikat Umum:

                        <span
                            style="background-color: #dc2626;
                            color: #ffffff;
                            padding: 2px 5px;
                            border-radius: 3px;
                            margin-left: 4px;">

                            {{ $predikat }}

                        </span>

                    </td>

                </tr>

            </tbody>

        </table>


        {{-- ===== PRESENSI ===== --}}
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 15px;">

            <tr>

                <td style="width: 65%; vertical-align: top;">

                    <p style="font-size: 9.5px; font-weight: bold; margin: 0 0 3px 0;">
                        Rekap Kehadiran
                    </p>

                    <table style="width: 100%; border-collapse: collapse; font-size: 8.5px;">

                        <thead>
                            <tr>

                                <th
                                    style="border: 1px solid #1e3a8a;
                                    padding: 3px 4px;
                                    background-color: #1e3a8a;
                                    color: #ffffff;
                                    text-align: center;
                                    width: 7%;">
                                    No
                                </th>

                                <th
                                    style="border: 1px solid #1e3a8a;
                                    padding: 3px 4px;
                                    background-color: #1e3a8a;
                                    color: #ffffff;
                                    text-align: center;">
                                    Mata Pelajaran
                                </th>

                                <th
                                    style="border: 1px solid #1e3a8a;
                                    padding: 3px 4px;
                                    background-color: #1e3a8a;
                                    color: #ffffff;
                                    text-align: center;
                                    width: 14%;">
                                    Jumlah
                                </th>

                                <th
                                    style="border: 1px solid #1e3a8a;
                                    padding: 3px 4px;
                                    background-color: #1e3a8a;
                                    color: #ffffff;
                                    text-align: center;
                                    width: 14%;">
                                    Hadir
                                </th>

                                <th
                                    style="border: 1px solid #1e3a8a;
                                    padding: 3px 4px;
                                    background-color: #1e3a8a;
                                    color: #ffffff;
                                    text-align: center;
                                    width: 14%;">
                                    Tidak
                                </th>

                                <th
                                    style="border: 1px solid #1e3a8a;
                                    padding: 3px 4px;
                                    background-color: #1e3a8a;
                                    color: #ffffff;
                                    text-align: center;
                                    width: 18%;">
                                    Tambahan Jam
                                </th>

                            </tr>
                        </thead>

                        <tbody>

                            {{-- DATA 1 --}}
                            @foreach ($absens as $absen)
                                <tr>

                                    <td
                                        style="border: 1px solid #1e3a8a;
                                        padding: 3px 4px;
                                        text-align: center;">
                                        1
                                    </td>

                                    <td
                                        style="border: 1px solid #1e3a8a;
                                        padding: 3px 4px;">
                                        {{ $absen['mapel'] }}
                                    </td>

                                    <td
                                        style="border: 1px solid #1e3a8a;
                                        padding: 3px 4px;
                                        text-align: center;">
                                        {{ $absen['jumlah'] }}
                                    </td>

                                    <td
                                        style="border: 1px solid #1e3a8a;
                                        padding: 3px 4px;
                                        text-align: center;">
                                        {{ $absen['hadir'] }}
                                    </td>

                                    <td
                                        style="border: 1px solid #1e3a8a;
                                        padding: 3px 4px;
                                        text-align: center;">
                                        {{ $absen['tidak'] }}
                                    </td>

                                    <td
                                        style="border: 1px solid #1e3a8a;
                                        padding: 3px 4px;
                                        text-align: center;">
                                        {{ $absen['tambahan'] }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>

            </tr>

        </table>


        {{-- ===== TANDA TANGAN ===== --}}
        <table style="width: 100%; border-collapse: collapse; font-size: 9.5px;">

            <tr>

                {{-- ORANG TUA --}}
                <td
                    style="width: 33.33%;
                    text-align: center;
                    vertical-align: top;
                    padding: 0 10px;">

                    <p style="margin: 0;">
                        Mengetahui,
                    </p>

                    <p style="margin: 0;">
                        Orang Tua / Wali Siswa
                    </p>

                    <div style="height: 55px;"></div>

                    <p
                        style="font-weight: bold;
                        text-decoration: underline;
                        margin: 0;">
                        ( .............................. )
                    </p>

                </td>


                {{-- KEPALA CABANG --}}
                <td
                    style="width: 33.33%;
                    text-align: center;
                    vertical-align: top;
                    padding: 0 10px;">

                    <p style="margin: 0;">
                        Purbalingga, {{ now()->locale('id')->translatedFormat('d F Y') }}
                    </p>

                    <p style="margin: 0;">
                        Kepala Cabang
                    </p>

                    <div style="height: 55px;"></div>

                    <p
                        style="font-weight: bold;
                        text-decoration: underline;
                        margin: 0;">
                        Clown laughting at you
                    </p>

                </td>


                {{-- KOORDINATOR --}}
                <td
                    style="width: 33.33%;
                    text-align: center;
                    vertical-align: top;
                    padding: 0 10px;">

                    <p style="margin: 0;">
                        &nbsp;
                    </p>

                    <p style="margin: 0;">
                        Koordinator
                    </p>

                    <div style="height: 55px;"></div>

                    <p
                        style="font-weight: bold;
                        text-decoration: underline;
                        margin: 0;">
                        User Anonymous
                    </p>

                </td>

            </tr>

        </table>


        {{-- ===== FOOTER ===== --}}
        <div
            style="font-size: 7.5px;
            color: #6b7280;
            margin-top: 14px;
            border-top: 1px solid #d1d5db;
            padding-top: 4px;
            text-align: center;">

            Dokumen ini dicetak secara elektronik oleh sistem informasi akademik
            Neutron cabang Purbalingga.

        </div>

    </div>

</body>

</html>

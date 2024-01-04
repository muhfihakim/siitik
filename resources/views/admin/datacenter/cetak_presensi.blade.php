<!DOCTYPE html>
<html lang="eng">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-ITIK</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/cetak_presensi.css') }}" />
    <style>
        @media print {

            /* Define styles for the first page */
            body {
                page-break-before: always;
            }

            /* Header styles for the second page and onwards */
            @page {
                margin-top: 100px;
                /* Adjust as needed */
                content: "DAFTAR HADIR KUNJUNGAN TAMU DATA CENTER DISKOMINFO KABUPATEN SUBANG";
            }

            /* Hide the header on the first page */
            thead {
                display: table-header-group;
            }

            /* Display the header on subsequent pages */
            tbody {
                display: table-header-group;
            }
        }
    </style>
</head>

<body>
    @php
        // Konversi angka bulan menjadi nama bulan dalam bahasa Indonesia
        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        // Ambil nama bulan dari array
        $bulanIndonesia = $namaBulan[$bulan];
    @endphp
    <table class="tg" style="table-layout: fixed; width: 100%">
        <colgroup>
            <col style="width: 63px">
            <col style="width: 25px">
            <col style="width: 200px">
            <col style="width: 120px">
            <col style="width: 120px">
            <col style="width: 87px">
            <col style="width: 191px">
            <col style="width: 76px">
            <col style="width: 108px">
            <col style="width: 108px">
            <col style="width: 108px">
            <col style="width: 201px">
            <col style="width: 114px">
            <col style="width: 114px">
            <col style="width: 101px">
        </colgroup>
        <tr>
            <th class="tg-xpxm">Nomor</th>
            <th class="tg-xpxm">:</th>
            <th class="tg-lgk6"></th>
            <th class="tg-gh6k" colspan="11" rowspan="4">DAFTAR HADIR KUNJUNGAN TAMU DATA CENTER
                DISKOMINFO<br>KABUPATEN SUBANG</th>
            <th class="tg-lgk6" rowspan="4">
                <div style="display: flex; justify-content: center;">
                    <img src="{{ asset('admin/assets/img/logo_subang.png') }}" style="width: 100%; height: auto;">
                </div>
            </th>
        </tr>
        <tr>
            <th class="tg-wpk1">Revisi</th>
            <th class="tg-wpk1">:</th>
            <th class="tg-5xcx"></th>
        </tr>
        <tr>
            <th class="tg-wpk1">Periode</th>
            <th class="tg-wpk1">:</th>
            <th class="tg-5xcx">{{ $bulanIndonesia }} {{ date('Y') }}</th>
        </tr>
        <tr>
            <th class="tg-wpk1"></th>
            <th class="tg-wpk1">:</th>
            <th class="tg-5xcx"></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-6xcx" colspan="15"></td>
            </tr>
            <tr>
                <td class="tg-4gfj" rowspan="2">No</td>
                <td class="tg-4gfj" colspan="6">Identitas</td>
                <td class="tg-4gfj" rowspan="2">No. Badge</td>
                <td class="tg-20nl" colspan="3">Waktu</td>
                <td class="tg-4gfj" rowspan="2">Tujuan</td>
                <td class="tg-20nl" colspan="2">No. Seri Perangkat</td>
                <td class="tg-4gfj" rowspan="2">TTD</td>
            </tr>
            <tr>
                <td class="tg-4gfj" colspan="2">Nama Lengkap</td>
                <td class="tg-4gfj">Instansi</td>
                <td class="tg-4gfj">Alamat</td>
                <td class="tg-4gfj">Jenis Identitas</td>
                <td class="tg-4gfj">No. Identitas</td>
                <td class="tg-4gfj">Tanggal</td>
                <td class="tg-4gfj">Jam Masuk</td>
                <td class="tg-4gfj">Jam Keluar</td>
                <td class="tg-4gfj">Masuk</td>
                <td class="tg-4gfj">Keluar</td>
            </tr>
            @foreach ($data as $presensi)
                <tr>
                    <td class="tg-509f">{{ $loop->iteration }}</td>
                    <td class="tg-m223" colspan="2">{{ $presensi->nama_lengkap }}</td>
                    <td class="tg-73oq">{{ $presensi->instansi }}</td>
                    <td class="tg-73oq">{{ $presensi->kotakab }}</td>
                    <td class="tg-73oq">{{ $presensi->jenis_identitas }}</td>
                    <td class="tg-73oq">{{ $presensi->no_identitas }}</td>
                    <td class="tg-73oq">{{ $presensi->no_badge }}</td>
                    <td class="tg-73oq">{{ \Carbon\Carbon::parse($presensi->tanggal)->format('d-m-Y') }}</td>
                    <td class="tg-73oq">{{ $presensi->jam_masuk }}</td>
                    <td class="tg-73oq">{{ $presensi->jam_keluar }}</td>
                    <td class="tg-73oq">{{ $presensi->tujuan }}</td>
                    <td class="tg-73oq">{{ $presensi->masuk_perangkat }}</td>
                    <td class="tg-73oq">{{ $presensi->keluar_perangkat }}</td>
                    <td class="tg-73oq"><img src="{{ asset('storage/' . $presensi->ttd) }}" alt="Tanda Tangan"
                            style="width: 80px; height: 20px;"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Aset</title>
</head>

<body>
    <style type="text/css">
        .container {
            text-align: center;
        }

        .tg {
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0 auto;
            /* Mengatur tabel agar berada di tengah */
        }

        /* Pengaturan gaya sel lainnya (td, th) */
        .tg td,
        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        /* Pengaturan lebar kolom tabel (sesuaikan dengan kebutuhan) */
        .tg th {
            font-weight: bold;
            text-align: center;
        }
    </style>
    <div style="text-align: center;">REKAP ASET BIDANG TIK DAN PERSANDIAN</div>
    <div style="text-align: center;">DINAS KOMUNIKASI DAN INFORMATIKA</div>
    <div style="text-align: center;">KABUPATEN SUBANG</div>
    <br>
    <table class="tg" style="table-layout: fixed; width: 100%">
        <colgroup>
        <thead>
            <tr>
                <th class="tg-f6o3" style="width: 10px;">No</th>
                <th class="tg-f6o3" style="width: 50px;">Kode</th>
                <th class="tg-f6o3" style="width: 90px;">Nama</th>
                <th class="tg-f6o3" style="width: 50px;">Type</th>
                <th class="tg-f6o3" style="width: 50px;">S/N</th>
                <th class="tg-f6o3" style="width: 25px;">Tahun</th>
                <th class="tg-f6o3" style="width: 25px;">Kondisi</th>
                <th class="tg-f6o3" style="width: 50px;">Letak</th>
                <th class="tg-f6o3" style="width: 50px;">Gambar</th>
                <th class="tg-f6o3" style="width: 25px;">Ket</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $aset)
                <tr>
                    <td class="tg-baqh" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td class="tg-baqh" style="text-align: center;">{{ $aset->kode }}</td>
                    <td class="tg-baqh" style="text-align: center;">{{ $aset->nama }}</td>
                    <td class="tg-baqh" style="text-align: center;">{{ $aset->type }}</td>
                    <td class="tg-baqh" style="text-align: center;">{{ $aset->sn }}</td>
                    <td class="tg-baqh" style="text-align: center;">{{ $aset->tahun }}</td>
                    <td class="tg-baqh" style="text-align: center;">{{ $aset->kondisi }}</td>
                    <td class="tg-baqh" style="text-align: center;">{{ $aset->letak }}</td>
                    <td class="tg-baqh" style="text-align: center;">
                        <img src="{{ asset('storage/' . $aset->gambar) }}" alt="Gambar Aset"
                            style="width: 70px; height: 50px;">
                    </td>
                    <td class="tg-baqh" style="text-align: center;">{{ $aset->ket }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

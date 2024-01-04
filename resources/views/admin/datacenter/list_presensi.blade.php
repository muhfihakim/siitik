@extends('admin.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/responsive.dataTables.min.css') }}">
    <script type="text/javascript" language="javascript" src="{{ asset('admin/assets/js/id.json') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
@endsection
@section('content')
    <div class="content-header">
        <h5 class="content-title">Daftar Kunjungan Pusat Data</h5>
        <div class="ms-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCetakPresensi">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                </svg>
                <span class="ms-1">Cetak Rekap Kunjungan</span>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="modalCetakPresensi" tabindex="-1" aria-labelledby="modalCetakPresensiLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCetakPresensiLabel">Pilih Bulan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk memilih bulan -->
                            <form id="formCetakPresensi" action="{{ route('cetak.presensi') }}" method="post"
                                target="_blank">
                                @csrf
                                <div class="mb-3">
                                    <label for="bulan">Pilih Bulan</label>
                                    <select class="form-select" id="bulan" name="bulan" required>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cetak Rekap</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-light table-hover" id="myTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">INSTANSI</th>
                            <th scope="col">KOTA/KAB</th>
                            <th scope="col">JENIS</th>
                            <th scope="col">NO IDENTITAS</th>
                            <th scope="col">TANGGAL</th>
                            <th scope="col">MASUK</th>
                            <th scope="col">KELUAR</th>
                            <th scope="col">KET</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $presensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $presensi->nama_lengkap }}</td>
                                <td>{{ $presensi->instansi }}</td>
                                <td>{{ $presensi->kotakab }}</td>
                                <td>{{ $presensi->jenis_identitas }}</td>
                                <td>{{ $presensi->no_identitas }}</td>
                                <td>{{ \Carbon\Carbon::parse($presensi->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $presensi->jam_masuk }}</td>
                                <td>{{ $presensi->jam_keluar }}</td>
                                <td>{{ $presensi->keterangan }}</td>
                                <td class="text-nowrap">
                                    <!-- Tombol untuk Selfie -->
                                    <button class="btn btn-xs btn-info"
                                        onclick="tampilkanFile('{{ asset('storage/' . $presensi->selfie) }}')">
                                        Selfie</button>
                                    <!-- Tombol untuk TTD -->
                                    <button class="btn btn-xs btn-success"
                                        onclick="tampilkanFile('{{ asset('storage/' . $presensi->ttd) }}')">
                                        TTD</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (session('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('message') }}",
            });
        </script>
    @endif
    <script src="{{ asset('admin/assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                language: {
                    "url": "{{ asset('admin/assets/js/id.json') }}"
                }
            });
        });
    </script>
    <script>
        function tampilkanFile(kontenFile, jenisFile) {
            Swal.fire({
                title: jenisFile,
                text: jenisFile === 'Selfie' ? 'Pratinjau Selfie' : 'Pratinjau TTD',
                imageUrl: kontenFile, // Mengasumsikan kontenFile adalah URL gambar yang valid
                imageAlt: jenisFile,
                confirmButtonText: 'Tutup'
            });
        }
    </script>
@endsection

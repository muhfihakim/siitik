@extends('admin.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/responsive.dataTables.min.css') }}">
    <script type="text/javascript" language="javascript" src="{{ asset('admin/assets/js/id.json') }}"></script>
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
@endsection
@section('content')
    <div class="content-header">
        <h5 class="content-title">Daftar Permohonan Virtual Meeting</h5>
        <div class="ms-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bulanModal">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                </svg>
                <span class="ms-1">Cetak Rekap Virtual Meet</span>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="bulanModal" tabindex="-1" aria-labelledby="bulanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bulanModalLabel">Pilih Bulan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulir di dalam modal -->
                            <form action="/comingsoon" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="bulan" class="form-label">Pilih Bulan</label>
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
                                <button type="submit" class="btn btn-primary">Unduh Rekap</button>
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
                            <th scope="col">INSTANSI</th>
                            <th scope="col">PEMOHON</th>
                            <th scope="col">TLP/WA</th>
                            <th scope="col">JUDUL</th>
                            <th scope="col">LOKASI</th>
                            <th scope="col">PARTISIPAN</th>
                            <th scope="col">SRT.PRMHNAN</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permohonanvirtualmeet as $vidcon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vidcon->instansi }}</td>
                                <td>{{ $vidcon->pemohon }}</td>
                                <td>{{ $vidcon->tlp }}</td>
                                <td>{{ $vidcon->judul }}</td>
                                <td>{{ $vidcon->lokasi }}</td>
                                <td>{{ $vidcon->partisipan }}</td>
                                <td class="text-nowrap">
                                    @if ($vidcon->surat_permohonan)
                                        <a class="btn btn-xs btn-success"
                                            href="{{ asset('storage/' . $vidcon->surat_permohonan) }}">Download</a>
                                    @else
                                        <a class="btn btn-xs btn-primary"
                                            onclick="showUploadFormSrtPrmhnan('{{ $vidcon->id }}')">Upload Srt
                                            Prmhnan</a>
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    @if ($vidcon->surat_perintah)
                                        <a class="btn btn-xs btn-warning"
                                            href="{{ asset('storage/' . $vidcon->surat_perintah) }}">Download SP</a>
                                    @else
                                        <a class="btn btn-xs btn-primary"
                                            onclick="showUploadFormSP('{{ $vidcon->id }}')">Upload
                                            SP</a>
                                    @endif
                                    <!-- Tombol Lihat Detail -->
                                    <a class="btn btn-xs btn-info" onclick="showDetail('{{ $vidcon->id }}')">Lihat
                                        Detail</a>
                                    <form method="post" action="/admin/virtualmeet/{{ $vidcon->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus permohonan ini?')">Delete</button>
                                    </form>
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

    <script>
        function showUploadFormSP(uploadSP) {
            Swal.fire({
                html: `
                <form method="post" action="/admin/virtualmeet/${uploadSP}/upsp" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-4 row">
                            <label for="surat_perintah" class="form-label required">Upload Surat Perintah</label>
                            <div class="col">
                                <input type="file" name="surat_perintah" class="form-control" id="surat_perintah" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            `,
                showCloseButton: true,
                showConfirmButton: false,
                focusConfirm: false,
                width: '35%',
            });
        }
    </script>
    <script>
        function showUploadFormSrtPrmhnan(uploadSrtPrmhnan) {
            Swal.fire({
                html: `
                <form method="post" action="/admin/virtualmeet/${uploadSrtPrmhnan}/upsrtprmhnan" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-4 row">
                            <label for="surat_perintah" class="form-label required">Upload Surat Permohonan</label>
                            <div class="col">
                                <input type="file" name="surat_permohonan" class="form-control" id="surat_perintah" aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            `,
                showCloseButton: true,
                showConfirmButton: false,
                focusConfirm: false,
                width: '35%',
            });
        }
    </script>
    <script>
        function showDetail(id) {
            // Ambil data detail dari backend, contoh menggunakan AJAX
            // Sesuaikan dengan struktur data dan endpoint yang digunakan di backend
            $.ajax({
                url: '/get-detail/' + id, // Ganti dengan endpoint yang sesuai
                method: 'GET',
                success: function(response) {
                    // Tampilkan SweetAlert dengan konten HTML
                    Swal.fire({
                        html: response.detail, // Ganti dengan response dari backend
                        showCloseButton: true,
                        showConfirmButton: false,
                    });
                },
                error: function(error) {
                    console.error(error);
                    // Tampilkan pesan kesalahan jika terjadi
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengambil detail.',
                    });
                },
            });
        }
    </script>
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
@endsection

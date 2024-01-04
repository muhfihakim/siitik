@extends('admin.app')
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form method="POST" action="{{ route('adding.aplikasi') }}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Tambah Aplikasi</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Nama Aplikasi</label>
                                <div class="col">
                                    <input type="text" name="nama" class="form-control"
                                        placeholder="Masukkan Nama Aplikasi">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Domain / URL</label>
                                <div class="col">
                                    <input type="text" name="domain" class="form-control"
                                        placeholder="Masukkan Domain atau URL">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">IP Lookup</label>
                                <div class="col">
                                    <input type="text" name="ip_lookup" class="form-control"
                                        placeholder="IP Ini Akan Terisi Otomatis">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Status</label>
                                <div class="col">
                                    <select name="status" class="form-control" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Keterangan</label>
                                <div class="col">
                                    <input type="text" name="keterangan" class="form-control"
                                        placeholder="Masukkan Keterangan">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="admin/vm" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title py-1 mb-4">Petunjuk Penambahan Data Aplikasi</h4>
                        <div class="mb-4 row">
                            <label for="">
                                1. <strong>Nama Aplikasi:</strong>
                                Pilih atau masukkan nama lengkap aplikasi yang akan ditambahkan.
                                <br>
                                2. <strong>Domain/URL:</strong>
                                Masukkan alamat domain atau URL lengkap aplikasi.
                                <br>
                                3. <strong>IP Lookup:</strong>
                                Disini akan muncul alamat IP dari domain tersebut.
                                <br>
                                4. <strong>Status:</strong>
                                Pilih status aplikasi dari opsi yang tersedia:
                                Aktif: Pilih opsi ini jika aplikasi sedang aktif.
                                Nonaktif: Pilih opsi ini jika aplikasi sedang nonaktif.
                                <br>
                                5. <strong>Keterangan:</strong>
                                Berikan keterangan tambahan atau deskripsi singkat tentang aplikasi ini.
                                <br>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin/assets/js/jquery-3.7.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('input[name="domain"]').on('blur', function() {
                var domain = $(this).val();
                if (domain.trim() !== '') {
                    var apiUrl = 'https://networkcalc.com/api/dns/lookup/' + encodeURIComponent(domain);
                    $.ajax({
                        url: apiUrl,
                        method: 'GET',
                        success: function(data) {
                            // Mengambil nilai dari atribut "address" dalam respons JSON
                            var address = data.records.A[0]
                                .address; // Memastikan Atribut "address" ada dan merupakan array yang pertama

                            // Memasukkan nilai "address" ke dalam elemen dengan nama "ip_lookup"
                            $('input[name="ip_lookup"]').val(address);
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });
    </script>
@endsection

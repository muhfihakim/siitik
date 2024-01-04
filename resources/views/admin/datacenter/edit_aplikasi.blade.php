@extends('admin.app')
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form method="POST" action="admin/aplikasi/{{ $aplikasi->id }}">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Edit Aplikasi</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Nama Aplikasi</label>
                                <div class="col">
                                    <input type="text" name="nama" class="form-control"
                                        placeholder="Masukkan Nama Aplikasi" value="{{ $aplikasi->nama }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Domain / URL</label>
                                <div class="col">
                                    <input type="text" name="domain" class="form-control"
                                        placeholder="Masukkan Domain atau URL" value="{{ $aplikasi->domain }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">IP Lookup</label>
                                <div class="col">
                                    <input type="text" name="ip_lookup" class="form-control"
                                        placeholder="IP Ini Akan Terisi Otomatis" value="{{ $aplikasi->ip_lookup }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Status</label>
                                <div class="col">
                                    <select name="status" class="form-control" required>
                                        <option value="Aktif" {{ $aplikasi->status === 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Nonaktif" {{ $aplikasi->status === 'Nonaktif' ? 'selected' : '' }}>
                                            Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Keterangan</label>
                                <div class="col">
                                    <input type="text" name="keterangan" class="form-control"
                                        placeholder="Masukkan Keterangan" value="{{ $aplikasi->keterangan }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('index.aplikasi') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </form>
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

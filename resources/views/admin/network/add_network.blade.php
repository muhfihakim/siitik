@extends('admin.app')
@section('css')
    <script src="{{ asset('admin/assets/js/jquery-3.7.0.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
@endsection
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form method="POST" action="{{ route('adding.network') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Tambah Jaringan</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Lokasi</label>
                                <div class="col">
                                    <input type="text" name="lokasi" class="form-control"
                                        placeholder="Masukkan Nama Lokasi/Instansi">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label">Jenis</label>
                                <div class="col">
                                    <select name="jenis" class="form-select">
                                        <option>Pilih Jenis</option>
                                        <option>Backbone</option>
                                        <option>ONT</option>
                                        <option>Router</option>
                                        <option>LAN</option>
                                        <option>Access Point</option>
                                        <option>Radio</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">SN Aset</label>
                                <div class="col">
                                    <select name="sn_aset" class="theSelect form-control" id="snAsetSelect">
                                        <option value="">Pilih SN Aset</option>
                                        @foreach ($options as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Titik</label>
                                <div class="col">
                                    <input type="text" name="titik" class="form-control"
                                        placeholder="Masukkan Letak Titik">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Titik Koordinat</label>
                                <div class="col">
                                    <button type="button" id="getCoordinatesButton" class="btn btn-primary">Ambil
                                        Koordinat</button>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Latitude</label>
                                <div class="col">
                                    <input type="text" name="latitude" id="latitude" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Longitude</label>
                                <div class="col">
                                    <input type="text" name="longitude" id="longitude" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label">Cek di Maps</label>
                                <div class="col">
                                    <a id="googleMapsLink" href="" target="_blank" class="btn btn-primary">Lihat
                                        Maps</a>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Tanggal Pasang</label>
                                <div class="col">
                                    <input type="date" name="tgl_pasang" class="form-control"
                                        placeholder="Masukkan Tanggal Instalasi">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Berita Acara</label>
                                <div class="col">
                                    <input type="file" name="ba" class="form-control">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Foto</label>
                                <div class="col">
                                    <input name="foto" type="file" accept="image/*" id="takePhotoInput2"
                                        capture="camera" style="display: none;">
                                    <button type="button" id="takePhotoButton2" class="btn btn-primary">Ambil / Pilih
                                        Foto</button>
                                    <div id="photoPreview" style="margin-top: 10px;"></div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Keterangan</label>
                                <div class="col">
                                    <input type="text" name="description" class="form-control"
                                        placeholder="Masukkan Keterangan">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="admin/network" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title py-1 mb-4">Petunjuk Penambahan Data Jaringan</h4>
                        <div class="mb-4 row">
                            <label>
                                1. <strong>Lokasi:</strong>
                                Masukkan lokasi/instansi fisik dari jaringan.
                                Contoh: "Sekretariat Daerah, Diskominfo".
                                <br>
                                2. <strong>Jenis:</strong>
                                Pilih jenis jaringan yang akan diimplementasikan.
                                Contoh: "Router" atau "Access Point".
                                <br>
                                3. <strong>SN Aset:</strong>
                                Pilih atau cari Serial Number Aset.
                                <br>
                                4. <strong>Titik:</strong>
                                Tentukan titik atau lokasi spesifik dari jaringan.
                                Contoh: "Ruang Rapat" atau "Lobby".
                                <br>
                                5. <strong>Ambil Koordinat:</strong>
                                Tekan tombol ini untuk mengambil koordinat lokasi secara otomatis.
                                <br>
                                6. <strong>Cek di Maps:</strong>
                                Verifikasi lokasi jaringan pada peta setelah mengambil koordinat.
                                <br>
                                7. <strong>Tanggal Pasang:</strong>
                                Pilih atau masukkan tanggal pemasangan jaringan.
                                <br>
                                8. <strong>Berita Acara (file):</strong>
                                Unggah berkas berita acara yang terkait dengan pemasangan jaringan.
                                <br>
                                9. <strong>Foto:</strong>
                                Unggah foto yang memperlihatkan detail pemasangan jaringan.
                                <br>
                                10. <strong>Keterangan:</strong>
                                Berikan keterangan atau catatan tambahan yang diperlukan untuk menjelaskan atau
                                mengidentifikasi detail pemasangan jaringan.
                                Contoh: "Jaringan ini menghubungkan dua gedung utama".
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const takePhotoButton = document.getElementById('takePhotoButton2');
            const takePhotoInput = document.getElementById('takePhotoInput2');
            const photoPreview = document.getElementById('photoPreview');

            takePhotoButton.addEventListener('click', function() {
                takePhotoInput.click();
            });

            takePhotoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();

                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '60%';
                    photoPreview.innerHTML = '';
                    photoPreview.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
    <script>
        $(".theSelect").select2();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const getCoordinatesButton = document.getElementById("getCoordinatesButton");
            const latitudeInput = document.getElementById("latitude");
            const longitudeInput = document.getElementById("longitude");
            const googleMapsLink = document.getElementById("googleMapsLink");

            getCoordinatesButton.addEventListener("click", function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        latitudeInput.value = position.coords.latitude;
                        longitudeInput.value = position.coords.longitude;

                        // Update the Google Maps link with the correct URL
                        googleMapsLink.href =
                            `https://www.google.com/maps?q=${position.coords.latitude},${position.coords.longitude}`;

                        alert("Koordinat berhasil diambil: Latitude " + position.coords.latitude +
                            ", Longitude " + position.coords.longitude);
                    }, function(error) {
                        alert("Gagal mengambil koordinat: " + error.message);
                    });
                } else {
                    alert("Browser Anda tidak mendukung geolokasi.");
                }
            });
        });
    </script>
@endsection

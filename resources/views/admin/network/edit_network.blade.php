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
                    <form action="admin/network/{{ $network->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Edit Jaringan</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Lokasi</label>
                                <div class="col">
                                    <input type="text" name="lokasi" class="form-control"
                                        placeholder="Masukkan Lokasi/Instansi" value="{{ $network->lokasi }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Jenis</label>
                                <div class="col">
                                    <select name="jenis" class="form-select">
                                        <option value="">Pilih Jenis</option>
                                        @foreach ($jenisOptions as $jenis)
                                            <option
                                                value="{{ $jenis }}"{{ $network->jenis === $jenis ? ' selected' : '' }}>
                                                {{ $jenis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Kode Aset</label>
                                <div class="col">
                                    <select name="sn_aset" class="theSelect form-control" id="snAsetSelect">
                                        <option value="">Pilih SN Aset</option>
                                        @foreach ($snAsetOptions as $snAset)
                                            <option
                                                value="{{ $snAset }}"{{ $network->sn_aset == $snAset ? 'selected' : '' }}>
                                                {{ $snAset }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Titik</label>
                                <div class="col">
                                    <input type="text" name="titik" class="form-control" placeholder="Masukkan Titik"
                                        value="{{ $network->titik }}">
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
                                    <input type="text" name="latitude" id="latitude" class="form-control" readonly
                                        value="{{ $network->latitude }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Longitude</label>
                                <div class="col">
                                    <input type="text" name="longitude" id="longitude" class="form-control" readonly
                                        value="{{ $network->longitude }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Tanggal Pasang</label>
                                <div class="col">
                                    <input type="date" name="tgl_pasang" class="form-control"
                                        placeholder="Masukkan Tanggal Instalasi" value="{{ $network->tgl_pasang }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Berita Acara</label>
                                <div class="col">
                                    <input type="file" name="ba" class="form-control" value="{{ $network->ba }}"
                                        placeholder="Masukkan Berita Acara">
                                    @if ($network->ba)
                                        <p>Berita Acara saat ini: <a
                                                href="{{ asset('storage/' . $network->ba) }}">{{ $network->ba }}</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Foto</label>
                                <div class="col">
                                    <input name="foto" type="file" id="fotoInput" accept="image/*"
                                        class="form-control">
                                    <div id="photoPreview" style="margin-top: 10px;">
                                        @if ($network->foto)
                                            <img src="{{ asset('storage/' . $network->foto) }}" alt="Foto Titik"
                                                width="100">
                                        @else
                                            Foto tidak tersedia
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Keterangan</label>
                                <div class="col">
                                    <input type="text" name="description" class="form-control"
                                        placeholder="Masukkan Keterangan Titik" value="{{ $network->description }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="admin/network" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".theSelect").select2();
    </script>
    <script>
        document.getElementById('fotoInput').addEventListener('change', function() {
            var photoPreview = document.getElementById('photoPreview');
            while (photoPreview.firstChild) {
                photoPreview.removeChild(photoPreview.firstChild);
            }

            var file = this.files[0];
            if (file) {
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = 'Foto Titik';
                img.width = 100;
                photoPreview.appendChild(img);
            } else {
                var text = document.createTextNode('Foto tidak tersedia');
                photoPreview.appendChild(text);
            }
        });
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

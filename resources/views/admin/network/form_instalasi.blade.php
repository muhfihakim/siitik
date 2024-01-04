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
                    <form method="POST" action="{{ route('generate.form') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Instalasi Jaringan FO dan Internet</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Nomor Formulir</label>
                                <div class="col">
                                    <input type="text" name="nomor_formulir" class="form-control"
                                        placeholder="Masukkan Nomor Formulir">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Nama Instansi</label>
                                <div class="col">
                                    <input type="text" name="nama_instansi" class="form-control"
                                        placeholder="Masukkan Nama Instansi">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Lokasi</label>
                                <div class="col">
                                    <input type="text" name="lokasi" class="form-control"
                                        placeholder="Masukkan Nama Lokasi">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Jenis Kegiatan</label>
                                <div class="col">
                                    <input type="text" name="jenis_kegiatan" class="form-control"
                                        placeholder="Masukkan Jenis Kegiatan">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Tanggal Pelaksanaan</label>
                                <div class="col">
                                    <input type="date" name="tanggal_pelaksanaan" class="form-control"
                                        placeholder="Pilih Tanggal Pelaksanaan">
                                </div>
                            </div>
                            <!-- HTML Formulir Barang -->
                            <div class="mb-4 row" id="formulirBarangContainer">
                                <!-- Container untuk formulir-formulir barang -->
                                <div id="templatFormulir" style="display:none;">
                                    <div class="mb-4 row">
                                        <label class="col-3 col-form-label required">Nama Barang</label>
                                        <div class="col">
                                            <input type="text" name="nama_barang" class="form-control"
                                                placeholder="Masukkan Nama Barang">
                                        </div>
                                    </div>
                                    <div class="mb-4 row">
                                        <label class="col-3 col-form-label required">Spesifikasi</label>
                                        <div class="col">
                                            <input type="text" name="spesifikasi" class="form-control"
                                                placeholder="Masukkan Spesifikasi">
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
                            </div>
                            <div class="col text-center"><button id="tombolTambahBarang" class="btn btn-warning"
                                    type="button">Tambah Barang</button></div>
                            <br>
                            <!-- Templat Formulir Barang (tersembunyi) -->
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Penjelasan Detail</label>
                                <div class="col">
                                    <input type="textarea" name="penjelasan_detail" class="form-control"
                                        placeholder="Masukkan Penjelasan Detail">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Tim Pelaksana</label>
                                <div class="col">
                                    <select name="tim_pelaksana" id="tim_pelaksana" class="form-control">
                                        <option value="">Pilih Tim Pelaksana</option>
                                        <option value="Yoga Malik Ibrahim">Yoga Malik Ibrahim</option>
                                        <option value="Dwi Aprianto">Dwi Aprianto</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Jabatan Tim Pelaksana</label>
                                <div class="col">
                                    <input type="text" name="jabatan_tim_pelaksana" id="jabatan_tim_pelaksana"
                                        class="form-control" placeholder="Jabatan Akan Terisi Otomatis" readonly>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Pihak OPD/Pemohon</label>
                                <div class="col">
                                    <input type="textarea" name="pihak_opd" class="form-control"
                                        placeholder="Masukkan Pihak OPD/Pemohon">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Jabatan Pihak OPD/Pemohon</label>
                                <div class="col">
                                    <input type="textarea" name="jabatan_pihak_opd" class="form-control"
                                        placeholder="Masukkan Jabatan OPD/Pemohon">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('index.network') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Cetak / PDF</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title py-1 mb-4">Petunjuk Penambahan Data Jaringan</h4>
                        <div class="mb-4 row">
                            <label for="">
                                <strong>1. Nomor Formulir:</strong>
                                Pilih atau masukkan nomor formulir yang telah diberikan.
                                <br>

                                <strong>2. Nama Instansi:</strong>
                                Pilih atau masukkan nama lengkap instansi atau organisasi.
                                <br>

                                <strong>3. Lokasi:</strong>
                                Tentukan lokasi instalasi data jaringan.
                                <br>

                                <strong>4. Jenis Kegiatan:</strong>
                                Deskripsikan jenis kegiatan yang membutuhkan instalasi data jaringan.
                                <br>

                                <strong>5. Tanggal Pelaksanaan:</strong>
                                Isi tanggal pelaksanaan instalasi.
                                <br>

                                <strong>6. Barang:</strong>
                                <br>
                                - Daftar barang yang akan diinstalasi, seperti kabel, switch, router, dll.
                                <br>
                                - Spesifikasi teknis barang.
                                <br>
                                - Keterangan barang.
                                <br>

                                <strong>7. Penjelasan Detail:</strong>
                                <br>
                                - Jelaskan dengan rinci tujuan instalasi dan kebutuhan spesifik.
                                <br>

                                <strong>8. Nama Tim Pelaksana:</strong>
                                Pilih atau masukkan nama tim pelaksana instalasi.
                                <br>

                                <strong>9. Jabatan Tim Pelaksana:</strong>
                                Tentukan jabatan masing-masing anggota tim pelaksana.
                                <br>

                                <strong>10. Nama Pihak OPD/Pemohon:</strong>
                                Pilih atau masukkan nama lengkap pihak yang mengajukan permohonan.
                                <br>

                                <strong>11. Jabatan Pihak OPD/Pemohon:</strong>
                                Tentukan jabatan pihak yang mengajukan permohonan.
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
    <script>
        // Ambil elemen tombol dan container formulir
        var tombolTambahBarang = document.getElementById('tombolTambahBarang');
        var formulirContainer = document.getElementById('formulirBarangContainer');
        var templatFormulir = document.getElementById('templatFormulir');

        // Hitung jumlah formulir yang sudah ada
        var jumlahFormulir = 1;

        // Tambahkan event listener pada tombol
        tombolTambahBarang.addEventListener('click', function() {
            // Duplikat templat formulir dan tambahkan ke dalam container
            var formulirBaru = templatFormulir.cloneNode(true);
            formulirBaru.style.display = 'block'; // Tampilkan formulir yang baru

            // Hapus atribut 'id' dari elemen-elemen formulir baru
            formulirBaru.removeAttribute('id');

            // Ganti nama elemen-elemen input dalam formulir baru
            gantiNamaElemen(formulirBaru, jumlahFormulir);

            // Ganti label/nama formulir dalam elemen label
            gantiLabelFormulir(formulirBaru, jumlahFormulir);

            // Ganti placeholder elemen-elemen input dalam formulir baru
            gantiPlaceholderFormulir(formulirBaru, jumlahFormulir);

            // Tambahkan formulir baru ke dalam container
            formulirContainer.appendChild(formulirBaru);

            // Tambah jumlah formulir
            jumlahFormulir++;
        });

        // Fungsi untuk mengganti nama elemen dalam formulir
        function gantiNamaElemen(formulir, nomorFormulir) {
            formulir.querySelectorAll('[name]').forEach(function(elemen) {
                var namaAsli = elemen.getAttribute('name');
                var namaBaru = namaAsli + nomorFormulir;
                elemen.setAttribute('name', namaBaru);
            });
        }

        // Fungsi untuk mengganti label/nama formulir dalam elemen label
        function gantiLabelFormulir(formulir, nomorFormulir) {
            formulir.querySelectorAll('label').forEach(function(label) {
                var textAsli = label.textContent.trim();
                var textBaru = textAsli + ' ' + nomorFormulir;
                label.textContent = textBaru;
            });
        }

        // Fungsi untuk mengganti placeholder elemen dalam formulir
        function gantiPlaceholderFormulir(formulir, nomorFormulir) {
            formulir.querySelectorAll('[placeholder]').forEach(function(elemen) {
                var placeholderAsli = elemen.getAttribute('placeholder');
                var placeholderBaru = placeholderAsli + ' ' + nomorFormulir;
                elemen.setAttribute('placeholder', placeholderBaru);
            });
        }
    </script>


    <script>
        document.getElementById('tim_pelaksana').addEventListener('change', function() {
            var selectedTimPelaksana = this.value;
            var jabatanField = document.getElementById('jabatan_tim_pelaksana');

            // Setelah mendapatkan nilai tim pelaksana, tentukan jabatannya
            switch (selectedTimPelaksana) {
                case 'Yoga Malik Ibrahim':
                    jabatanField.value = 'Network Engineer';
                    break;
                case 'Dwi Aprianto':
                    jabatanField.value = 'Network Technician';
                    break;
                default:
                    jabatanField.value = '';
            }
        });
    </script>
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

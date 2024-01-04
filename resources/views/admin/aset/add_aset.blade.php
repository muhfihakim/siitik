@extends('admin.app')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
@endsection
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form action="admin/aset/addingaset" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Tambah Aset</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Nama Aset</label>
                                <div class="col">
                                    <input type="text" name="nama" class="form-control" aria-describedby="emailHelp"
                                        placeholder="Masukkan Nama Aset">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Type Aset</label>
                                <div class="col">
                                    <input type="text" name="type" class="form-control" aria-describedby="emailHelp"
                                        placeholder="Masukkan Type Aset">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Serial Number</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="text" id="serialNumber" name="sn" class="form-control"
                                            aria-describedby="emailHelp" placeholder="Manual atau Foto SN">
                                        <input type="file" id="photoInput" accept="image/*" capture="camera"
                                            style="display: none;">
                                        <button type="button" id="takePhotoButton" class="btn btn-primary">Foto SN</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Tahun</label>
                                <div class="col">
                                    <input type="text" name="tahun" class="form-control" aria-describedby="emailHelp"
                                        placeholder="Masukkan Tahun Pengadaan Aset">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Kondisi</label>
                                <div class="col">
                                    <select name="kondisi" class="form-select">
                                        <option>Pilih Kondisi</option>
                                        <option>Normal</option>
                                        <option>Rusak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Letak</label>
                                <div class="col">
                                    <input type="text" name="letak" class="form-control" aria-describedby="emailHelp"
                                        placeholder="Masukkan Letak Aset">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Gambar</label>
                                <div class="col">
                                    <input name="gambar" type="file" id="takePhotoInput2" style="display: none;">
                                    <button type="button" id="takePhotoButton2" class="btn btn-primary">Ambil / Pilih
                                        Foto</button>
                                    <div id="photoPreview" style="margin-top: 10px;"></div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Keterangan</label>
                                <div class="col">
                                    <input type="text" name="description" class="form-control"
                                        aria-describedby="emailHelp" placeholder="Masukkan Keterangan Aset">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="admin/aset/" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title py-1 mb-4">Petunjuk Penambahan Data Aset</h4>
                        <div class="mb-4 row">
                            <label>
                                1. <strong>Nama Aset:</strong>
                                Masukkan nama lengkap atau deskripsi aset.
                                Contoh: "MikroTik".
                                <br>

                                2. <strong>Type Aset:</strong>
                                Pilih tipe atau kategori aset.
                                Contoh: "CCR1072", dll.
                                <br>

                                3. <strong>Serial Number:</strong>
                                Masukkan nomor seri atau identifikasi unik aset.
                                <br>

                                4. <strong>Tahun Pengadaan:</strong>
                                Pilih atau masukkan tahun ketika aset tersebut diperoleh.
                                Contoh: "2025".
                                <br>

                                5. <strong>Kondisi:</strong>
                                Tentukan kondisi saat ini dari aset tersebut.
                                Contoh: "Normal", "Rusak".
                                <br>

                                6. <strong>Letak:</strong>
                                Masukkan lokasi atau letak fisik aset.
                                Contoh: "Ruang TIK".
                                <br>

                                7. <strong>Gambar:</strong>
                                Unggah gambar atau foto aset.
                                <br>

                                8. <strong>Keterangan:</strong>
                                Berikan keterangan atau catatan tambahan yang diperlukan untuk menjelaskan atau
                                mengidentifikasi detail aset.
                            </label>
                        </div>
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
            const takePhotoButton = document.getElementById('takePhotoButton');
            const serialNumberInput = document.getElementById('serialNumber');
            const photoInput = document.getElementById('photoInput');

            takePhotoButton.addEventListener('click', function() {
                photoInput.click();
            });

            photoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const img = new Image();
                const reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;

                    img.onload = function() {
                        Quagga.decodeSingle({
                            src: img.src,
                            numOfWorkers: 0,
                            decoder: {
                                readers: ['ean_reader']
                            },
                            locate: true,
                            src: img.src
                        }, function(result) {
                            if (result && result.codeResult) {
                                serialNumberInput.value = result.codeResult.code;
                            } else {
                                alert('Foto Kurang Jelas!');
                            }
                        });
                    };
                };

                reader.readAsDataURL(file);
            });
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
@endsection

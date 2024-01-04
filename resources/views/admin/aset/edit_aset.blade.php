@extends('admin.app')
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form action="admin/aset/{{ $aset->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Edit Aset</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Nama Aset</label>
                                <div class="col">
                                    <input type="text" name="nama" class="form-control" aria-describedby="emailHelp"
                                        placeholder="Masukkan Nama Aset" value="{{ $aset->nama }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Type Aset</label>
                                <div class="col">
                                    <input type="text" name="type" class="form-control" aria-describedby="emailHelp"
                                        placeholder="Masukkan Type Aset" value="{{ $aset->type }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Serial Number</label>
                                <div class="col">
                                    <div class="input-group">
                                        <input type="text" id="serialNumber" name="sn" class="form-control"
                                            aria-describedby="emailHelp" placeholder="Foto Untuk SN"
                                            value="{{ $aset->sn }}">
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
                                        placeholder="Masukkan Tahun Pengadaan Aset" value="{{ $aset->tahun }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Kondisi</label>
                                <div class="col">
                                    <select name="kondisi" class="form-select">
                                        <option value="">Pilih Kondisi</option>
                                        @foreach ($kondisiOptions as $kondisi)
                                            <option
                                                value="{{ $kondisi }}"{{ $aset->kondisi === $kondisi ? ' selected' : '' }}>
                                                {{ $kondisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Letak</label>
                                <div class="col">
                                    <input type="text" name="letak" class="form-control" aria-describedby="emailHelp"
                                        placeholder="Masukkan Letak Aset" value="{{ $aset->letak }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Gambar</label>
                                <div class="col">
                                    <input name="gambar" type="file" id="takePhotoInput2" style="display: none;">
                                    <button type="button" id="takePhotoButton2" class="btn btn-primary">Ambil / Pilih
                                        Foto</button>
                                    <div id="photoPreview" style="margin-top: 10px;">
                                        @if ($aset->gambar)
                                            <img src="{{ asset('storage/' . $aset->gambar) }}" alt="Gambar Aset"
                                                width="100">
                                        @else
                                            Gambar tidak tersedia
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Description</label>
                                <div class="col">
                                    <input type="text" name="description" class="form-control"
                                        aria-describedby="emailHelp" placeholder="Masukkan Keterangan Aset"
                                        value="{{ $aset->description }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="admin/aset/" class="btn btn-danger">Kembali</a>
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
                    img.style.maxWidth = '100%';
                    photoPreview.innerHTML = '';
                    photoPreview.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection

@extends('admin.app2')
@section('css')
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
@endsection
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form method="POST" action="/admin/sendpermohonan" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            @if (session('message'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: "{{ session('message') }}",
                                    });
                                </script>
                            @endif
                            <img src="{{ asset('admin/assets/img/virtualmeet.png') }}" alt="Deskripsi Gambar"
                                style="width: 100%; max-width: 100%; display: block; margin: 0 auto; padding: 5px; border-radius: 15px;">
                            <h4 class="card-title py-1 mb-4" style="text-align: center">Layanan Dukungan Virtual Meeting
                            </h4>
                            <div class="mb-4 row">
                                <label for="kebutuhan" class="form-label required">Jenis Permohonan</label>
                                <div class="col">
                                    <select name="kebutuhan" class="form-select" id="kebutuhan">
                                        <option>Link Virtual Meeting dan Personil</option>
                                        <option>Hanya Link Virtual Meeting(Open)</option>
                                        <option>Hanya Personil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <div class="col">
                                    <label for="nama_opd" class="form-label required">Nama Instansi</label>
                                    <input type="text" name="nama_opd" class="form-control" id="nama_opd"
                                        placeholder="Masukkan Nama Instansi/OPD">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="nama_pemohon" class="form-label required">Nama Pemohon/PIC</label>
                                <div class="col">
                                    <input type="text" name="nama_pemohon" class="form-control" id="nama_pemohon"
                                        placeholder="Masukkan Nama Pemohon/PIC">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="no_telepon" class="form-label required">No Telepon/Whatsapp</label>
                                <div class="col">
                                    <input type="number" name="no_telepon" class="form-control" id="no_telepon"
                                        placeholder="Masukkan No Telepon/Whatsapp">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="judul" class="form-label required">Judul</label>
                                <div class="col">
                                    <input type="text" name="judul" class="form-control" id="judul"
                                        placeholder="Masukkan Judul/Topik">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="waktu_pelaksanaan" class="form-label required">Waktu Pelaksanaan</label>
                                <div class="col">
                                    <input type="datetime-local" name="waktu_pelaksanaan" class="form-control"
                                        id="waktu_pelaksanaan">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="lokasi" class="form-label required">Lokasi</label>
                                <div class="col">
                                    <input type="text" name="lokasi" class="form-control" id="lokasi"
                                        placeholder="Masukkan Lokasi/Alamat">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label id="partisipan" class="form-label required">Jumlah Partisipan</label>
                                <div class="col">
                                    <select name="partisipan" class="form-select" id="partisipan">
                                        <option>10-50</option>
                                        <option>50-100</option>
                                        <option>100-500</option>
                                        <option>1000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="surat_permohonan" class="form-label">Surat Permohonan</label>
                                <div class="col">
                                    <input type="file" name="surat_permohonan" class="form-control"
                                        id="surat_permohonan">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="catatan" class="form-label">Catatan</label>
                                <div class="col">
                                    <input type="text" name="description" class="form-control" id="description"
                                        placeholder="Keterangan">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title py-1 mb-4" style="text-align: center">Petunjuk Pengisian Form Permohonan
                            Dukungan Virtual Meeting</h4>
                        <div class="mb-4 row">
                            <label for="">
                                1. <strong>Jenis Permohonan:</strong>
                                Pilih jenis permohonan virtual meeting yang sesuai.
                                <br>
                                2. <strong>Nama Instansi:</strong>
                                Masukkan nama instansi atau Organisasi Perangkat Daerah (OPD) yang mengajukan permohonan.
                                <br>
                                3. <strong>Nama Pemohon/PIC:</strong>
                                Isi dengan nama lengkap pemohon atau Penanggung Jawab (Person in Charge).
                                <br>
                                4. <strong>No Telepon/Whatsapp:</strong>
                                Masukkan nomor telepon atau Whatsapp yang dapat dihubungi.
                                <br>
                                5. <strong>Judul:</strong>
                                Berikan judul untuk virtual meeting yang jelas dan deskriptif.
                                <br>
                                6. <strong>Waktu Pelaksanaan:</strong>
                                Pilih tanggal dan waktu pelaksanaan virtual meeting.
                                <br>
                                7. <strong>Lokasi:</strong>
                                Isi dengan detail lokasi atau platform virtual yang akan digunakan.
                                <br>
                                8. <strong>Jumlah Partisipan:</strong>
                                Tentukan jumlah peserta yang diundang atau diharapkan hadir dalam virtual meeting.
                                <br>
                                9. <strong>Upload Surat Permohonan:</strong>
                                Unggah surat permohonan virtual meeting dalam format PDF.
                                <br>
                                10. <strong>Catatan:</strong>
                                Tambahkan catatan atau informasi tambahan yang diperlukan.</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

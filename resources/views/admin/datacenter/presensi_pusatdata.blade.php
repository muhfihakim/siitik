@extends('admin.app2')
@section('css')
    <style>
        .kbw-signature {
            width: 100%;
            height: 160px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }

        .signature-container {
            border: 1px solid #000;
            /* Warna dan lebar garis */
            padding: 5px;
            /* Jarak antara tandatangan dan garis */
            margin-bottom: 10px;
            /* Jarak antara elemen tandatangan dan elemen berikutnya */
        }
    </style>
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <link rel="text/css" href="{{ asset('admin/assets/css/jquery-ui.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery.signature.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/jquery.signature.css') }}">
@endsection
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form method="POST" action="{{ route('send.form.presensi.pusatdata') }}" enctype="multipart/form-data">
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
                            <img src="{{ asset('admin/assets/img/datacenter.png') }}" alt="Deskripsi Gambar"
                                style="width: 100%; max-width: 100%; display: block; margin: 0 auto; padding: 5px; border-radius: 15px;">
                            <h4 class="card-title py-1 mb-4" style="text-align: center">Presensi Kunjungan Pusat Data
                            </h4>
                            <div class="mb-4 row">
                                <div class="col">
                                    <label for="nama_lengkap" class="form-label required">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                                        placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="instansi" class="form-label required">Asal/Instansi</label>
                                <div class="col">
                                    <input type="text" name="instansi" class="form-control" id="instansi"
                                        placeholder="Masukkan Asal/Instansi">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="kotakab" class="form-label required">Kota/Kabupaten</label>
                                <div class="col">
                                    <input type="text" name="kotakab" class="form-control" id="kotakab"
                                        placeholder="Masukkan Kota/Kabupaten">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="jenis_identitas" class="form-label required">Jenis Identitas</label>
                                <div class="col">
                                    <select name="jenis_identitas" class="form-select" id="jenis_identitas">
                                        <option>Pilih Jenis Identitas</option>
                                        <option>KTP</option>
                                        <option>SIM</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="no_identitas" class="form-label required">No. Identitas</label>
                                <div class="col">
                                    <input type="number" name="no_identitas" class="form-control" id="no_identitas"
                                        placeholder="Masukkan Nomor Identitas">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="no_badge" class="form-label required">No. Badge</label>
                                <div class="col">
                                    <input type="number" name="no_badge" class="form-control" id="no_badge"
                                        placeholder="Masukkan Nomor Badge">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="tanggal" class="form-label required">Tanggal</label>
                                <div class="col">
                                    <input type="date" name="tanggal" class="form-control" id="tanggal">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="jam_masuk" class="form-label required">Jam Masuk</label>
                                <div class="col">
                                    <input type="time" name="jam_masuk" class="form-control" id="jam_masuk">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="jam_keluar" class="form-label required">Jam Keluar</label>
                                <div class="col">
                                    <input type="time" name="jam_keluar" class="form-control" id="jam_keluar">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label for="tujuan" class="form-label required">Tujuan</label>
                                <div class="col">
                                    <input type="text" name="tujuan" class="form-control" id="tujuan"
                                        placeholder="Masukkan Tujuan Anda">
                                </div>
                            </div>
                            <div class="col text-center">
                                <button id="togglePerangkat" class="btn btn-warning" type="button">Klik Disini
                                    Jika Keluar Masuk Perangkat</button>
                            </div>
                            <br>
                            <div class="mb-4 row" id="formPerangkat" style="display: none;">
                                <label for="keluar_perangkat" class="form-label">No Seri Keluar</label>
                                <div class="col">
                                    <input id="keluar_perangkat" type="text" class="form-control"
                                        name="keluar_perangkat">
                                </div>
                            </div>
                            <div class="mb-4 row" id="formMasukPerangkat" style="display: none;">
                                <label for="masuk_perangkat" class="form-label">No Seri Masuk</label>
                                <div class="col">
                                    <input id="masuk_perangkat" type="text" class="form-control"
                                        name="masuk_perangkat">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="form-label required" for="gambar">Selfie</label>
                                <div class="col text-center">
                                    <input type="file" class="form-control" id="gambar" name="selfie"
                                        accept="image/*" onchange="showFileName()">
                                    <br>
                                    <label class="btn btn-success" for="gambar" id="selfie">Ambil Foto</label>
                                </div>
                                <span id="image-name"></span> <!-- Tambahkan elemen span ini -->
                            </div>
                            <div class="mb-4 row">
                                <label class="form-label required" for="">Tanda Tangan Dibawah Ini:</label>
                                <div id="sig" name='ttd' class="signature-container"></div>
                                <div class="col text-center">
                                    <button class="btn btn-danger" id="clear">Ulangi Tanda Tangan</button>
                                    <textarea id="signature64" name="ttd" style="display: none"></textarea>
                                </div>
                            </div>
                            <div>
                                <div class="mb-4 row">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <div class="col">
                                        <input type="textarea" name="keterangan" class="form-control" id="keterangan"
                                            placeholder="Keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">Kirim Presensi</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-5">
                <div class="card-body">
                    <h4 class="card-title py-1 mb-4" style="text-align: center">Petunjuk Pengisian Form Presensi Pusat
                        Data</h4>
                    <div class="mb-4 row">
                        <label for="">
                            1. <strong>Nama Lengkap:</strong>
                            Masukkan nama lengkap pengunjung.
                            Contoh: "Muhammad Luthfi Hakim".
                            <br>

                            2. <strong>Asal/Instansi:</strong>
                            Masukkan asal atau instansi dari pengunjung.
                            Contoh: "Diskominfo".
                            <br>

                            3. <strong>Kota/Kabupaten:</strong>
                            Masukkan kota atau kabupaten asal pengunjung.
                            Contoh: "Subang".
                            <br>

                            4. <strong>Jenis Identitas:</strong>
                            Pilih jenis identitas yang akan digunakan.
                            Contoh: "KTP", "SIM", "Lainnya".
                            <br>

                            5. <strong>No. Identitas:</strong>
                            Masukkan nomor identitas sesuai dengan jenis yang dipilih.
                            <br>

                            6. <strong>No. Badge:</strong>
                            Masukkan nomor badge atau kartu pengunjung (jika berlaku).
                            <br>

                            7. <strong>Tanggal:</strong>
                            Pilih atau masukkan tanggal kunjungan.
                            <br>

                            8. <strong>Jam Masuk:</strong>
                            Pilih atau masukkan jam masuk pengunjung.
                            <br>

                            9. <strong>Jam Keluar:</strong>
                            Pilih atau masukkan jam keluar pengunjung.
                            <br>

                            10. <strong>Tujuan:</strong>
                            Jelaskan tujuan kunjungan pusat data.
                            Contoh: "Pemeliharaan", "Pemeriksaan".
                            <br>

                            11. <strong>Selfie:</strong>
                            Unggah foto selfie pengunjung.
                            <br>

                            12. <strong>Tandatangan:</strong>
                            Tandatangani formulir sebagai tanda presensi.
                            <br>

                            13. <strong>Keterangan:</strong>
                            Berikan keterangan atau catatan tambahan jika diperlukan.
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
        document.addEventListener("DOMContentLoaded", function() {
            const togglePerangkatButton = document.getElementById("togglePerangkat");
            const formPerangkat = document.getElementById("formPerangkat");
            const formMasukPerangkat = document.getElementById("formMasukPerangkat");

            togglePerangkatButton.addEventListener("click", function() {
                if (formPerangkat.style.display === "none") {
                    formPerangkat.style.display = "block";
                    formMasukPerangkat.style.display = "block";
                } else {
                    formPerangkat.style.display = "none";
                    formMasukPerangkat.style.display = "none";
                }
            });
        });
    </script>s
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
    </script>
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/signature_pad.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery-3.3.1.slim.min.js') }}"></script>
    <script>
        function showFileName() {
            var input = document.getElementById("gambar");
            var label = document.getElementById("selfie");
            var imageName = document.getElementById("image-name"); // Tambahkan ini

            if (input.files.length > 0) {
                label.innerText = input.files[0].name;
                imageName.innerText = "Foto berhasil terpilih, silahkan lanjutkan."; // Tambahkan ini
            } else {
                label.innerText = "Ambil Foto";
                imageName.innerText = ""; // Kosongkan nama gambar jika tidak ada yang dipilih
            }
        }
    </script>
@endsection

@extends('admin.app')
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form method="POST" action="{{ route('adding.vm') }}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Tambah Virtual Machine</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label">Cluster</label>
                                <div class="col">
                                    <select name="cluster" class="form-select">
                                        <option>Pilih Cluster</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>PDN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Virtual Machine</label>
                                <div class="col">
                                    <input type="text" name="vm" class="form-control"
                                        placeholder="Masukkan Nama VM">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Operating System</label>
                                <div class="col">
                                    <input type="text" name="os" class="form-control"
                                        placeholder="Masukkan Jenis OS">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Server Node</label>
                                <div class="col">
                                    <input type="text" name="srv_node" class="form-control"
                                        placeholder="Masukkan Node Server">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">IP Public</label>
                                <div class="col">
                                    <input type="text" name="ip_public" class="form-control"
                                        placeholder="Masukkan Alamat IP Public">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">IP Private</label>
                                <div class="col">
                                    <input type="text" name="ip_private" class="form-control"
                                        placeholder="Masukkan Alamat IP Private">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Username</label>
                                <div class="col">
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Masukkan Pengguna">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Password</label>
                                <div class="col">
                                    <input type="text" name="password" class="form-control" placeholder="Masukkan Sandi">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Keterangan</label>
                                <div class="col">
                                    <input type="text" name="ket" class="form-control"
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
                        <h4 class="card-title py-1 mb-4">Petunjuk Penambahan Data Virtual Machine</h4>
                        <div class="mb-4 row">
                            <label for="">
                                1. <strong>Cluster:</strong>
                                Pilih atau masukkan nama cluster tempat virtual machine akan diimplementasikan, jika
                                berlaku.
                                Contoh: "Production Cluster" atau "Testing Cluster".
                                <br>
                                1. <strong>Virtual Machine:</strong>
                                Berikan nama unik untuk virtual machine yang akan dibuat.
                                Pastikan nama tersebut mencerminkan tujuan atau fungsionalitas virtual machine.
                                Contoh: "WebServer-01" atau "DatabaseVM".
                                <br>
                                2. <strong>Operating System:</strong>
                                Pilih sistem operasi yang akan diinstal pada virtual machine.
                                Contoh: "Ubuntu 20.04 LTS" atau "Windows Server 2019".
                                <br>
                                3. <strong>Server Node:</strong>
                                Pilih atau masukkan nama node server atau server fisik tempat virtual machine akan
                                dijalankan.
                                Contoh: "Node-1" atau "Server-A".
                                <br>
                                4. <strong>IP Public</strong>
                                Masukkan alamat IP publik yang akan digunakan untuk mengakses virtual machine dari internet
                                (jika berlaku).
                                Contoh: "103.156.88.xx".
                                <br>
                                5. <strong>IP Private:</strong>
                                Masukkan alamat IP privat yang akan digunakan untuk komunikasi internal dalam jaringan (jika
                                berlaku).
                                Contoh: "192.168.18.xx".
                                <br>
                                6. <strong>Username:</strong>
                                Pilih atau masukkan nama pengguna yang akan digunakan untuk mengakses virtual machine.
                                Pastikan nama pengguna memiliki hak akses yang sesuai.
                                Contoh: "admin" atau "user1".
                                <br>
                                7. <strong>Password:</strong>
                                Tentukan kata sandi yang kuat untuk keamanan akses ke virtual machine.
                                Pastikan kata sandi memenuhi kebijakan keamanan yang berlaku.
                                Contoh: "P@ssw0rd123".
                                <br>
                                8. <strong>Keterangan:</strong>
                                Berikan keterangan atau catatan tambahan yang diperlukan untuk menjelaskan atau
                                mengidentifikasi tujuan atau konfigurasi virtual machine.
                                Contoh: "Virtual machine ini digunakan sebagai server basis data untuk aplikasi XYZ."
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

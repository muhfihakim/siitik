@extends('admin.app')
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <form method="POST" action="admin/vm/{{ $vm->id }}">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title py-1 mb-4">Form Edit Virtual Machine</h4>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label">Cluster</label>
                                <div class="col">
                                    <select name="cluster" class="form-select" value="{{ $vm->cluster }}">
                                        <option>Pilih Cluster</option>
                                        <option value="1" @if ($vm->cluster == '1') selected @endif>1</option>
                                        <option value="2" @if ($vm->cluster == '2') selected @endif>2</option>
                                        <option value="PDN" @if ($vm->cluster == 'PDN') selected @endif>PDN
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Virtual Machine</label>
                                <div class="col">
                                    <input type="text" name="vm" class="form-control" placeholder="Masukkan Nama VM"
                                        value="{{ $vm->vm }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Operating System</label>
                                <div class="col">
                                    <input type="text" name="os" class="form-control"
                                        placeholder="Masukkan Jenis OS" value="{{ $vm->os }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Server Node</label>
                                <div class="col">
                                    <input type="text" name="srv_node" class="form-control"
                                        placeholder="Masukkan Node Server" value="{{ $vm->srv_node }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">IP Public</label>
                                <div class="col">
                                    <input type="text" name="ip_public" class="form-control"
                                        placeholder="Masukkan Alamat IP Public" value="{{ $vm->ip_public }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">IP Private</label>
                                <div class="col">
                                    <input type="text" name="ip_private" class="form-control"
                                        placeholder="Masukkan Alamat IP Private" value="{{ $vm->ip_private }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Username</label>
                                <div class="col">
                                    <input type="text" name="username" class="form-control"
                                        placeholder="Masukkan Pengguna" value="{{ $vm->username }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Password</label>
                                <div class="col">
                                    <input type="text" name="password" class="form-control" placeholder="Masukkan Sandi"
                                        value="{{ $vm->password }}">
                                </div>
                            </div>
                            <div class="mb-4 row">
                                <label class="col-3 col-form-label required">Keterangan</label>
                                <div class="col">
                                    <input type="text" name="ket" class="form-control"
                                        placeholder="Masukkan Keterangan" value="{{ $vm->ket }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="admin/vm" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-success">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

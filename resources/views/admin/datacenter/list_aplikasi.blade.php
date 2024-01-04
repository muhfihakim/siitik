@extends('admin.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/responsive.dataTables.min.css') }}">
    <script type="text/javascript" language="javascript" src="{{ asset('admin/assets/js/id.json') }}"></script>
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
@endsection
@section('content')
    <div class="content-header">
        <h5 class="content-title">Daftar Data Aplikasi</h5>
        <div class="ms-auto">
            <a href="{{ route('add.aplikasi') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="21"
                    height="21" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                    <path d="M14 7l6 0" />
                    <path d="M17 4l0 6" />
                </svg>
                <span class="ms-1">Tambah Aplikasi</span>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-light table-hover" id="myTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">IP LOOKUP</th>
                            <th scope="col">DOMAIN</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">KET</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $aplikasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $aplikasi->nama }}</td>
                                <td>{{ $aplikasi->ip_lookup }}</td>
                                <td><a href="https://{{ $aplikasi->domain }}">{{ $aplikasi->domain }}</td>
                                <td>{{ $aplikasi->status }}</td>
                                <td>{{ $aplikasi->keterangan }}</td>
                                <td class="text-nowrap">
                                    <form method="post" action="/admin/aplikasi/{{ $aplikasi->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-xs btn-primary"
                                            href="admin/aplikasi/{{ $aplikasi->id }}/editaplikasi">Edit</a>
                                        <button type="submit" class="btn btn-xs btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus aplikasi ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (session('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('message') }}",
            });
        </script>
    @endif
    <script src="{{ asset('admin/assets/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.responsive.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                language: {
                    "url": "{{ asset('admin/assets/js/id.json') }}"
                }
            });
        });
    </script>
@endsection

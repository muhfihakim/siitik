@extends('admin.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/responsive.dataTables.min.css') }}">
    <script type="text/javascript" language="javascript" src="{{ asset('admin/assets/js/id.json') }}"></script>
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
@endsection
@section('content')
    <div class="content-header">
        <h5 class="content-title">Daftar Data VM</h5>
        <div class="ms-auto">
            <a href="{{ route('add.vm') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cloud-plus" width="21"
                    height="21" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M12 18.004h-5.343c-2.572 -.004 -4.657 -2.011 -4.657 -4.487c0 -2.475 2.085 -4.482 4.657 -4.482c.393 -1.762 1.794 -3.2 3.675 -3.773c1.88 -.572 3.956 -.193 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99a3.46 3.46 0 0 1 3.085 1.9" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
                <span class="ms-1">Tambah VM</span>
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
                            <th scope="col">CLUSTER</th>
                            <th scope="col">VM</th>
                            <th scope="col">OS</th>
                            <th scope="col">SRV NODE</th>
                            <th scope="col">PUBLIC</th>
                            <th scope="col">PRIVATE(SSH)</th>
                            <th scope="col">USER</th>
                            <th scope="col">PWD</th>
                            <th scope="col">KET</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vm as $vm)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vm->cluster }}</td>
                                <td>{{ $vm->vm }}</td>
                                <td>{{ $vm->os }}</td>
                                <td>{{ $vm->srv_node }}</td>
                                <td>{{ $vm->ip_public }}</td>
                                <td><a href="ssh://{{ $vm->ip_private }}">{{ $vm->ip_private }}</a></td>
                                <td>{{ $vm->username }}</td>
                                <td>{{ $vm->password }}</td>
                                <td>{{ $vm->ket }}</td>
                                <td class="text-nowrap">
                                    <form method="post" action="/admin/vm/{{ $vm->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-xs btn-primary"
                                            href="admin/vm/{{ $vm->id }}/editvm">Edit</a>
                                        <button type="submit" class="btn btn-xs btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus vm ini?')">Delete</button>
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

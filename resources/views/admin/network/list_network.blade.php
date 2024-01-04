@extends('admin.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/responsive.dataTables.min.css') }}">
    <script type="text/javascript" language="javascript" src="{{ asset('admin/assets/js/id.json') }}"></script>
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
@endsection
@section('content')
    <div class="content-header">
        <h5 class="content-title">Daftar Data Jaringan</h5>
        <div class="ms-auto">
            <a href="{{ route('add.network') }}" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-world-plus" width="21"
                    height="21" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M20.985 12.518a9 9 0 1 0 -8.45 8.466" />
                    <path d="M3.6 9h16.8" />
                    <path d="M3.6 15h11.4" />
                    <path d="M11.5 3a17 17 0 0 0 0 18" />
                    <path d="M12.5 3a16.998 16.998 0 0 1 2.283 12.157" />
                    <path d="M16 19h6" />
                    <path d="M19 16v6" />
                </svg>
                <span class="ms-1">Tambah Jaringan</span>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                <table class="table table-light table-hover" id="myTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">LOKASI</th>
                            <th scope="col">JENIS</th>
                            <th scope="col">TITIK</th>
                            <th scope="col">KOORDINAT</th>
                            <th scope="col">BERITA ACARA</th>
                            <th scope="col">FOTO</th>
                            <th scope="col">TRKHR UPDATE</th>
                            <th scope="col">KET</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($network as $networking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $networking->lokasi }}</td>
                                <td>{{ $networking->jenis }}</td>
                                <td>{{ $networking->titik }}</td>
                                <td>
                                    <a href="https://www.google.com/maps?q={{ $networking->latitude }},{{ $networking->longitude }}"
                                        target="_blank" class="btn btn-xs btn-success">
                                        Maps
                                    </a>
                                </td>
                                <td> <a href="{{ asset('storage/' . $networking->ba) }}" target="_blank"
                                        class="btn btn-xs btn-warning">Lihat
                                        BA</a>
                                </td>
                                <td>
                                    @if ($networking->foto)
                                        <img src="{{ asset('storage/' . $networking->foto) }}" alt="Foto Titik"
                                            style="width: 100px; height: 60px;">
                                    @else
                                        Foto tidak tersedia
                                    @endif
                                </td>
                                <td>{{ $networking->updated_at->format('d-m-Y') }}</td>
                                <td>{{ $networking->description }}</td>
                                <td class="text-nowrap">
                                    <form method="post" action="/admin/network/{{ $networking->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-xs btn-primary"
                                            href="/admin/network/{{ $networking->id }}/editnetwork">Edit</a>
                                        <button type="submit" class="btn btn-xs btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus jaringan ini?')">Delete</button>
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

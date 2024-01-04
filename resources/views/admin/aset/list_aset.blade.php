@extends('admin.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/responsive.dataTables.min.css') }}">
    <script type="text/javascript" language="javascript" src="{{ asset('admin/assets/js/id.json') }}"></script>
    <script src={{ asset('admin/assets/js/sweetalert2@10.js') }}></script>
@endsection
@section('content')
    <div class="content-header">
        <h5 class="content-title">Daftar Data Aset</h5>
        <div class="ms-auto">
            <a href="{{ route('cetak.aset') }}" target="_blank" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="20"
                    height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                    <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                    <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                </svg>
                <span class="ms-1">Cetak Rekap Aset</span></a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div>
                <table class="table table-light table-hover" id="myTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">TYPE</th>
                            <th scope="col">S/N</th>
                            <th scope="col">TAHUN</th>
                            <th scope="col">KONDISI</th>
                            <th scope="col">LETAK</th>
                            <th scope="col">TRKHR. UPDATE</th>
                            <th scope="col">GAMBAR</th>
                            <th scope="col">KET</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aset as $asset)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $asset->nama }}</td>
                                <td>{{ $asset->type }}</td>
                                <td>{{ $asset->sn }}</td>
                                <td>{{ $asset->tahun }}</td>
                                <td>{{ $asset->kondisi }}</td>
                                <td>{{ $asset->letak }}</td>
                                <td>{{ $asset->updated_at->format('d-m-Y') }}</td>
                                <td>
                                    @if ($asset->gambar)
                                        <img src="{{ asset('storage/' . $asset->gambar) }}" alt="Gambar Aset"
                                            style="width: 100px; height: 60px;">
                                    @else
                                        Gambar tidak tersedia
                                    @endif
                                </td>
                                <td>{{ $asset->description }}</td>
                                <td class="text-nowrap">
                                    <form method="post" action="/admin/aset/{{ $asset->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-xs btn-primary"
                                            href="/admin/aset/{{ $asset->id }}/editaset">Edit</a>
                                        <button type="submit" class="btn btn-xs btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus aset ini?')">Delete</button>
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

@extends('admin.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/responsive.dataTables.min.css') }}">
    <script type="text/javascript" language="javascript" src="{{ asset('admin/assets/js/id.json') }}"></script>
@endsection
@section('content')
    <div class="content-header">
        <h5 class="content-title">Daftar Monitoring Aplikasi</h5>
        <div class="ms-auto">
            <form id="searchForm" class="ms-2">
                @csrf
                <div class="input-group">
                    <input class="form-control" type="text" name="search" placeholder="Cari...">
                    <button class="btn btn-success" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                    @foreach ($data as $aplikasi)
                        <div class="col mb-4">
                            <div
                                class="card {{ $aplikasi->score === 'Lambat/Offline'
                                    ? 'bg-danger'
                                    : ($aplikasi->score === 'Sedikit Bermasalah'
                                        ? 'bg-warning'
                                        : ($aplikasi->score < 70
                                            ? 'bg-warning'
                                            : ($aplikasi->score <= 80
                                                ? 'bg-success'
                                                : 'bg-primary'))) }}">
                                <div class="card-body d-flex align-items-center">
                                    <div>
                                        <div style="--bs-bg-opacity: .8;"
                                            class="w-12 h-12 bg-dark me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-brand-speedtest" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5.636 19.364a9 9 0 1 1 12.728 0" />
                                                <path d="M16 9l-4 4" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="">
                                            <small class="text-light">
                                            </small>
                                        </div>
                                        <div class="d-flex justify-content-end text-light">
                                            <span class="h3 mb-0 lh-1">{{ $aplikasi->score }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer py-3 bg-dark" style="--bs-bg-opacity: .3;">
                                    <a href="" class="text-decoration-none text-white">
                                        {{ $aplikasi->domain }} |
                                        {{ \Carbon\Carbon::parse($aplikasi->last_checked_at)->format('H:i') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div style="display: flex; justify-content: center;">
                <small><i>Update Score Per 30 Menit Sekali</i></small>
            </div>
            <div style="display: flex; justify-content: center;">
                {{ $data->links() }}
            </div>
        </div>
    @endsection
    @section('scripts')
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
        <script>
            $(document).ready(function() {
                $('#searchForm').submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        type: 'GET',
                        url: '/admin/aplikasi/monitoring/search',
                        data: formData,
                        success: function(data) {
                            // Membuka hasil pencarian di tab baru
                            var newWindow = window.open();
                            newWindow.document.write(data);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endsection

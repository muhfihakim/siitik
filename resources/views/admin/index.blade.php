@extends('admin.app')
@section('content')
    <main class="content container mx-auto">
        <div class="content-header">
            <h4 class="content-title ~mx-auto">Halo, Selamat Datang di Dashboard SI-ITIK!</h4>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div
                                    class="w-12 h-12 bg-success me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-network"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 9m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" />
                                        <path d="M12 3c1.333 .333 2 2.333 2 6s-.667 5.667 -2 6" />
                                        <path d="M12 3c-1.333 .333 -2 2.333 -2 6s.667 5.667 2 6" />
                                        <path d="M6 9h12" />
                                        <path d="M3 19h7" />
                                        <path d="M14 19h7" />
                                        <path d="M12 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M12 15v2" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1">
                                    <span class="text-secondary">Total Titik Jaringan</span>
                                </div>
                                <span class="h3 mb-0 lh-1">{{ $totalNetwork }}</span>
                            </div>
                        </div>
                        <div class="card-footer py-3">
                            <a href="{{ route('index.network') }}" class="text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div
                                    class="w-12 h-12 bg-primary me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-server-2"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M3 4m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                        <path
                                            d="M3 12m0 3a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v2a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3z" />
                                        <path d="M7 8l0 .01" />
                                        <path d="M7 16l0 .01" />
                                        <path d="M11 8h6" />
                                        <path d="M11 16h6" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1">
                                    <span class="text-secondary">Total Virtual Machine</span>
                                </div>
                                <span class="h3 mb-0 lh-1">{{ $totalVM }}</span>
                            </div>
                        </div>
                        <div class="card-footer
                                    py-3">
                            <a href="{{ route('index.vm') }}" class="text-decoration-none">Lihat
                                Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div
                                    class="w-12 h-12 bg-info me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-devices"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M13 9a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1v-10z" />
                                        <path d="M18 8v-3a1 1 0 0 0 -1 -1h-13a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h9" />
                                        <path d="M16 9h2" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1">
                                    <span class="text-secondary">Total Aset</span>
                                </div>
                                <span class="h3 mb-0 lh-1">{{ $totalAset }}</span>
                            </div>
                        </div>
                        <div class="card-footer py-3">
                            <a href="{{ route('index.aset') }}" class="text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div
                                    class="w-12 h-12 bg-primary me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-video"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" />
                                        <path
                                            d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1">
                                    <span class="text-secondary">Total Permohonan Virtual Meet</span>
                                </div>
                                <span class="h3 mb-0 lh-1">{{ $totalVirtualMeet }}</span>
                            </div>
                        </div>
                        <div class="card-footer py-3">
                            <a href="{{ route('index.virtualmeet') }}" class="text-decoration-none">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div
                                    class="w-12 h-12 bg-warning me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users-group"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                        <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                        <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1">
                                    <span class="text-secondary">Total Kunjungan Datacenter</span>
                                </div>
                                <span class="h3 mb-0 lh-1">{{ $totalPresensiDC }}</span>
                            </div>
                        </div>
                        <div class="card-footer
                                    py-3">
                            <a href="{{ route('index.presensi') }}" class="text-decoration-none">Lihat
                                Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <div
                                    class="w-12 h-12 bg-secondary me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps"
                                        width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path
                                            d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path
                                            d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path d="M14 7l6 0" />
                                        <path d="M17 4l0 6" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="mb-1">
                                    <span class="text-secondary">Total Aplikasi</span>
                                </div>
                                <span class="h3 mb-0 lh-1">{{ $totalAplikasi }}</span>
                            </div>
                        </div>
                        <div class="card-footer
                                    py-3">
                            <a href="{{ route('index.aplikasi') }}" class="text-decoration-none">Lihat
                                Detail</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
<script disable-devtool-auto src='{{ asset('admin/assets/js/protected.js') }}'></script>

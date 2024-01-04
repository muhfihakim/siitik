        <nav class="navbar navbar-expand-lg bg-white shadow">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#navbarMenuCollapse" aria-controls="navbarMenuCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2 w-5 h-5"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                </button>
                <a href="" class="navbar-brand hidden-dark">
                    <img src="{{ asset('admin/assets/img/logo.svg') }}" width="136px">
                </a>
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav nav-tabs mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-signal"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M15 22v-2" />
                                    <path d="M18 22v-4" />
                                    <path d="M21 22v-6" />
                                    <path d="M19 12.494v-.494h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v.5" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-server-2"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                <span>Datacenter</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('add.vm') }}">
                                        <span>Tambah VM</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index.vm') }}">
                                        <span>Daftar VM</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('add.aplikasi') }}">
                                        <span>Tambah Aplikasi</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index.aplikasi') }}">
                                        <span>Daftar Aplikasi</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('monitoring.aplikasi') }}">
                                        <span>Monitoring Aplikasi</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" target="_blank"
                                        href="{{ route('form.presensi.pusatdata') }}">
                                        <span>Form Presensi</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index.presensi') }}">
                                        <span>Daftar Kunjungan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-network"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                                <span>Network</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('add.network') }}">
                                        <span>Tambah Jaringan</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index.network') }}">
                                        <span>Daftar Jaringan</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('form.instalasi.network') }}">
                                        <span>Formulir Instalasi</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-brand-zoom" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M17.011 9.385v5.128l3.989 3.487v-12z" />
                                    <path
                                        d="M3.887 6h10.08c1.468 0 3.033 1.203 3.033 2.803v8.196a.991 .991 0 0 1 -.975 1h-10.373c-1.667 0 -2.652 -1.5 -2.652 -3l.01 -8a.882 .882 0 0 1 .208 -.71a.841 .841 0 0 1 .67 -.287z" />
                                </svg>
                                <span>Virtual Meet</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" target="_blank" href="{{ route('form.virtualmeet') }}">
                                        <span>Form Permohonan</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index.virtualmeet') }}">
                                        <span>Daftar Permohonan</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('convert.link') }}">
                                        <span>Konversi Link</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-devices"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M13 9a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1v-10z" />
                                    <path d="M18 8v-3a1 1 0 0 0 -1 -1h-13a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h9" />
                                    <path d="M16 9h2" />
                                </svg>
                                <span>Aset</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('add.aset') }}">
                                        <span>Tambah Aset</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('index.aset') }}">
                                        <span>Daftar Aset</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="navbar-right">
                    <ul class="navbar-nav nav-tabs ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon-tabler icon-tabler-bell"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6">
                                    </path>
                                    <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                                </svg>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">#SATUKAN NEGERI</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-avatar" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="ms-1 d-none d-md-block">{{ Auth::user()->name }} |
                                    {{ Auth::user()->role }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-user-square-rounded" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" />
                                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                    <path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" />
                                </svg>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 icon icon-tabler icon-tabler-logout" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2">
                                            </path>
                                            <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                                        </svg>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

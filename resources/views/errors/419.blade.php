@extends('admin.app2')
@section('content')
    <div class="content-body">
        <div class="d-flex  align-items-center">
            <div class="content container max-w-md">
                <div class="display-1 text-secondary">419</div>
                <h3>Oops… <br />Halaman kadaluwarsa :(</h3>
                <p class="text-secondary">SI - ITIK by M. L. Hakim</p>
                <div>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 me-2 icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <line x1="5" y1="12" x2="11" y2="18"></line>
                            <line x1="5" y1="12" x2="11" y2="6"></line>
                        </svg>
                        <span>Take me home</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.app')
@section('css')
    <script src="{{ asset('admin/assets/js/jquery-3.7.0.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
@endsection
@section('content')
    <div class="content-header">
        <h4 class="content-title ~mx-auto">Empty</h4>
    </div>
    <div class="content-body">
        <div class="card">
            <div class="card-body">
                <p class="mb-0">Empty content</p>
            </div>
        </div>
    </div>
@endsection

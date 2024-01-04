@extends('admin.app')
@section('content')
    <style>
        #zoomText {
            width: 100%;
            max-width: 100%;
            resize: vertical;
            /* Memungkinkan pengguna untuk merubah tinggi textarea */
        }
    </style>
    <div class="content-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title py-1 mb-4" style="text-align: center">Konversi Format Virtual Meeting</h4>
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if (isset($hasilKonversi))
                            <label>{!! nl2br(e($hasilKonversi)) !!}</label>
                            <a class="btn btn-success" href="https://wa.me/6285974363719?text={{ urlencode($hasilKonversi) }}"
                                target="_blank">Kirim
                                ke WhatsApp</a>
                        @endif
                        <form method="post" action="{{ route('convert') }}">
                            <br>
                            @csrf
                            <label for="zoomText" class="form-label">Masukkan Teks Undangan Virtual Meeting</label><br>
                            <textarea placeholder="Paste Zoom Meeting Invitation" id="zoomText" name="zoomText" rows="10" cols="50"></textarea><br>
                            <button type="submit" class="btn btn-primary">Konversikan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="card-title py-1 mb-4">Petunjuk Penggunaan Konversi Link</h4>
                        <div class="mb-4 row">
                            <label for="">1. Buat schedule zoom meeting terlebih dahulu.</label>
                            <label for="">2. Copy to Clipboard di dalam zoom meeting invitation.</label>
                            <label for="">3. Klik Konversikan, maka akan berformat secara otomatis.</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

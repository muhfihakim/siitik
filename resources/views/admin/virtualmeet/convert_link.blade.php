@extends('admin.app3')
@section('content')
    <style>
        #zoomText {
            width: 100%;
            max-width: 100%;
            resize: vertical;
            /* Memungkinkan pengguna untuk merubah tinggi textarea */
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
                                target="_blank">Kirim ke WhatsApp</a>
                            <a class="btn btn-info" href="#" id="kirimKeTelegram">Kirim ke Telegram</a>
                        @else
                            <p>Tidak ada hasil konversi yang tersedia.</p>
                        @endif
                        <form method="post" action="{{ route('convert2') }}">
                            <br>
                            @csrf
                            <label for="zoomText" class="form-label required">Masukkan Teks Undangan Virtual
                                Meeting</label><br>
                            <textarea placeholder="Paste Zoom Meeting Invitation" id="zoomText" name="zoomText" rows="10" cols="50"></textarea><br>
                            <div class="mb-4 row">
                                <div class="col">
                                    <label for="penyelenggara" class="form-label required">Penyelenggara</label>
                                    <input type="text" name="penyelenggara" class="form-control" id="penyelenggara"
                                        placeholder="Masukkan Nama Instansi/OPD">
                                </div>
                            </div>

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
@endsection

@section('scripts')
    <script>
        document.getElementById('kirimKeTelegram').addEventListener('click', function(event) {
            event.preventDefault();
            // Kirim ke Telegram
            var message = {!! isset($hasilKonversi) ? json_encode($hasilKonversi) : "''" !!}; // Pesan yang akan dikirim
            var chatId = '-1002022996344'; // Ganti dengan ID obrolan Anda
            var replyId = 23; // ID pesan yang akan dijawab
            var penyelenggara = document.getElementById('penyelenggara')
                .value; // Ambil nilai penyelenggara dari form

            // Masukkan nilai penyelenggara ke dalam teks undangan
            message = message.replace('*Penyelenggara* :', '*Penyelenggara* : ' + penyelenggara);

            // Request AJAX untuk mengirim pesan ke Telegram
            var xhr = new XMLHttpRequest();
            xhr.open("POST",
                "https://api.telegram.org/bot6618616283:AAFXVsUqxD5r7Rw9mLd4_uV1mGFiIiG_o6U/sendMessage",
                true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Pesan berhasil terkirim
                    alert('Undangan berhasil dikirim ke Telegram.');
                } else {
                    // Pesan gagal terkirim
                    alert('Undangan berhasil dikirim ke Telegram.');
                }
            };
            var data = JSON.stringify({
                "chat_id": chatId,
                "text": message,
                "reply_to_message_id": replyId
            });
            xhr.send(data);
        });
    </script>
@endsection

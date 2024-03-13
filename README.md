# **🌿Sistem Informasi Infrastruktur dan TIK🌿**

👨‍💻 M. L. Hakim
🌏 Laravel 9
🍍 Subang - Jabar |
Instagram : [/@luthfikim](https://www.instagram.com/luthfikim_/)
YouTube : [/@nexted](https://www.youtube.com/@nexted23)

# Konfigurasi Aplikasi

## Daftar Berkas Konfigurasi

-   `.env.example`: Berkas konfigurasi database untuk aplikasi. Ganti nama menjadi `.env`

## Penggunaan

Sebelum menjalankan atau menggunakan aplikasi ini, pastikan Anda telah mengkonfigurasi berkas `.env` dengan benar. Berikut adalah langkah-langkah yang perlu Anda lakukan:

1. Sesuaikan informasi (DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
2. Lakukan `php artisan migrate`.

## Konfigurasi BOT Telegram

Masukkan Token Telegram di .env baris terakhir

## Daftar Penggunaan BOT Telegram

1. app-> Console-> Commands-> CheckWebsiteStatus.php
2. app-> Http-> Controllers-> PermohonanVirtualMeetController.php
3. app-> Http-> Controllers-> PresensiDCController.php
4. app-> Http-> Controllers-> SesiController.php
5. resources-> views-> virtualmeet-> convert_link.blade.php

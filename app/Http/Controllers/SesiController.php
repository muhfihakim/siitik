<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram;

class SesiController extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            // Ambil user yang berhasil login
            $user = Auth::user();

            // Kirim notifikasi ke Telegram
            $this->sendTelegramNotification($user->name, $user->name, $user->role, $user->chat_id);

            return redirect('dash');
        } else {
            return redirect('')->withErrors('Username / Password Tidak Sesuai')->withInput();
        }
    }

    private function sendTelegramNotification($username, $name, $role, $chatId)
    {
        // Notifikasi ke Telegram
        $message = "*Halo Tim!*\n" .
            "=============================\n" .
            "*Ada Pengguna yang Berhasil Login.*\n" .
            "=============================\n" .
            "\n" .
            "Nama: *{$name}*\n" .
            "Jabatan: *{$role}*\n" .
            "\n" .
            "=============================\n" .
            "_Notifikasi Realtime Dari BOT SI-ITIK_\n" .
            "=============================";

        Telegram::sendMessage([
            'chat_id' => '-1002022996344',
            'text' => $message,
            'parse_mode' => 'Markdown',
            'reply_to_message_id' => 34,
        ]);
    }


    function logout()
    {
        // Ambil informasi pengguna sebelum logout
        $user = Auth::user();

        // Lakukan logout
        Auth::logout();

        // Kirim notifikasi ke Telegram
        $this->sendTelegramLogoutNotification($user->name, $user->role, $user->chat_id);

        return redirect('');
    }

    private function sendTelegramLogoutNotification($name, $role, $chatId)
    {
        // Notifikasi ke Telegram
        $message = "*Halo Tim!*\n" .
            "=============================\n" .
            "*Ada Pengguna yang Berhasil Logout.*\n" .
            "=============================\n" .
            "\n" .
            "Nama: *{$name}*\n" .
            "Jabatan: *{$role}*\n" .
            "\n" .
            "=============================\n" .
            "_Notifikasi Realtime Dari BOT SI-ITIK_\n" .
            "=============================";

        Telegram::sendMessage([
            'chat_id' => '-1002022996344',
            'text' => $message,
            'parse_mode' => 'Markdown',
            'reply_to_message_id' => 34,
        ]);
    }
}

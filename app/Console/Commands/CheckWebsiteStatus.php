<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Aplikasi;
use Telegram\Bot\Laravel\Facades\Telegram;

class CheckWebsiteStatus extends Command
{
    protected $signature = 'check:website-speed';
    protected $description = 'Check website speed using Google PageSpeed Insights API';

    public function handle()
    {
        // Dapatkan semua domain dari database
        $aplikasis = Aplikasi::all();
        $results = [];

        foreach ($aplikasis as $aplikasi) {
            $url = $aplikasi->domain;
            $apiKey = 'AIzaSyAlT1ezwfBTb2fP5VVwfQ_7NemblvkvVfc';

            try {
                // Create API URL with website URL and API key
                $apiUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=https://{$url}&key={$apiKey}";

                // Make an HTTP request to the PageSpeed Insights API with extended timeout (60 seconds)
                $response = Http::timeout(60)->get($apiUrl);

                // Get data from the JSON response
                $data = $response->json();

                if (isset($data['error'])) {
                    $errorCode = $data['error']['code'] ?? null;
                    $errorMessage = $data['error']['message'] ?? null;

                    if ($errorCode === 400 && strpos($errorMessage, 'FAILED_DOCUMENT_REQUEST') !== false) {
                        $this->info("Website is offline: $url");
                        $aplikasi->update(['score' => 'Lambat/Offline']);
                        $this->sendTelegramNotification($aplikasi, "Peringatan Website {$aplikasi->domain} Offline");
                    } elseif (strpos($errorMessage, 'NO_FCP') !== false) {
                        $this->info("Website did not paint any content (NO_FCP) for $url");
                        $aplikasi->update(['score' => 'Sedikit Bermasalah']);
                        $this->sendTelegramNotification($aplikasi, "Peringatan Website {$aplikasi->domain} Did not paint any content (NO_FCP)");
                    } else {
                        $this->error("Error checking speed for $url: $errorMessage");
                    }
                } else {
                    // No error, continue with processing the response
                    $performanceScore = $data['lighthouseResult']['categories']['performance']['score'] ?? null;

                    // Check if the response has an error field related to NO_FCP
                    if (isset($data['error']) && strpos($data['error']['message'], 'NO_FCP') !== false) {
                        $this->info("Website did not paint any content (NO_FCP) for $url");
                        // Uncomment the line below if you want to update the status in the database
                        $aplikasi->update(['score' => 'Sedikit Bermasalah']);
                    } elseif ($performanceScore !== null) {
                        // No error, continue with processing the response
                        // Multiply the performance score by 100 and cast it to an integer
                        $performanceScore = (int) ($performanceScore * 100);

                        $this->info("Website Speed for $url: $performanceScore");

                        // Update the last_checked_at and latency columns in the database
                        $aplikasi->update([
                            'last_checked_at' => now(),
                            'score' => $performanceScore,
                        ]);

                        // Cek perubahan status dan kirim notifikasi jika diperlukan
                        $this->checkAndSendNotification($aplikasi, $performanceScore);
                    }
                }
            } catch (\Exception $e) {
                // Handle exceptions if there is an error in the HTTP request or JSON parsing
                $this->error("Error checking speed for $url: " . $e->getMessage());
            }
        }
        $this->info('Website speed checked successfully.');
    }

    protected function sendTelegramNotification($aplikasi, $message)
    {
        $chatId = '-1002022996344';
        $inlineKeyboard = [];

        $formattedMessage = "*Halo Tim!*\n" .
            "=============================\n" .
            "*Informasi Aplikasi/Website.*\n" .
            "=============================\n" .
            "\n" .
            "Nama   : *{$aplikasi->nama}*\n" .
            "Domain : *{$aplikasi->domain}*\n" .
            "Score  : *{$aplikasi->score}*\n" .
            "\n" .
            "=============================\n" .
            "_Notifikasi Realtime Dari BOT SI-ITIK_\n" .
            "=============================";

        try {
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $formattedMessage,
                'parse_mode' => 'Markdown',
                'reply_markup' => json_encode(['inline_keyboard' => $inlineKeyboard]),
                'reply_to_message_id' => 110,
            ]);
        } catch (\Exception $e) {
            $this->error("Error sending Telegram notification: " . $e->getMessage());
        }
    }

    protected function checkAndSendNotification($aplikasi, $performanceScore)
    {
        // Ambil status terakhir dari database
        $lastStatus = $aplikasi->status;

        // Cek perubahan status
        if ($lastStatus < 70 && $performanceScore >= 70) {
            // Status awalnya di bawah 70, sekarang di atas atau sama dengan 70
            $this->sendTelegramNotification($aplikasi, "Website {$aplikasi->domain} Kembali Online!");
        }

        // Cek jika skor di bawah 65 dan kirim notifikasi
        if ($performanceScore < 65) {
            $this->sendTelegramNotification($aplikasi, "Peringatan Website {$aplikasi->domain} Sedikit Bermasalah!");
        }
    }
}

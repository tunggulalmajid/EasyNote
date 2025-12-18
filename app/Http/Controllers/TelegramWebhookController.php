<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // 1. Ambil semua data yang dikirim Telegram
        $updates = $request->all();

        // 2. Cek apakah ini pesan teks biasa
        if (isset($updates['message'])) {
            $message = $updates['message'];
            $chatId = $message['chat']['id'];
            $username = $message['from']['first_name'] ?? 'User';

            // Logika Balasan (Auto Reply Chat ID)
            $token = env('TELEGRAM_BOT_TOKEN');

            $replyText = "Halo <b>{$username}</b>! 👋\n\n";
            $replyText .= "ID Telegram kamu adalah: <code>{$chatId}</code>\n\n";
            $replyText .= "Salin angka di atas dan masukkan ke menu 'Hubungkan Telegram' di aplikasi EasyNote.";

            try {
                // Kirim balasan via API Telegram
                Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                    'chat_id' => $chatId,
                    'text' => $replyText,
                    'parse_mode' => 'HTML'
                ]);
            } catch (\Exception $e) {
                Log::error("Gagal kirim telegram: " . $e->getMessage());
            }
        }

        // 3. Wajib return OK agar Telegram tahu pesan sudah diterima
        return response()->json(['status' => 'ok']);
    }
}

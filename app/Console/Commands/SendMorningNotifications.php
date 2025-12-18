<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Tasklist;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class SendMorningNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:morning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim notifikasi kegiatan dan tugas harian ke Telegram User (HTML Mode)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai pengiriman notifikasi pagi (HTML Mode)...');

        // 1. Ambil user yang punya Chat ID Telegram
        $users = User::whereNotNull('telegram_chat_id')->get();

        if ($users->isEmpty()) {
            $this->info('Tidak ada user yang terhubung ke Telegram.');
            return;
        }

        $token = env('TELEGRAM_BOT_TOKEN');
        $today = Carbon::today(); // Jam 00:00:00 hari ini

        foreach ($users as $user) {
            $this->info("Memproses user: {$user->name}");

            // ==========================================
            // PESAN 1: KEGIATAN (Jadwal HARI INI)
            // ==========================================
            $kegiatan = Kegiatan::where('user_id', $user->id)
                ->whereDate('tanggal', $today)
                ->orderBy('waktu', 'asc')
                ->get();

            if ($kegiatan->count() > 0) {
                // Gunakan tag HTML <b> untuk tebal
                $msg1 = "📅 <b>Jadwal Kegiatan Hari Ini</b>\n";
                $msg1 .= "Halo {$user->name}, berikut agenda kamu:\n\n";

                foreach ($kegiatan as $agenda) {
                    $jam = Carbon::parse($agenda->waktu)->format('H:i');
                    $msg1 .= "⏰ {$jam} - <b>{$agenda->kegiatan}</b>\n";
                }

                $msg1 .= "\nNotifikasi Ini dibuat Oleh EasyNote";

                $this->sendTelegramMessage($user->telegram_chat_id, $msg1, $token);
            }

            // ==========================================
            // PESAN 2: TUGAS (Deadline s/d 5 Hari ke Depan & Overdue)
            // ==========================================

            // Batas waktu: Hari ini + 5 Hari
            $futureDate = $today->copy()->addDays(5);

            $tasks = Tasklist::where('user_id', $user->id)
                ->where('status_id', '!=', 3) // Hanya yang belum selesai (Asumsi ID 3 = Done)
                ->whereDate('deadline', '<=', $futureDate) // Filter: Kurang dari 5 hari ke depan
                ->orderBy('deadline', 'asc')
                ->get();

            if ($tasks->count() > 0) {
                $msg2 = "⚡ <b>Update Tugas</b>\n";
                $msg2 .= "Daftar tugas yang harus dipantau:\n\n";

                foreach ($tasks as $task) {
                    $deadline = Carbon::parse($task->deadline);

                    // Normalisasi ke jam 00:00 agar hitungan hari akurat
                    $deadlineDate = $deadline->copy()->startOfDay();
                    $todayDate    = $today->copy()->startOfDay();

                    // --- LOGIKA ICON WARNA ---
                    if ($deadlineDate->lt($todayDate)) {
                        // Jika tanggal deadline < hari ini (Masa Lalu)
                        $icon = '🔴';
                    } elseif ($deadlineDate->diffInDays($todayDate) <= 2) {
                        // Jika selisih hari <= 2 (Hari ini, Besok, Lusa)
                        $icon = '🟡';
                    } else {
                        // Selain itu (Masih lama / 3-5 hari lagi)
                        $icon = '🟢';
                    }
                    // -------------------------

                    $timeStr = $deadline->format('d M H:i');

                    // Format Pesan HTML
                    $msg2 .= "{$icon} <b>{$task->task}</b>\n";
                    $msg2 .= "     └ <i>Deadline: {$timeStr}</i>\n";
                }

                // Link Dashboard (HTML Anchor Tag)
                $url = route('dashboard');
                $msg2 .= "\n👉Buka Aplikasi EasyNote Sekarang : " . $url;

                $msg2 .= "\n\nNotifikasi Ini dibuat Oleh EasyNote";


                $this->sendTelegramMessage($user->telegram_chat_id, $msg2, $token);
            }
        }

        $this->info('Selesai.');
    }

    /**
     * Helper Kirim Telegram dengan Parse Mode HTML
     */
    private function sendTelegramMessage($chatId, $text, $token)
    {
        try {
            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $text,
                'parse_mode' => 'HTML', // PENTING: Agar tag <b> dan <a> berfungsi
                'disable_web_page_preview' => true, // Opsional: Agar tidak muncul preview link website
            ]);
        } catch (\Exception $e) {
            $this->error("Gagal kirim: " . $e->getMessage());
        }
    }
}

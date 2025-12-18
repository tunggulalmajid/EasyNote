<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Tasklist; // Sesuaikan nama model Tugas Anda
use App\Models\Catatan;  // Sesuaikan nama model Catatan
use App\Models\Kegiatan; // Sesuaikan nama model Kegiatan (jika ada)

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $today = Carbon::today();

        // === 1. STATISTIK ===
        $stats = [
            'total_tugas'   => Tasklist::where('user_id', $userId)->count(),
            // Asumsi status_id 3 adalah 'Selesai/Done'. Sesuaikan jika beda.
            'tugas_pending' => Tasklist::where('user_id', $userId)->where('status_id', '!=', 3)->count(),
            'total_catatan' => Catatan::where('user_id', $userId)->count(),
            // Jika Anda punya model Kegiatan
            'kegiatan_today'=> Kegiatan::where('user_id', $userId)->whereDate('tanggal', $today)->count(),
        ];

        // === 2. TUGAS PRIORITAS (Deadline Terdekat & Belum Selesai) ===
        $prioritas_tugas = Tasklist::with(['category', 'status'])
            ->where('user_id', $userId)
            ->where('status_id', '!=', 3) // Hanya yang belum selesai
            ->whereDate('deadline', '>=', $today) // Deadline hari ini atau masa depan
            ->orderBy('deadline', 'asc')
            ->limit(5)
            ->get();

        // Transform data tugas untuk badge waktu (mirip logic index tugas)
        $prioritas_tugas->transform(function ($item) {
            $deadline = Carbon::parse($item->deadline)->startOfDay();
            $now = Carbon::now()->startOfDay();
            $diff = $now->diffInDays($deadline, false);

            if ($diff == 0) {
                $item->waktu_text = 'Hari ini!';
                $item->waktu_class = 'text-amber-400 bg-amber-900/30 border-amber-700';
            } elseif ($diff > 0) {
                $item->waktu_text = $diff . ' hari lagi';
                $item->waktu_class = 'text-emerald-400 bg-emerald-900/30 border-emerald-700';
            } else {
                $item->waktu_text = 'Terlewat';
                $item->waktu_class = 'text-red-400 bg-red-900/30 border-red-700';
            }
            return $item;
        });

        // === 3. JADWAL HARI INI ===
        $jadwal_hari_ini = Kegiatan::where('user_id', $userId)
            ->whereDate('tanggal', $today)
            ->orderBy('waktu', 'asc')
            ->get();

        // === 4. CATATAN TERBARU ===
        $catatan_terbaru = Catatan::where('user_id', $userId)
            ->latest()
            ->limit(4)
            ->get();

        return view('Dashboard', compact('stats', 'prioritas_tugas', 'jadwal_hari_ini', 'catatan_terbaru'));
    }
}

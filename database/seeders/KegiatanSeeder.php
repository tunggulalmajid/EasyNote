<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Kegiatan::create([
            'kegiatan' => 'Rapat Evaluasi Tim',
            'tanggal' => '2025-12-20', // Format YYYY-MM-DD
            'waktu' => '09:00:00',     // Format HH:MM:SS
            'deskripsi' => 'Membahas target pencapaian Q4 dan rencana tahun depan.',
            'user_id' => $user->id,
            'status' => 1,
        ]);

        // Kegiatan 2 (Hari Ini - Contoh)
        Kegiatan::create([
            'kegiatan' => 'Olahraga Pagi',
            'tanggal' => now()->format('Y-m-d'),
            'waktu' => '06:30:00',
            'deskripsi' => 'Jogging keliling komplek selama 30 menit.',
            'user_id' => $user->id,
            'status' => 1,

        ]);
    }
}

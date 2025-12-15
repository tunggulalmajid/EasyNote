<?php

namespace Database\Seeders;

use App\Models\catatan;
use App\Models\Category;
use App\Models\Status;
use App\Models\Tasklist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    // 2. Panggil Seeder Lainnya (Berurutan)
    $this->call([
        CategorySeeder::class,  // Membuat Category ID 1
        StatusSeeder::class,    // Membuat Status ID 1
        TasklistsSeeder::class, // Aman, karena User ID 1, Category ID 1, & Status ID 1 sudah ada
        CatatanSeeder::class,
    ]);

    // // 1. BUAT USER (Simpan hasilnya ke variabel)
    //     $user = User::create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //         'password' => bcrypt('password'),
    //     ]);

    //     // 2. BUAT KATEGORI (Simpan hasilnya ke variabel)
    //     $kategori = Category::create([
    //         'category' => 'Pendidikan',
    //         'user_id' => $user->id,

    //     ]);

    //     // 3. BUAT STATUS (Simpan hasilnya ke variabel)
    //     $status = Status::create([
    //         'status' => 'Pending',

    //     ]);
    //     $catatan = catatan::create([
    //         'judul' => 'Catatan Metopen',
    //         'konten' => 'sebuah catatan untuk mata kuliah metopen',
    //         'user_id' => $user->id,
    //     ]);

    //     // 4. BUAT TASKLIST
    //     // Kita pakai ID asli dari variabel di atas ($user->id, $kategori->id, dst)
    //     // JANGAN pakai angka 1 manual.
    //     Tasklist::create([
    //         'task' => "Tugas Metopen",
    //         'deadline' => "2025-11-25 00:00:00",
    //         'user_id' => $user->id,       // Mengambil ID user yang baru dibuat
    //         'category_id' => $kategori->id, // Mengambil ID kategori yang baru dibuat
    //         'status_id' => $status->id,   // Mengambil ID status yang baru dibuat
    //     ]);
    }
}

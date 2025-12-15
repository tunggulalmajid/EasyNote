<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Status;
use App\Models\tasklist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasklistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::first();
        $category = Category::first();
        $status = Status::first();

        if (!$user || !$category || !$status) {
            $this->command->error('Error: Data User, Category, atau Status kosong. Harap isi Seeder induk dulu.');
            return;
        }

        Tasklist::create([
            'task' => "Tugas Metopen",
            'deadline' => "2025-11-25 00:00:00",
            'user_id' => $user->id,         // Pakai ID user yang ditemukan
            'category_id' => $category->id, // Pakai ID kategori yang ditemukan
            'status_id' => $status->id      // Pakai ID status yang ditemukan
        ]);

    }
}

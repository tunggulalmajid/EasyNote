<?php

namespace Database\Seeders;

use App\Models\tasklist;
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
        DB::table('tasklist')->insert([
            'task' => "Tugas Metopen",
            'deadline' => "2025-11-25",
            'waktu' => '23:59',
            'user_id' => 1,
            'category_id' => 1,
            'status_id' => 1
        ]);
        DB::table('tasklist')->insert([
            'task' => "Tugas UI/UX",
                'deadline' => "2025-11-25",
                'waktu' => '23:59',
                'user_id' => 1,
                'category_id' => 1,
                'status_id' => 1
        ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status')->insert([
            'status' => 'Belum Dikerjakan'
        ]);

        DB::table('status')->insert([
            'status' => 'Sedang Dikerjakan'
        ]);

        DB::table('status')->insert([
            'status' => 'Selesai Dikerjakan'
        ]);
    }
}

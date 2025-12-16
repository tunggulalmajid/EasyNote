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
       $data = ['Belum', 'Proses', 'Selesai'];

        foreach ($data as $status) {
            Status::create([
                'status' => $status
            ]);
        }
    }
}

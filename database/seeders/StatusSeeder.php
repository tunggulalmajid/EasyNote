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
        status::create([
            'status' => 'Belum'
        ],
        [
            'status' => 'Proses'
        ],
        [
            'status' => 'Selesai'
        ],
    );
    }
}

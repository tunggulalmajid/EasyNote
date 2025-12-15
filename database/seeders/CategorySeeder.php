<?php

namespace Database\Seeders;

use App\Models\category;
use Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        category::create([
            'category' => 'Tugas Metopen',
            'user_id'=>1,
        ],
        [
            'category' => 'Tugas PWEB',
            'user_id'=>1,
        ],
        [
            'category' => 'Tugas PBM',
            'user_id'=>1,
        ]

    );
    }
}


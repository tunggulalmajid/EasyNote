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
        DB::table('categories')->insert([
            'category' => 'Tugas Kuliah'
        ]);

        DB::table('categories')->insert([
            'category' => 'Tugas Umum'
        ]);

        DB::table('categories')->insert([
            'category' => 'Jobdesk Kerja'
        ]);
    }
}


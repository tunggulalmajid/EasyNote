<?php

namespace Database\Seeders;

use App\Models\catatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        catatan::create([
            'judul' => 'Catatan Metopen',
            'konten' => 'sebuah catatan untuk mata kuliah metopen',
            'user_id' => 1,

        ]);
    }
}

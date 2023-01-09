<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materi::create([
            "judul" => "Bahan Ajar Software Engineering",
            "deskripsi" => fake()->paragraph(2, true),
            "minggu_ke" => "Minggu Ke 1",
            "file_materi" => "CS605-Software Engineering Practitioner’s Approach  by Roger S. Pressman 7th ed.pdf"
        ]);
    }
}

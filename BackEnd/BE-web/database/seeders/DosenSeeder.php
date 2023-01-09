<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::create([
            "nama" => "Prof.Dr.Lubban Jihad,Ph.D",
            "NIP" => "195607011987101001",
            "email" => "lubban@gmail.com",
            "password" => Hash::make('dosen'),
            "foto" => "dummy2.jpg",
        ]);
    }
}

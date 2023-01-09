<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mahasiswa::create([
            "nama" => "Nabila Luthfiah",
            "NIM" => "201511047",
            "email" => "bibil@gmail.com",
            "password" => bcrypt(value:"nyobanyobi"),
            "foto" => "dummy.jpg",
        ]);
    }
}

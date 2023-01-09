<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PengumpulanTugasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterDosenController;
use App\Http\Controllers\TugasController;

Route::apiResource('dosen', DosenController::class);
Route::apiResource('mahasiswa', MahasiswaController::class);
Route::apiResource('materi', MateriController::class);
Route::apiResource('tugas', TugasController::class);

//Menampilkan data salah satu dosen
Route::Get('dosen/{id}', [DosenController::class, "show"]);

//Menampilkan data seluruh dosen
Route::Get('dosen', [DosenController::class, "index"]);

//untuk registrasi mahasiswa
Route::Post('mahasiswa', [MahasiswaController::class, "store"]);

//untuk upload foto profil mahasiswa
Route::Post('mahasiswa/upload_foto/{id}', [MahasiswaController::class, "upload_foto"]);

//untuk registrasi dosen
Route::Post('dosen', [DosenController::class, "store"]);

//upload foto profil dosen
Route::Post('dosen/upload_foto/{id}', [DosenController::class, "upload_foto"]);

//login
Route::Post('login', [LoginController::class, "login"]);

//mengumpulkan tugas
Route::Post('pengumpulanTugas', [PengumpulanTugasController::class, "store"]);

//melihat data pengumpulan tugas
Route::Get('pengumpulanTugas', [PengumpulanTugasController::class, "index"]);

//menampilkan pengumpulan tugas berdasarkan id
Route::Get('pengumpulanTugas/{id}', [PengumpulanTugasController::class, "show"]);

//mengirimkan bahan ajar
Route::Post('materi', [MateriController::class, "store"]);

//Route::Get('download/{id}', [TugasController::class, "download"]);
//Route::get('tugas/{id}', [TugasController::class, 'download']);
Route::Get('download/{id}', [TugasController::class, "download"]);

//menambahkan nilai
Route::Post('pengumpulanTugas/{id}', [PengumpulanTugasController::class, "nilai"]);

//hapus tugas
Route::delete('delete/{id}', [TugasController::class, "destroy"]);

//hapus materi
Route::delete('materi/{id}', [MateriController::class, "destroy"]);

//hapus tugas oleh mahasiswa
Route::delete('pengumpulanTugas/{id}', [PengumpulanTugasController::class, "destroy"]);

//hapus dosen
Route::delete('dosen/{id}', [DosenController::class, "destroy"]);

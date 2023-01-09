<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function tugas()
    {
        return $this->hasOne(Tugas::class, 'tugas_id', 'id');
    }
}

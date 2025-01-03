<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nisn', 'nama', 'alamat', 'id_kelas', 'gender'];
    protected $primaryKey = "nisn";
}
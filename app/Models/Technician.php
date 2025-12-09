<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;

    protected $table = 'technicians';

    // INI KUNCI PERBAIKANNYA:
    // Daftarkan semua nama kolom tabel di sini
    protected $fillable = [
        'name',
        'role',
        'email',
        'phone',
        'address',
        'salary',
        'status',
        'date_joined'
    ];
}
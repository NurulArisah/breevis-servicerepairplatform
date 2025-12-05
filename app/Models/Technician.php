<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    use HasFactory;
    
    // Asumsi nama tabel adalah 'technicians'
    protected $primaryKey = 'technician_id';
    
    // Tipe data yang harus di-cast ke DateTime
    protected $casts = [
        'start_from' => 'datetime',
    ];
    
    // Daftar kolom yang diizinkan diisi oleh Admin saat menambahkan data
    protected $fillable = [
        'technician_name',
        'technician_phone',
        'start_from', // Tanggal mulai kerja
        'salary',     // Gaji bulanan atau harian
        'working_status',     // Misalnya: 'Active', 'Off-duty', dll. (Jika ada)
    ];

    // --- RELASI (Menghubungkan Teknisi ke Pekerjaan) ---
    
    /**
     * Relasi 1:M (One-to-Many)
     * Satu Teknisi dapat menangani banyak Order.
     * FK 'technician_id' ada di tabel 'orders'.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'technician_id');
    }
    
    /**
     * Relasi 1:M (One-to-Many)
     * Satu Teknisi dapat membuat banyak hasil Diagnosis.
     * FK 'technician_id' ada di tabel 'diagnosis'.
     */
    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class, 'technician_id');
    }
    
    /**
     * Relasi 1:M (One-to-Many)
     * Satu Teknisi dapat terkait dengan banyak Transaksi (misalnya Expense gaji/komisi).
     * FK 'technician_id' ada di tabel 'transactions'.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'technician_id');
    }

    /**
     * Memeriksa apakah teknisi sedang sibuk dengan order yang masih ON-PROGRESS.
     */
    public function isBusy(): bool
    {
        // Mencari Order yang ditugaskan kepada Teknisi ini (this->orders)
        // DAN status order tersebut (melalui relasi orderStatus)
        // memiliki general_category 'ON-PROGRESS'
        return $this->orders()
            ->whereHas('orderStatus', function ($query) {
                $query->where('general_category', 'ON-PROGRESS');
            })
            ->exists();
    }
}
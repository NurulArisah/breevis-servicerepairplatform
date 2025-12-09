<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Pastikan Primary Key benar sesuai migrasi
    protected $primaryKey = 'transaction_id'; 

    protected $fillable = [
        'transaction_id',      // Wajib ada
        'order_id', 
        'technician_id', 
        'transaction_type_id', 
        'transaction_category', // 'income' / 'expense'
        'amount', 
        'payment_method',       // Tambahkan ini (PENTING)
        'bank_name',
        'account_number',
        'status',               // 'Unpaid', 'Completed'
        'payment_status_id',    // Opsional jika pakai ini
        'notes',
        'transaction_image',
        'transaction_date',
    ];

    // Relasi
    public function order() { return $this->belongsTo(Order::class, 'order_id'); }
    public function technician() { return $this->belongsTo(Technician::class, 'technician_id'); }
    public function type() { return $this->belongsTo(TransactionType::class, 'transaction_type_id'); }
}
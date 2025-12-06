<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Technician;

class Transaction extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'transaction_id';
    
    protected $fillable = [
        'order_id', // Opsional, hanya diisi jika transaksi terkait Order (Income/Expense Sparepart)
        'technician_id', // Opsional, diisi jika expense adalah gaji/komisi teknisi
        'transaction_type_id', 
        'transaction_category', // 'income' atau 'expense'
        'bank_name',
        'account_number',
        'amount', 
        'notes',
        'transaction_image',
        'transaction_date',
        'payment_status_id',
    ];

    // Relasi M:1 ke Order (jika transaksi terkait Order)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    // Relasi M:1 ke TransactionType (misal: 'Payment Customer' atau 'Purchase Sparepart')
    public function type()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function technician()
    {
        // Mencari di tabel technicians menggunakan FK technician_id
        return $this->belongsTo(Technician::class, 'technician_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;
    
    protected $table = 'transaction_type';

    // Asumsi nama tabel adalah 'payment_methods'
    protected $primaryKey = 'transaction_type_id'; 
    
    protected $fillable = [
        'transaction_type_name'
    ]; 
    
    // Tidak ada relasi di sini karena ini adalah Model lookup (tujuan)
}

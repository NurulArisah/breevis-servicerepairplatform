<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;
    
    protected $table = 'payment_status';
    
    // Asumsi nama tabel adalah 'payment_methods'
    protected $primaryKey = 'payment_status_id'; 
    
    protected $fillable = [
        'payment_status_name'
    ]; 
    
    // Tidak ada relasi di sini karena ini adalah Model lookup (tujuan)
}

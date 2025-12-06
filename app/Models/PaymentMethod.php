<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    
    protected $table = 'payment_method';
    
    // Asumsi nama tabel adalah 'payment_methods'
    protected $primaryKey = 'payment_method_id'; 
    
    protected $fillable = [
        'payment_method_name'
    ]; 
    
    // Tidak ada relasi di sini karena ini adalah Model lookup (tujuan)
}
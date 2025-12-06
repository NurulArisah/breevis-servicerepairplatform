<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    
    protected $table = 'order_status';

    protected $primaryKey = 'order_status_id'; 
    
    protected $fillable = [
        'order_status_name',
        'general_category'
    ]; 
    
    // Tidak ada relasi di sini karena ini adalah Model lookup (tujuan)
}

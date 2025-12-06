<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    
    protected $table = 'service_type';

    // Asumsi nama tabel adalah 'payment_methods'
    protected $primaryKey = 'service_type_id'; 
    
    protected $fillable = [
        'service_type_name',
        'extra_cost',
    ]; 
    
    // Tidak ada relasi di sini karena ini adalah Model lookup (tujuan)
}

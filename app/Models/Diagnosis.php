<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    protected $table = 'diagnosis';
    
    protected $primaryKey = 'diagnosis_id';
    
    protected $fillable = [
        'order_id', 
        'technician_id', 
        'diagnosis_notes', 
        'total_parts_cost',  
        'spareparts_detail',
    ];

    // Relasi 1:1 ke Order (Order memiliki satu Diagnosis)
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    
    // Relasi M:1 ke Technician (Teknisi yang melakukan diagnosis)
    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Pastikan ini mengarah ke tabel yang benar
    protected $table = 'orders';

    // UPDATE BAGIAN INI:
    protected $fillable = [
        'customer_name', 'customer_phone', 'customer_email',
        'device_type', 'device_brand', 'device_model', 'serial_number',
        'problem_description', 'issue_started', 'previous_repair',
        'additional_notes', 'attachment_path',
        'service_type', 'delivery_method', 'pickup_address', 'pickup_city',
        'payment_method', 'status', 'estimated_cost'
    ];
}
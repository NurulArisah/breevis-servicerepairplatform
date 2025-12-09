<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_id', 
        'actor_role',   // Admin, Customer, System
        'action',       // Login, Submit Order, etc
        'description',
        'status',       // Success, Warning, Critical
        'ip_address',
        'device_info',
        'related_id'
    ];
}
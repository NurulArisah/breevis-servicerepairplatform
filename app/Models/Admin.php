<?php

namespace App\Models;

// Impor Model Order agar relasi dapat berfungsi
use App\Models\Order; 
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable; 
// Tidak perlu MustVerifyEmail dan kontrak lainnya jika tidak digunakan

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // --- CUSTOM PROPERTIES UNTUK SKEMA BRIVIS ---
    
    // 1. Tentukan nama tabel yang benar (WAJIB, karena bukan 'users')
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
        'phone_number'
    ];


    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // --- RELASI BISNIS ---
    
    /**
     * Relasi 1:M (One-to-Many)
     * Admin dapat mengawasi/mengassign banyak Order.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'admin_id', 'admin_id');
    }

}
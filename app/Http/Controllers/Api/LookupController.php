<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod; 
use App\Models\PaymentStatus;
use App\Models\OrderStatus; 
use App\Models\Technician; 
use App\Models\ServiceType;
use App\Models\DeliveryMethod;
use App\Models\DeviceType;
use App\Models\TransactionType;

// Tambahkan model lookup lain yang Anda butuhkan (Brand, DeviceType, dll.)

class LookupController extends Controller
{
    /**
     * [GET] Mengambil daftar metode pembayaran (Untuk Order Form)
     */
    public function getPaymentMethods()
    {
        // Hanya mengambil ID dan Nama kolom, disajikan sebagai 'id' dan 'name'
        $methods = PaymentMethod::all(['payment_method_id as id', 'payment_method_name as name']);
        return response()->json($methods);
    }
    
    /**
     * [GET] Mengambil daftar status order (Untuk Filter Admin & Tracking Customer)
     */
    public function getOrderStatuses()
    {
        // Mengambil semua data status, termasuk kategori umum untuk filtering Admin
        $statuses = OrderStatus::all([
            'order_status_id as id', 
            'order_status_name as name', 
            'general_category'
        ]);
        return response()->json($statuses);
    }

    /**
     * [GET] Mengambil daftar Teknisi Aktif (Untuk Dropdown Admin Assignment)
     */
    public function getTechnicians()
    {
        // Anda mungkin ingin memfilter hanya Teknisi yang statusnya 'Active'
        $technicians = Technician::where('working_status', 'Off Task') // Asumsi Anda punya kolom 'status'
                                 ->get(['technician_id as id', 'technician_name as name']);
        
        return response()->json($technicians);
    }
    
    /**
     * [GET] Mengambil daftar Tipe Layanan (Reguler/Express)
     */
    public function getServiceTypes()
    {
        $types = ServiceType::all([
            'service_type_id as id', 
            'service_type_name as name',
            'extra_cost',
        ]);
        return response()->json($types);
    }

    /**
     * [GET] Mengambil daftar Metode Pengiriman
     */
    public function getDeliveryMethods()
    {
        $methods = DeliveryMethod::all(['delivery_method_id as id', 'delivery_method_name as name']);
        return response()->json($methods);
    }

    /**
     * [GET] Mengambil daftar Tipe Perangkat (Misal: Laptop, PC, Smartphone)
     */
    public function getDeviceTypes()
    {
        $types = DeviceType::all(['device_type_id as id', 'device_type_name as name']);
        return response()->json($types);
    }

    /**
     * [GET] Mengambil daftar Tipe Transaksi (misal: Income, Expense, Salary)
     */
    public function getTransactionTypes()
    {
        // memasukkan nama kolom 
        $types = TransactionType::all(['transaction_type_id', 'transaction_type_name']); 
        return response()->json($types);
    }

        /**
     * [GET] Mengambil daftar payment status
     */
    public function getPaymentStatuses()
    {
        // memasukkan nama kolom 
        $statuses = PaymentStatus::all(['payment_status_id', 'payment_status_name']); 
        return response()->json($statuses);
    }
}
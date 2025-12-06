<?php

use Illuminate\Support\Facades\Route;

// Wajib: Impor semua Controller yang sudah dibuat
use App\Http\Controllers\Api\LookupController;
use App\Http\Controllers\Api\OrderController; 
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\TechnicianController;
use App\Http\Controllers\Api\LogController;
use App\Http\Controllers\Api\AuthController;


// =========================================================================
// 1. RUTE PUBLIC (Customer & Login Entry)
// =========================================================================

// --- A. AUTHENTICATION (Login Endpoint) ---
Route::controller(AuthController::class)->prefix('admin')->group(function () {
    Route::post('/login', 'login'); // LOGIN ENDPOINT WAJIB PUBLIK
});

// --- B. CUSTOMER & PUBLIC LOOKUP API ---
// Semua rute ini tidak memerlukan otentikasi.
Route::controller(LookupController::class)->prefix('lookup')->group(function () {
    Route::get('payment-methods', 'getPaymentMethods'); 
    Route::get('order-statuses', 'getOrderStatuses');
    Route::get('service-types', 'getServiceTypes');
    Route::get('delivery-methods', 'getDeliveryMethods');
    Route::get('device-types', 'getDeviceTypes');
    Route::get('transaction-types', 'getTransactionTypes');
    Route::get('payment-statuses', 'getPaymentStatuses');
    Route::get('technicians', 'getTechnicians'); // Lookup Staff List
});

// --- C. CUSTOMER ORDER & ACTIONS ---
Route::controller(OrderController::class)->group(function () {
    Route::post('/orders', 'store');                     // 1. Membuat Order Baru
    Route::get('/orders/{order_code}', 'show');          // 2. Customer Tracking
    Route::patch('orders/{id}/cancel', 'cancelOrder');   // 3. Customer/Admin Cancel
    Route::patch('orders/{id}/confirm-payment', 'confirmPayment'); // 4. Confirm COD
    Route::patch('orders/{id}/approve-repair', 'approveRepair'); // 5. Customer Approval
    Route::post('orders/{id}/initiate-payment', 'initiatePayment'); // Rute ini melayani customer setelah approval/saat ingin membayar online
});

// --- D. CUSTOMER UPLOAD ---
Route::post('upload/device-photo/{device_id}', [UploadController::class, 'uploadDevicePhoto']);


// =========================================================================
// 2. RUTE PROTECTED (Admin Access Only)
// =========================================================================

// Semua rute di dalam grup ini memerlukan Sanctum Token yang valid.
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {

    // A. AUTH & PROFILE MANAGEMENT
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout'); 
        Route::get('/profile', 'getProfile');
        Route::patch('/profile', 'updateProfile');
        Route::patch('/change-password', 'changePassword');
    });

    // B. ORDER MANAGEMENT & CORE LOGIC
    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::get('/', 'index');                                // Admin READ List & Summary
        Route::patch('{id}/assign-technician', 'assignTechnician');
        Route::patch('{id}/diagnose', 'updateDiagnosis');
    });
    
    // C. STAFF MANAGEMENT
    Route::controller(TechnicianController::class)->prefix('technicians')->group(function () {
        Route::get('/', 'index'); 
        Route::post('/', 'store'); 
        Route::get('{technicianId}/orders', 'getAssignedOrders'); 
    });

    // D. FINANCE REPORT & TRANSACTIONS (CRITICAL FIX)
    Route::controller(TransactionController::class)->prefix('transactions')->group(function () {
        Route::get('/', 'index');                           // Laporan Keuangan (READ Log)
        Route::post('/', 'store');                          // Mencatat Transaksi Manual (CREATE Log)
        Route::get('/{transaction_id}', 'show');            // Detail Transaksi
        Route::patch('/{transaction_id}/confirm', 'confirmTransaction'); 
        Route::patch('/{transaction_id}/cancel', 'cancelTransaction');
        Route::patch('admin/transactions/{id}/cancel', 'cancelTransaction');
    });

    // E. ADMIN UPLOAD (Bukti TF)
    Route::post('upload/receipt/{transaction_id}', [UploadController::class, 'uploadTransactionReceipt']);

    // update status
    Route::patch('orders/{id}/update-status', [OrderController::class, 'updateStatus']);

    // F. LOG ACTIVITIES
    Route::get('logs', [LogController::class, 'index']); // Read Audit Logs

});
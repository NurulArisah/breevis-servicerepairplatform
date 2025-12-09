<?php

use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\Api\LookupController;
use App\Http\Controllers\Api\OrderController; 
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\TechnicianController;
use App\Http\Controllers\Api\LogController;
use App\Http\Controllers\Api\AuthController;

// =========================================================================
// 1. RUTE PUBLIC (Tanpa Token)
// =========================================================================

// A. AUTHENTICATION
Route::controller(AuthController::class)->prefix('admin')->group(function () {
    Route::post('/login', 'login'); 
});

// B. LOOKUP DATA (Dropdowns)
Route::controller(LookupController::class)->prefix('lookup')->group(function () {
    Route::get('payment-methods', 'getPaymentMethods'); 
    Route::get('order-statuses', 'getOrderStatuses');
    Route::get('service-types', 'getServiceTypes');
    Route::get('delivery-methods', 'getDeliveryMethods');
    Route::get('device-types', 'getDeviceTypes');
    Route::get('transaction-types', 'getTransactionTypes');
    Route::get('payment-statuses', 'getPaymentStatuses');
    Route::get('technicians', 'getTechnicians'); 
});

// C. CUSTOMER ACTIONS (Order & Upload)
Route::controller(OrderController::class)->group(function () {
    Route::post('/orders', [OrderController::class, 'store']); 
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::get('/admin/orders', [OrderController::class, 'index']); 
    Route::patch('orders/{id}/cancel', 'cancelOrder'); 
    Route::patch('orders/{id}/confirm-payment', 'confirmPayment'); 
    Route::patch('orders/{id}/approve-repair', 'approveRepair'); 
    Route::post('orders/{id}/initiate-payment', 'initiatePayment'); 
});

// D. PUBLIC UPLOAD
Route::post('upload/device-photo/{device_id}', [UploadController::class, 'uploadDevicePhoto']);


// =========================================================================
// 2. RUTE PROTECTED (Wajib Token Admin)
// =========================================================================

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    
    // A. LOG ACTIVITIES (Dashboard Log)
    Route::get('/logs', [LogController::class, 'index']);

    // B. PROFILE
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout'); 
        Route::get('/profile', 'getProfile');
        Route::patch('/profile', 'updateProfile');
        Route::patch('/change-password', 'changePassword');
    });

    // C. ORDER MANAGEMENT
    Route::controller(OrderController::class)->prefix('orders')->group(function () {
        Route::get('/', 'index'); 
        Route::patch('{id}/assign-technician', 'assignTechnician');
        Route::patch('{id}/diagnose', 'updateDiagnosis');
        Route::patch('{id}/update-status', 'updateStatus'); // Tambahan manual update status
    });
    
    // D. STAFF MANAGEMENT
    Route::controller(TechnicianController::class)->prefix('technicians')->group(function () {
        Route::get('/', 'index'); 
        Route::post('/', 'store'); 
        Route::get('{technicianId}/orders', 'getAssignedOrders'); 
    });

    // E. FINANCE & TRANSACTIONS (PENTING UNTUK FITUR TADI)
    Route::controller(TransactionController::class)->prefix('transactions')->group(function () {
        Route::get('/', 'index');                   // List Data
        Route::post('/', 'store');                  // Create New
        Route::get('/{transaction_id}', 'show');    // Detail
        
        // Route ini yang dipakai tombol Confirm/Cancel di Finance Report
        Route::patch('/{id}/status', 'updateStatus'); 
    });

    // F. ADMIN UPLOAD
    Route::post('upload/receipt/{transaction_id}', [UploadController::class, 'uploadTransactionReceipt']);

});
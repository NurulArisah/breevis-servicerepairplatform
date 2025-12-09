<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // 1. Customer Information
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();

            // 2. Device Information
            // Diubah jadi string karena Vue mengirim text "Smartphone", bukan ID
            $table->string('device_type'); 
            $table->string('device_brand');
            $table->string('device_model');
            $table->string('serial_number')->nullable(); // Ini kolom yang tadinya hilang

            // 3. Issue Details
            $table->text('problem_description');
            $table->string('issue_started')->nullable();
            $table->string('previous_repair');
            $table->text('additional_notes')->nullable();
            $table->string('attachment_path')->nullable();

            // 4. Service & Delivery
            // UBAH JADI STRING AGAR COCOK DENGAN INPUT VUE
            $table->string('service_type');       // Vue kirim: "Regular Repair"
            $table->string('delivery_method');    // Vue kirim: "Home Pick-up"
            $table->string('payment_method');     // Vue kirim: "OVO"
            
            // Status & Cost
            $table->string('status')->default('Pending'); 
            $table->decimal('estimated_cost', 10, 2)->default(0); 

            // Khusus Delivery: Home Pick-up
            $table->text('pickup_address')->nullable();
            $table->string('pickup_city')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
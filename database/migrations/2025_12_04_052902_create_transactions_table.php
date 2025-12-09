<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            // Primary Key sesuai Model
            $table->id('transaction_id'); 
            
            // Foreign Keys (Nullable karena tidak selalu ada)
            $table->unsignedBigInteger('order_id')->nullable(); 
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->unsignedBigInteger('transaction_type_id')->nullable();
            
            // Data Transaksi
            $table->string('transaction_category'); // 'income' atau 'expense'
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->string('transaction_image')->nullable();
            $table->dateTime('transaction_date')->useCurrent();
            $table->string('payment_status_id')->default('Unpaid'); // Unpaid, Completed

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
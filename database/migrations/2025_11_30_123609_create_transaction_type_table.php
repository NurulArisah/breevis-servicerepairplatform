<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTypeTable extends Migration
{
    public function up(): void
    {
        // Tabel ini menyimpan master data: "Service Payment", "Cash Advance", dll
        Schema::create('transaction_type', function (Blueprint $table) {
            // Kita pakai nama ID khusus sesuai Model temanmu
            $table->id('transaction_type_id'); 
            $table->string('transaction_type_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_type');
    }
}
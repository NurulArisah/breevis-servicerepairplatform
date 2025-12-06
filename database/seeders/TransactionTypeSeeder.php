<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data kategori transaksi breevis
        $types = [
            // income
            ['transaction_type_name' => 'Service Payment'],

            // expense
            ['transaction_type_name' => 'Sparepart Purchase'],
            ['transaction_type_name' => 'Salary'],
            ['transaction_type_name' => 'Others'],
        ];
        
        // Masukkan data ke tabel 'transaction_type'
        DB::table('transaction_type')->insert($types);
    }
}

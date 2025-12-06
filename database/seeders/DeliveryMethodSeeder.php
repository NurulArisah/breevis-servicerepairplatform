<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Data Metode Pengiriman Breevis
        $methods = [
            ['delivery_method_name' => 'Self Drop-off'],
            ['delivery_method_name' => 'Pick-up'],
        ];

        // Memasukkan data ke tabel 'delivery_method'
        DB::table('delivery_method')->insert($methods);
    }
}

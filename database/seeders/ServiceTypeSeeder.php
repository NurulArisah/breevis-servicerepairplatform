<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data ServiceType
        $types = [
            ['service_type_name' => 'Regular', 'extra_cost' => '0'],
            ['service_type_name' => 'Express', 'extra_cost' => '10000'],
        ];

        // memasukkan data ke tabel 'order_status'
        DB::table('service_type')->insert($types);
    }
}

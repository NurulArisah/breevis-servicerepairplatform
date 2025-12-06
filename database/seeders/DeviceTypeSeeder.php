<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data jenis perangkat breevis
        $devices = [
            ['device_type_name' => 'Smartphone/Tablet'],
            ['device_type_name' => 'Laptop/Computer'],
            ['device_type_name' => 'Printer'],
            ['device_type_name' => 'TV'],
            ['device_type_name' => 'Speaker & Audio'],
            ['device_type_name' => 'AC'],
        ];

        // Memasukkan data ke tabel 'device_type'
        DB::table('device_type')->insert($devices);
    }
}

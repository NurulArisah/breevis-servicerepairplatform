<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('ALTER TABLE orders AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE devices AUTO_INCREMENT = 1;');
        
        $this->call([
            // --- Lookup Tables (Wajib duluan) ---
            OrderStatusSeeder::class,
            PaymentMethodSeeder::class,
            DeliveryMethodSeeder::class,
            ServiceTypeSeeder::class,
            DeviceTypeSeeder::class,
            PaymentStatusSeeder::class,
            TransactionTypeSeeder::class,
            
            // --- Core Demo Data (Wajib terakhir) ---
            DemoTechnicianSeeder::class, 
            DemoCoreDataSeeder::class, 
            LogActivitySeeder::class,
            AdminUserSeeder::class,
            // Anda juga perlu Seeder untuk Admin Login!
            // AdminUserSeeder::class,
        ]);
    }
}

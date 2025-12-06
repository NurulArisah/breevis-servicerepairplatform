<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderTimeline;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     * Logika ini berjalan setiap kali Order::save() dipanggil.
     */
    public function updated(Order $order): void
    {
        // 1. CEK KRUSIAL: Pastikan hanya berjalan jika order_status_id berubah
        if ($order->isDirty('order_status_id')) {
            
            // 2. Ambil Status Lama (sebelum di-save) dan Status Baru (setelah di-save)
            $fromStatusId = $order->getOriginal('order_status_id');
            $toStatusId = $order->order_status_id;
            
            // Asumsi: Model Order memiliki relasi 'orderStatus' yang sudah didefinisikan
            $fromStatusName = $order->orderStatus()->find($fromStatusId)->status_name ?? 'Status Sebelumnya';
            $toStatusName = $order->orderStatus()->find($toStatusId)->status_name ?? 'Status Baru';
            
            // 3. Tentukan Deskripsi Timeline Otomatis
            $description = "Status Order di-update dari '$fromStatusName' ke '$toStatusName'.";
            
            // 4. Buat Record Timeline Baru
            OrderTimeline::create([
                'order_id' => $order->order_id,
                'from_status_id' => $fromStatusId, 
                'to_status_id' => $toStatusId, 
                'description' => $description,
                // Mengidentifikasi siapa yang mengubah (Admin/Teknisi yang sedang login)
                'changed_by_user_id' => auth()->check() ? auth()->id() : 0 
            ]);
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}

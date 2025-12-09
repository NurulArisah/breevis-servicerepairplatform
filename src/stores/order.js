import { defineStore } from 'pinia';
import axios from 'axios';

export const useOrderStore = defineStore('order', {
  state: () => ({
    orders: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetchOrders() {
      this.loading = true;
      try {
        // Ganti URL sesuai port Laravel kamu
        const response = await axios.get('http://localhost:8000/api/admin/orders');
        
        // MAPPING DATA: Mengubah format Database ke Format Tampilan Vue
        this.orders = response.data.map(order => {
          const dateObj = new Date(order.created_at);
          
          return {
            id: `#ORD-${String(order.id).padStart(6, '0')}`, // Format ID
            rawId: order.id, // ID Asli untuk delete/update
            name: order.customer_name,
            phone: order.customer_phone,
            email: order.customer_email,
            address: order.pickup_address ? `${order.pickup_address}, ${order.pickup_city}` : '-',
            
            // Format Tanggal & Jam
            date: dateObj.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' }),
            time: dateObj.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit' }),
            
            // Format Harga
            price: new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(order.estimated_cost),
            
            delivery: order.delivery_method,
            paymentMethod: order.payment_method,
            
            // Logika Status Pembayaran (Sementara default Unpaid jika belum ada di DB)
            paymentStatus: order.payment_status || 'Unpaid', 
            
            orderStatus: order.status,
            displayDate: dateObj.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })
          };
        });

      } catch (error) {
        console.error('Gagal mengambil data orders:', error);
        this.error = error.message;
      } finally {
        this.loading = false;
      }
    },

    async deleteOrder(id) {
      try {
        // Gunakan ID asli (rawId) untuk menghapus ke API
        await axios.delete(`http://localhost:8000/api/orders/${id}`);
        // Refresh data setelah hapus
        await this.fetchOrders(); 
      } catch (error) {
        console.error('Gagal menghapus order:', error);
        alert('Gagal menghapus data.');
      }
    }
  }
});
<template>
  <div class="space-y-6 relative">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div class="bg-gradient-to-r from-[#2D9CDB] to-[#2F80ED] text-white p-4 rounded-xl relative overflow-hidden shadow-lg">
        <div class="relative z-10">
          <h3 class="text-3xl font-bold">{{ orders.length }}</h3>
          <p class="text-blue-100 text-xs font-medium uppercase mt-1">Total Order</p>
        </div>
        <div class="absolute right-2 top-2 opacity-20">
          <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
        </div>
      </div>
      <div class="bg-gradient-to-r from-[#F99838] to-[#935A21] text-white p-4 rounded-xl relative overflow-hidden shadow-lg">
        <div class="relative z-10">
          <h3 class="text-3xl font-bold">{{ countStatus('On-Progress') }}</h3>
          <p class="text-orange-100 text-xs font-medium uppercase mt-1">In Progress</p>
        </div>
        <div class="absolute right-2 top-2 opacity-20">
          <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
      </div>
      <div class="bg-gradient-to-r from-[#27AE60] to-[#1E8449] text-white p-4 rounded-xl relative overflow-hidden shadow-lg">
        <div class="relative z-10">
          <h3 class="text-3xl font-bold">{{ countStatus('Completed') }}</h3>
          <p class="text-green-100 text-xs font-medium uppercase mt-1">Completed</p>
        </div>
        <div class="absolute right-2 top-2 opacity-20">
           <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
      </div>
      <div class="bg-gradient-to-r from-[#EB5757] to-[#C0392B] text-white p-4 rounded-xl relative overflow-hidden shadow-lg">
        <div class="relative z-10">
          <h3 class="text-3xl font-bold">{{ countStatus('Cancelled') }}</h3>
          <p class="text-red-100 text-xs font-medium uppercase mt-1">Cancelled</p>
        </div>
        <div class="absolute right-2 top-2 opacity-20">
           <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
      
      <div class="mb-6">
        <h2 class="text-lg font-bold text-gray-700">Recent Order</h2>
      </div>

      <div class="flex flex-wrap gap-3 mb-6 items-center justify-between">
        <div class="flex gap-2 flex-wrap">
           <input type="date" v-model="filterDate" class="px-3 py-1.5 border rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500"/>
           <select v-model="filterDelivery" class="px-3 py-1.5 border rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-white">
             <option value="">All Delivery</option>
             <option value="Home Pick-up">Home Pick-up</option>
             <option value="Drop off at Center">Drop off</option>
           </select>
           <select v-model="filterPaymentMethod" class="px-3 py-1.5 border rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-white">
             <option value="">All Payment Method</option>
             <option value="DANA">DANA</option>
             <option value="Gopay">Gopay</option>
             <option value="OVO">OVO</option>
             <option value="QRIS">QRIS</option>
             <option value="COD (Home Pick-up only)">COD</option>
             <option value="Cash (Drop off only)">Cash</option>
             <option value="Virtual Account">Virtual Account</option>
           </select>
           <select v-model="filterPaymentStatus" class="px-3 py-1.5 border rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-white">
             <option value="">All Payment Status</option>
             <option value="Paid">Paid</option>
             <option value="Unpaid">Unpaid</option>
           </select>
           <select v-model="filterOrderStatus" class="px-3 py-1.5 border rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-white">
             <option value="">All Order Status</option>
             <option value="On-Progress">On-Progress</option>
             <option value="Completed">Completed</option>
             <option value="Cancelled">Cancelled</option>
           </select>
        </div>
        <div class="relative w-full sm:w-64">
           <input type="text" v-model="searchQuery" placeholder="Search Name or ID" class="w-full pl-10 pr-4 py-1.5 border rounded-lg text-sm focus:outline-none focus:ring-1 focus:ring-indigo-500">
           <div class="absolute left-3 top-2 text-gray-400">
             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
           </div>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="text-xs font-bold text-gray-800 border-b border-gray-100 whitespace-nowrap">
              <th class="py-3 px-4">Repairment ID</th>
              <th class="py-3 px-4">Order Date</th>
              <th class="py-3 px-4">Price</th>
              <th class="py-3 px-4">Delivery Method</th>
              <th class="py-3 px-4">Payment Method</th>
              <th class="py-3 px-4 text-center">Payment Status</th>
              <th class="py-3 px-4 text-center">Order Status</th>
              <th class="py-3 px-4 text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="text-sm text-gray-600">
            <tr v-for="(item, index) in filteredOrders" :key="item.id" class="hover:bg-gray-50 border-b border-gray-50 last:border-0">
              <td class="py-4 px-4 whitespace-nowrap">
                <div class="font-bold text-gray-900">{{ item.name }}</div>
                <div class="text-xs text-gray-400">{{ item.id }}</div>
              </td>
              <td class="py-4 px-4 text-xs whitespace-nowrap">
                <div>{{ item.date }}</div>
                <div class="text-gray-400">{{ item.time }}</div>
              </td>
              <td class="py-4 px-4 font-semibold text-gray-800 whitespace-nowrap">{{ item.price }}</td>
              <td class="py-4 px-4 whitespace-nowrap">{{ item.delivery }}</td>
              <td class="py-4 px-4 whitespace-nowrap">{{ item.paymentMethod }}</td>
              <td class="py-4 px-4 text-center whitespace-nowrap">
                <span :class="item.paymentStatus === 'Unpaid' ? 'bg-blue-400 text-white' : 'bg-green-500 text-white'" class="px-4 py-1.5 rounded-full text-xs font-semibold inline-block min-w-[80px]">{{ item.paymentStatus }}</span>
              </td>
              <td class="py-4 px-4 text-center whitespace-nowrap">
                 <span :class="{'bg-yellow-400 text-white': item.orderStatus === 'On-Progress', 'bg-green-600 text-white': item.orderStatus === 'Completed', 'bg-red-500 text-white': item.orderStatus === 'Cancelled'}" class="px-4 py-1.5 rounded-full text-xs font-semibold inline-block min-w-[100px]">{{ item.orderStatus }}</span>
              </td>
              <td class="py-4 px-4 whitespace-nowrap">
                 <div class="flex items-center justify-center gap-2">
                    <button @click="openDetailModal(item)" class="p-1.5 text-gray-400 hover:text-indigo-600 border border-gray-300 rounded-full transition-colors" title="View Details">
                       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </button>
                    <button @click="deleteOrder(item.rawId)" class="p-1.5 text-gray-400 hover:text-red-500 border border-gray-300 rounded-full transition-colors" title="Delete Order">
                       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                    <button class="bg-gray-800 text-white text-xs px-4 py-1.5 rounded-full hover:bg-black transition-colors whitespace-nowrap">Send Invoice</button>
                    <button class="bg-red-500 text-white text-xs px-4 py-1.5 rounded-full hover:bg-red-600 transition-colors whitespace-nowrap">Cancel</button>
                 </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4">
      
      <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col overflow-hidden animate-fade-in-up">
        
        <div class="p-5 border-b border-gray-100 flex justify-between items-start bg-white z-10">
          <div>
            <div class="flex items-center gap-2">
              <h3 class="text-xl font-bold text-gray-900">Order <span class="text-gray-400">{{ selectedOrder.id }}</span></h3>
              <span :class="{
                  'bg-yellow-100 text-yellow-600': selectedOrder.orderStatus === 'On-Progress',
                  'bg-green-100 text-green-600': selectedOrder.orderStatus === 'Completed',
                  'bg-red-100 text-red-600': selectedOrder.orderStatus === 'Cancelled'
                }" class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wide">
                {{ selectedOrder.orderStatus }}
              </span>
            </div>
            <p class="text-gray-400 text-xs mt-1">Created on {{ selectedOrder.displayDate }} at {{ selectedOrder.time }}</p>
          </div>
          <button @click="closeModal" class="text-gray-400 hover:text-gray-700 p-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
          </button>
        </div>

        <div class="p-6 overflow-y-auto custom-scrollbar flex-1 space-y-8">
          
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
             <div class="space-y-3">
                <h4 class="text-gray-900 font-bold text-sm">Costumer Information</h4>
                <div class="text-sm space-y-2">
                  <div>
                    <p class="text-xs text-gray-500 font-semibold">Name</p>
                    <p class="text-gray-900 font-medium">{{ selectedOrder.name }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 font-semibold">Phone Number</p>
                    <p class="text-gray-900 font-medium">{{ selectedOrder.phone }}</p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 font-semibold">Email</p>
                    <p class="text-gray-900 font-medium">{{ selectedOrder.email || '-' }}</p>
                  </div>
                   <div>
                    <p class="text-xs text-gray-500 font-semibold">Address</p>
                    <p class="text-gray-900 font-medium leading-tight">{{ selectedOrder.address }}</p>
                  </div>
                </div>
             </div>

             <div class="space-y-3">
                <h4 class="text-gray-900 font-bold text-sm">Device Information</h4>
                <div class="text-sm space-y-2">
                  <div>
                    <p class="text-xs text-gray-500 font-semibold">Device Type</p>
                    <p class="text-gray-900 font-medium">Smartphone & Tablet</p>
                  </div>
                   <div>
                    <p class="text-xs text-gray-500 font-semibold">Brand / Model</p>
                    <p class="text-gray-900 font-medium">Realme / Realme 5i</p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500 font-semibold">Serial Number</p>
                    <p class="text-gray-900 font-medium">-</p>
                  </div>
                </div>
             </div>
          </div>

          <div class="border-t border-gray-100"></div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
             <div>
                 <h4 class="text-gray-900 font-bold text-sm mb-3">Repair Timeline</h4>
                 <div class="relative pl-2">
                    <div class="absolute left-[7px] top-2 bottom-4 w-[2px] bg-gray-200"></div>
                    <div class="relative flex items-center gap-3 mb-3">
                       <div class="w-4 h-4 rounded-full bg-green-500 border-2 border-white z-10 shadow-sm"></div>
                       <div class="flex-1 text-xs"><span class="font-medium text-gray-900">Order Submitted</span></div>
                    </div>
                    <div class="relative flex items-center gap-3">
                       <div class="w-4 h-4 rounded-full bg-yellow-400 border-2 border-white z-10 ring-2 ring-yellow-50"></div>
                       <div class="flex-1 text-xs"><span class="font-bold text-gray-900">Processing</span></div>
                    </div>
                 </div>
             </div>

             <div class="space-y-4">
                 <div>
                    <p class="text-xs text-gray-500 font-semibold mb-1">Service Details</p>
                    <p class="text-gray-900 text-sm font-medium">Reguler / {{ selectedOrder.delivery }}</p>
                 </div>
                 <div>
                    <p class="text-xs text-gray-500 font-semibold mb-1">Technician Assigned</p>
                    <p class="text-gray-900 text-sm font-medium">Tama Setiawan</p>
                 </div>
             </div>
          </div>
          
        </div>

        <div class="p-5 border-t border-gray-100 bg-gray-50 flex gap-3">
          <button @click="closeModal" class="flex-1 py-2.5 bg-red-500 text-white font-bold rounded-lg hover:bg-red-600 transition-colors text-sm shadow-sm">
            Close
          </button>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useOrderStore } from '../../stores/order'; // Import Store
import { storeToRefs } from 'pinia';

const orderStore = useOrderStore();
const { orders } = storeToRefs(orderStore); // Data Realtime dari Store

// --- STATE: FILTERS ---
const searchQuery = ref('');
const filterDate = ref('');
const filterDelivery = ref('');
const filterPaymentMethod = ref('');
const filterPaymentStatus = ref('');
const filterOrderStatus = ref('');

// --- STATE: MODAL ---
const showModal = ref(false);
const selectedOrder = ref(null);

// FETCH DATA SAAT COMPONENT DILOAD
onMounted(() => {
  orderStore.fetchOrders();
});

// --- FILTERING LOGIC ---
const filteredOrders = computed(() => {
  return orders.value.filter(order => {
    // Search by Name or formatted ID
    const matchesSearch = 
      order.name.toLowerCase().includes(searchQuery.value.toLowerCase()) || 
      order.id.toLowerCase().includes(searchQuery.value.toLowerCase());
    
    // Filter Date (backend format ISO, frontend format string ISO 'YYYY-MM-DD')
    // Kita perlu sedikit trick jika ingin filter date akurat, 
    // tapi karena format date di store sudah 'DD MMM YYYY', kita skip filter date exact dulu atau sesuaikan logicnya.
    // Untuk simplifikasi, filterDate sementara di-bypass atau perlu convert logic di store.
    const matchesDate = !filterDate.value || true; 

    const matchesDelivery = !filterDelivery.value || order.delivery === filterDelivery.value;
    const matchesPaymentMethod = !filterPaymentMethod.value || order.paymentMethod === filterPaymentMethod.value;
    const matchesPaymentStatus = !filterPaymentStatus.value || order.paymentStatus === filterPaymentStatus.value;
    const matchesOrderStatus = !filterOrderStatus.value || order.orderStatus === filterOrderStatus.value;

    return matchesSearch && matchesDate && matchesDelivery && matchesPaymentMethod && matchesPaymentStatus && matchesOrderStatus;
  });
});

const countStatus = (status) => {
  return orders.value.filter(o => o.orderStatus === status).length;
};

// --- ACTIONS ---
const deleteOrder = async (rawId) => {
  if (confirm('Apakah Anda yakin ingin menghapus order ini?')) {
    await orderStore.deleteOrder(rawId);
  }
};

const openDetailModal = (order) => {
  selectedOrder.value = { ...order };
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  selectedOrder.value = null;
};
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: #f9fafb;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #d1d5db; 
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #9ca3af; 
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-up {
  animation: fadeInUp 0.3s ease-out forwards;
}
</style>
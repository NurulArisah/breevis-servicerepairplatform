<template>
  <div class="p-6 space-y-6 bg-gray-50 min-h-screen">
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
          <h3 class="text-3xl font-bold">{{ formatRp(summary.revenue) }}</h3>
          <p class="text-blue-100 text-sm font-medium">Net Revenue</p>
          <div class="mt-4 flex items-center text-xs text-blue-100">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Live Data
          </div>
        </div>
        <div class="absolute right-3 top-3 opacity-20">
          <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
      </div>

      <div class="bg-gradient-to-r from-[#77E4FF] to-[#51DFB7] rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
          <h3 class="text-3xl font-bold">{{ orders.length }}</h3>
          <p class="text-teal-50 text-sm font-medium">Total Orders</p>
          <div class="mt-4 flex items-center text-xs text-teal-50">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            All time
          </div>
        </div>
        <div class="absolute right-3 top-3 opacity-20">
          <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
      </div>

      <div class="bg-gradient-to-r from-[#c471f5] to-[#fa71cd] rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
          <h3 class="text-3xl font-bold">0</h3>
          <p class="text-fuchsia-50 text-sm font-medium">Pending Tasks</p>
          <div class="mt-4 flex items-center text-xs text-fuchsia-100">
             <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Needs Action
          </div>
        </div>
        <div class="absolute right-3 top-3 opacity-20">
          <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
      </div>

      <div class="bg-gradient-to-r from-[#43e97b] to-[#38f9d7] rounded-2xl p-5 text-white shadow-lg relative overflow-hidden">
        <div class="relative z-10">
          <h3 class="text-3xl font-bold">{{ staffList.length }}</h3>
          <p class="text-green-50 text-sm font-medium">Technicians</p>
          <div class="mt-4 flex items-center text-xs text-green-100">
             <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Active Staff
          </div>
        </div>
        <div class="absolute right-3 top-3 opacity-20">
          <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      
      <div class="bg-white p-6 rounded-2xl shadow-sm lg:col-span-2">
        <div class="flex justify-between items-center mb-6">
          <div>
            <h3 class="text-gray-500 text-sm font-medium">Total Income vs Expense</h3>
            <p class="text-2xl font-bold text-gray-800">{{ formatRp(summary.income) }}</p>
          </div>
          <div class="flex gap-4 text-xs font-medium">
             <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> Income</div>
             <div class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-red-500"></span> Expense</div>
          </div>
        </div>
        
        <div class="h-64 w-full relative border-l border-b border-gray-100">
           <div class="absolute inset-0 flex flex-col justify-between text-xs text-gray-300 pointer-events-none">
              <span class="border-b border-dashed border-gray-100 pb-2">Top</span>
              <span class="border-b border-dashed border-gray-100 pb-2">Mid</span>
              <span class="border-b border-dashed border-gray-100 pb-2">Low</span>
              <span class="border-b border-dashed border-gray-100 pb-2">0</span>
           </div>
           <svg class="absolute inset-0 w-full h-full p-2" preserveAspectRatio="none">
             <path d="M0 200 Q 150 100, 300 150 T 600 50" fill="none" stroke="#10B981" stroke-width="3"/>
             <path d="M0 220 Q 150 180, 300 200 T 600 150" fill="none" stroke="#EF4444" stroke-width="3"/>
           </svg>
           <div class="absolute bottom-[-25px] left-0 w-full flex justify-between text-xs text-gray-400 px-4">
              <span>Overall Trend Visualization</span>
           </div>
        </div>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow-sm">
        <div class="flex justify-between items-start mb-6">
           <h3 class="text-lg font-bold text-gray-800 w-1/2">Order Volume</h3>
        </div>
        <div class="h-64 flex items-end justify-between px-2 gap-2">
           <div v-for="i in 7" :key="i" class="w-3 bg-gray-100 rounded-t-full h-full relative group">
              <div :style="{ height: Math.random() * 80 + '%' }" class="absolute bottom-0 left-0 w-full bg-indigo-400 rounded-full transition-all duration-500"></div>
           </div>
        </div>
        <div class="text-center text-[10px] text-gray-400 mt-2">Daily Activity Volume</div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      
      <div class="bg-white rounded-2xl shadow-sm overflow-hidden lg:col-span-2">
        <div class="p-6 pb-4 flex justify-between items-center">
          <h3 class="text-lg font-bold text-gray-800">Recent Order</h3>
          <router-link to="/admin/orders" class="text-xs text-indigo-600 font-bold hover:underline">View All</router-link>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="text-gray-400 text-xs border-b border-gray-100">
                <th class="px-6 py-3 font-medium whitespace-nowrap">Repairment ID</th>
                <th class="px-6 py-3 font-medium whitespace-nowrap">Customer</th>
                <th class="px-6 py-3 font-medium whitespace-nowrap">Order Date</th>
                <th class="px-6 py-3 font-medium whitespace-nowrap">Price</th>
                <th class="px-6 py-3 font-medium whitespace-nowrap">Status</th>
              </tr>
            </thead>
            <tbody class="text-sm">
              <tr v-for="order in recentOrders" :key="order.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">{{ order.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-800">{{ order.name }}</td>
                <td class="px-6 py-4 text-gray-600 text-xs whitespace-nowrap">
                  <div>{{ order.date }}</div>
                  <div class="text-[10px] text-gray-400">{{ order.time }}</div>
                </td>
                <td class="px-6 py-4 font-semibold text-gray-800 whitespace-nowrap">{{ order.price }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="getBadgeColor(order.orderStatus)" class="px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                    {{ order.orderStatus }}
                  </span>
                </td>
              </tr>
              <tr v-if="recentOrders.length === 0">
                <td colspan="5" class="px-6 py-8 text-center text-gray-400 text-xs">No recent orders found.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="bg-white p-6 rounded-2xl shadow-sm flex flex-col items-center justify-center relative">
         <div class="w-full flex justify-between items-start mb-4">
            <h3 class="text-lg font-bold text-gray-800">Status Report</h3>
         </div>
         
         <div class="relative w-48 h-48 rounded-full" 
              :style="donutStyle">
            <div class="absolute inset-0 m-auto w-32 h-32 bg-white rounded-full flex flex-col items-center justify-center">
               <span class="text-2xl font-bold text-gray-800">{{ orders.length }}</span>
               <span class="text-[10px] text-gray-400 uppercase">Total</span>
            </div>
         </div>

         <div class="w-full space-y-2 mt-6">
            <div class="flex justify-between text-xs items-center">
               <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-green-500"></span> Completed</div>
               <span class="font-bold">{{ orderStats.completed }}</span>
            </div>
            <div class="flex justify-between text-xs items-center">
               <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> On-Progress</div>
               <span class="font-bold">{{ orderStats.progress }}</span>
            </div>
            <div class="flex justify-between text-xs items-center">
               <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-red-500"></span> Cancelled</div>
               <span class="font-bold">{{ orderStats.cancelled }}</span>
            </div>
         </div>
      </div>

    </div>

  </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { storeToRefs } from 'pinia';

// IMPORT 3 STORE UTAMA
import { useFinanceStore } from '../../stores/finance';
import { useOrderStore } from '../../stores/order';
import { useStaffStore } from '../../stores/staff';

// INISIALISASI
const financeStore = useFinanceStore();
const orderStore = useOrderStore();
const staffStore = useStaffStore();

// DESTRUCTURING STATE (Agar Reactive)
const { summary } = storeToRefs(financeStore);
const { orders } = storeToRefs(orderStore);
const { staffList } = storeToRefs(staffStore);

// FETCH DATA SAAT MOUNT
onMounted(async () => {
  await Promise.all([
    financeStore.fetchFinance(),
    orderStore.fetchOrders(),
    staffStore.fetchStaff()
  ]);
});

// --- COMPUTED PROPERTIES ---

// 1. Format Rupiah
const formatRp = (val) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(val || 0);

// 2. Recent Orders (Ambil 5 teratas)
const recentOrders = computed(() => {
  return orders.value.slice(0, 5); // Ambil 5 data pertama dari store
});

// 3. Order Stats (Untuk Donut Chart)
const orderStats = computed(() => {
  const total = orders.value.length || 1; // Hindari pembagian nol
  const completed = orders.value.filter(o => o.orderStatus === 'Completed').length;
  const progress = orders.value.filter(o => o.orderStatus === 'On-Progress' || o.orderStatus === 'Checking' || o.orderStatus === 'Pending').length;
  const cancelled = orders.value.filter(o => o.orderStatus === 'Cancelled').length;

  return {
    completed,
    progress,
    cancelled,
    // Hitung Persentase untuk CSS Gradient
    pctCompleted: (completed / total) * 100,
    pctProgress: (progress / total) * 100,
    pctCancelled: (cancelled / total) * 100
  };
});

// 4. Style Dinamis untuk Donut Chart
const donutStyle = computed(() => {
  const s = orderStats.value;
  // Logic CSS Conic Gradient: Green -> Yellow -> Red
  const stop1 = s.pctCompleted;
  const stop2 = stop1 + s.pctProgress;
  
  return {
    background: `conic-gradient(
      #10B981 0% ${stop1}%, 
      #FBBF24 ${stop1}% ${stop2}%, 
      #EF4444 ${stop2}% 100%
    )`
  };
});

// Helper Warna Badge
const getBadgeColor = (status) => {
  const s = status ? status.toLowerCase() : '';
  if (['completed', 'paid', 'success'].includes(s)) return 'bg-green-100 text-green-600';
  if (['cancelled', 'failed', 'rejected'].includes(s)) return 'bg-red-100 text-red-600';
  if (['on-progress', 'pending', 'checking', 'unpaid'].includes(s)) return 'bg-yellow-100 text-yellow-600';
  return 'bg-gray-100 text-gray-600';
};
</script>
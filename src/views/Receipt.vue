<template>
  <div class="bg-gray-50 min-h-screen pb-20">
    
    <div class="bg-white shadow-sm sticky top-0 z-30">
      <div class="container mx-auto px-4 h-16 flex items-center">
        <router-link to="/" class="p-2 -ml-2 text-gray-700 hover:bg-gray-100 rounded-full">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </router-link>
        <h1 class="text-lg font-bold text-gray-900 ml-2 font-sans">
          Receipt Details
        </h1>
      </div>
    </div>

    <div v-if="loading" class="flex flex-col items-center justify-center min-h-[60vh]">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900 mb-4"></div>
        <p class="text-gray-500 font-sans">Retrieving order data...</p>
    </div>

    <div v-else-if="error" class="container mx-auto px-4 mt-10 text-center">
        <div class="bg-red-50 p-6 rounded-2xl border border-red-100 inline-block">
            <h3 class="text-red-600 font-bold mb-2">Order Not Found</h3>
            <p class="text-gray-600 text-sm">{{ error }}</p>
            <router-link to="/" class="mt-4 inline-block bg-black text-white px-6 py-2 rounded-full text-sm font-bold">Go Home</router-link>
        </div>
    </div>

    <div v-else class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl mt-6 space-y-6">
      
      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        
        <div class="flex justify-between items-start mb-8">
          <div>
            <p class="text-xs text-gray-500 font-sans mb-1">Repairment ID</p>
            <div class="flex items-center gap-2">
              <h2 class="text-lg md:text-xl font-bold text-gray-900 font-sans">
                {{ receiptData.orderId }}
              </h2>
              <button @click="copyToClipboard(receiptData.orderId)" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
              </button>
            </div>
            <p class="text-xs text-gray-400 mt-1">Placed on: {{ formatDate(receiptData.createdAt) }}</p>
          </div>
          <span :class="['text-[10px] uppercase tracking-wider font-bold px-3 py-1 rounded-full', statusBadgeClass]">
            {{ receiptData.status }}
          </span>
        </div>

        <div class="mb-8">
          <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Customer Information</h3>
          <div class="space-y-4">
            <div class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Name</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.customer.name }}</p></div>
            </div>
            <div class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Phone Number</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.customer.phone }}</p></div>
            </div>
            <div v-if="receiptData.customer.email" class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Email</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.customer.email }}</p></div>
            </div>
            <div v-if="receiptData.service.deliveryMethod === 'Home Pick-up'" class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Pick-up Address</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.service.pickupAddress }}, {{ receiptData.service.pickupCity }}</p></div>
            </div>
          </div>
        </div>

        <hr class="border-gray-100 my-6">

        <div class="mb-8">
          <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Service Information</h3>
          <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div><p class="text-xs text-gray-400 font-sans mb-1">Service Type</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.service.type }}</p></div>
                <div><p class="text-xs text-gray-400 font-sans mb-1">Delivery Method</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.service.deliveryMethod }}</p></div>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div><p class="text-xs text-gray-400 font-sans mb-1">Device Type</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.device.type }}</p></div>
              <div><p class="text-xs text-gray-400 font-sans mb-1">Brand</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.device.brand }}</p></div>
            </div>
            <div><p class="text-xs text-gray-400 font-sans mb-1">Model / Series</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.device.model }}</p></div>
            <div><p class="text-xs text-gray-400 font-sans mb-1">Problem Description</p><p class="text-sm font-semibold text-gray-900 font-sans leading-relaxed">{{ receiptData.device.problem }}</p></div>
            <div v-if="receiptData.device.notes"><p class="text-xs text-gray-400 font-sans mb-1">Additional Notes</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.device.notes }}</p></div>
          </div>
        </div>
        <div class="flex gap-3 mt-8">
             <button 
                v-if="receiptData.status !== 'Completed' && receiptData.status !== 'Cancelled'"
                @click="receiptData.status = 'Cancelled'"
                class="flex-1 bg-red-500 text-white font-bold py-3 rounded-full hover:bg-red-600 transition-colors text-sm font-sans shadow-md"
             >
                Cancel Order
             </button>
             <button 
                @click="goToDetails"
                class="flex-1 bg-white border border-gray-300 text-gray-700 font-bold py-3 rounded-full hover:bg-gray-50 transition-colors text-sm font-sans shadow-sm">
                See Details
             </button>
        </div>
      </div>

      <div 
        v-if="receiptData.status !== 'Cancelled' || (receiptData.status === 'Cancelled' && receiptData.service.deliveryMethod === 'Home Pick-up')" 
        class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 animate-fade-in"
      >
        <div class="flex justify-between items-center mb-6">
          <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            <h3 class="text-base font-bold text-gray-900 font-sans">Payment Details</h3>
          </div>
          <span :class="['text-[10px] uppercase tracking-wider font-bold px-3 py-1 rounded-full', paymentBadgeClass]">
            {{ receiptData.payment.status || 'UNPAID' }}
          </span>
        </div>

        <div class="space-y-4">
          <div class="border-b border-gray-100 pb-4">
            <p class="text-xs text-gray-400 font-sans mb-1">Payment Method</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.payment.method }}</p>
          </div>
          <div class="space-y-2 pt-2">
            <div class="flex justify-between items-center"><span class="text-base font-bold text-gray-900 font-sans">Estimated Cost</span><span class="text-lg font-bold text-blue-600 font-sans">{{ formatCurrency(receiptData.payment.total) }}</span></div>
            <p class="text-xs text-gray-400 italic mt-1">*Final cost may change after technician inspection.</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <div class="flex items-center gap-2 mb-8">
          <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <h3 class="text-base font-bold text-gray-900 font-sans">Track Progress</h3>
        </div>

        <div class="relative pl-2">
          <div class="absolute left-[9px] top-2 bottom-10 w-0.5 bg-gray-200"></div>

          <div class="relative flex items-start mb-8">
            <div class="absolute left-0 w-5 h-5 rounded-full bg-green-100 border-2 border-green-500 flex items-center justify-center z-10"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
            <div class="ml-10 w-full"><h4 class="text-sm font-bold text-green-700 font-sans">Order Received</h4><p class="text-xs text-gray-500 mt-1 font-sans">We've received your repair request.</p></div>
          </div>

          <div class="relative flex items-start mb-8">
            <div :class="['absolute left-0 w-5 h-5 rounded-full flex items-center justify-center z-10 border-2', receiptData.currentStep >= 2 ? 'bg-green-100 border-green-500' : 'bg-white border-gray-300']">
                 <svg v-if="receiptData.currentStep >= 2" class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="ml-10 w-full">
                <h4 :class="['text-sm font-bold font-sans', receiptData.currentStep >= 2 ? 'text-green-700' : 'text-gray-500']">Processing & Diagnosis</h4>
                <p v-if="receiptData.currentStep >= 2" class="text-xs text-gray-500 mt-1 font-sans">Checking device condition.</p>
            </div>
          </div>

          <div class="relative flex items-start mb-8">
            <div :class="['absolute left-0 w-5 h-5 rounded-full flex items-center justify-center z-10 border-2', receiptData.currentStep >= 3 ? 'bg-yellow-100 border-yellow-500' : 'bg-white border-gray-300']">
                 <svg v-if="receiptData.currentStep >= 3" class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="ml-10 w-full">
                <h4 :class="['text-sm font-bold font-sans', receiptData.currentStep >= 3 ? 'text-yellow-600' : 'text-gray-500']">Repair In Progress</h4>
            </div>
          </div>

          <div class="relative flex items-start">
             <div :class="['absolute left-0 w-5 h-5 rounded-full flex items-center justify-center z-10 border-2', receiptData.currentStep >= 4 ? 'bg-green-100 border-green-500' : 'bg-white border-gray-300']">
                 <svg v-if="receiptData.currentStep >= 4" class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="ml-10 w-full">
                <h4 :class="['text-sm font-bold font-sans', receiptData.currentStep >= 4 ? 'text-green-700' : 'text-gray-500']">Completed</h4>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const router = useRouter(); // Inisialisasi Router
const loading = ref(true);
const error = ref(null);

// Struktur data default (kosong)
const receiptData = ref({
  orderId: '',
  rawId: '', // Menyimpan ID asli database untuk link detail
  status: '', 
  currentStep: 1, 
  createdAt: '',
  customer: { name: '', phone: '', email: '' },
  service: { type: '', deliveryMethod: '', pickupAddress: '', pickupCity: '' },
  device: { type: '', brand: '', model: '', problem: '', notes: '' },
  payment: { method: '', status: 'Unpaid', total: 0 }
});

// Format Rupiah
const formatCurrency = (value) => {
  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
};

// Format Tanggal
const formatDate = (dateString) => {
    if(!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
};

// Navigasi ke Halaman Detail
const goToDetails = () => {
    // Pastikan rawId ada. Kalau tidak, ambil dari route params
    const id = receiptData.value.rawId || route.params.id;
    router.push(`/receipt/${id}/details`);
};

// Fetch Data saat Component Dimuat
onMounted(async () => {
    const id = route.params.id;
    if (!id) {
        error.value = "Missing Order ID";
        loading.value = false;
        return;
    }

    try {
        // Ganti URL ini sesuai port Laravel kamu (default 8000)
        const response = await axios.get(`http://localhost:8000/api/orders/${id}`);
        const data = response.data;

        // --- MAP DATA DARI BACKEND KE FRONTEND STRUCTURE ---
        // Kita ubah snake_case DB ke struktur object Vue
        
        // Tentukan Step berdasarkan Status String dari DB
        let step = 1;
        const status = data.status || 'Pending';
        if (status === 'Processing' || status === 'Diagnosing') step = 2;
        if (status === 'On-Progress' || status === 'Repairing') step = 3;
        if (status === 'Completed' || status === 'Ready') step = 4;

        receiptData.value = {
            orderId: `#ORD-${String(data.id).padStart(6, '0')}`, // Format ID: #ORD-000015
            status: status,
            currentStep: step,
            createdAt: data.created_at,
            customer: {
                name: data.customer_name,
                phone: data.customer_phone,
                email: data.customer_email
            },
            service: {
                type: data.service_type, // Pastikan backend kirim string nama service
                deliveryMethod: data.delivery_method,
                pickupAddress: data.pickup_address,
                pickupCity: data.pickup_city
            },
            device: {
                type: data.device_type,
                brand: data.device_brand,
                model: data.device_model,
                problem: data.problem_description,
                notes: data.additional_notes
            },
            payment: {
                method: data.payment_method,
                status: 'Unpaid', // Default dulu, karena di DB sederhana blm ada status payment
                total: Number(data.estimated_cost)
            }
        };

    } catch (err) {
        console.error("Error fetching receipt:", err);
        error.value = "Failed to load order data. Make sure backend is running.";
    } finally {
        loading.value = false;
    }
});

const statusBadgeClass = computed(() => {
  switch (receiptData.value.status) {
    case 'Cancelled': return 'bg-red-100 text-red-700';
    case 'Completed': return 'bg-green-100 text-green-700';
    case 'On-Progress': 
    case 'Repairing': return 'bg-yellow-100 text-yellow-700';
    default: return 'bg-blue-50 text-blue-700';
  }
});

const paymentBadgeClass = computed(() => {
  return receiptData.value.payment.status === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600';
});

const copyToClipboard = (text) => {
  navigator.clipboard.writeText(text);
  alert('Order ID copied: ' + text);
};
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.5s ease-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
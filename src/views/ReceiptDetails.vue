<template>
  <div class="bg-gray-50 min-h-screen pb-20">
    
    <div class="bg-white shadow-sm sticky top-0 z-30">
      <div class="container mx-auto px-4 h-16 flex items-center">
        <router-link :to="`/receipt/${rawId}`" class="p-2 -ml-2 text-gray-700 hover:bg-gray-100 rounded-full">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </router-link>
        <h1 class="text-lg font-bold text-gray-900 ml-2 font-sans">
          Order Details
        </h1>
      </div>
    </div>

    <div v-if="loading" class="flex flex-col items-center justify-center min-h-[60vh]">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-gray-900 mb-4"></div>
        <p class="text-gray-500 font-sans">Retrieving details...</p>
    </div>

    <div v-else-if="error" class="container mx-auto px-4 mt-10 text-center">
        <div class="bg-red-50 p-6 rounded-2xl border border-red-100 inline-block">
            <h3 class="text-red-600 font-bold mb-2">Error Loading Details</h3>
            <p class="text-gray-600 text-sm">{{ error }}</p>
            <router-link to="/" class="mt-4 inline-block bg-black text-white px-6 py-2 rounded-full text-sm font-bold">Go Home</router-link>
        </div>
    </div>

    <div v-else class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl mt-6 space-y-6">
      
      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <div class="mb-8">
          <p class="text-xs text-gray-500 font-sans mb-1">Repairment ID</p>
          <div class="flex items-center gap-2">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 font-sans">{{ detailData.orderId }}</h2>
            <button @click="copyToClipboard(detailData.orderId)" class="text-gray-400 hover:text-gray-600 cursor-pointer">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </button>
          </div>
        </div>

        <div>
          <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Customer Information</h3>
          <div class="space-y-4">
            <div class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Name</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.customer.name }}</p></div>
            </div>
            <div class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Phone Number</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.customer.phone }}</p></div>
            </div>
            <div class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Email</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.customer.email || '-' }}</p></div>
            </div>
            <div v-if="detailData.service.deliveryMethod === 'Home Pick-up'" class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Address</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.customer.address }}</p></div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Service Information</h3>
        <div class="space-y-4">
          <div><p class="text-xs text-gray-400 font-sans mb-1">Service Type</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.service.type }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Delivery Method</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.service.deliveryMethod }}</p></div>
          <div v-if="detailData.service.deliveryMethod === 'Drop off at Center'"><p class="text-xs text-gray-400 font-sans mb-1">Center Address</p><p class="text-sm font-semibold text-gray-900 font-sans leading-relaxed">{{ detailData.service.centerAddress }}</p></div>
          
          <div><p class="text-xs text-gray-400 font-sans mb-1">Device Type</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.device.type }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Brand</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.device.brand }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Model / Series</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.device.model }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Serial Number</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.device.serialNumber || '-' }}</p></div>
        </div>
      </div>

      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Issue Details</h3>
        <div class="space-y-4">
          
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Problem Description</p>
            <p class="text-sm font-semibold text-gray-900 font-sans leading-relaxed">
              {{ detailData.issue.description }}
            </p>
          </div>

          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">When it Started?</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.issue.started || '-' }}</p>
          </div>

          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Has been Repaired Before?</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.issue.previousRepair }}</p>
          </div>

          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Additional Notes</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.issue.notes || '-' }}</p>
          </div>

          <div v-if="detailData.issue.attachment">
            <p class="text-xs text-gray-400 font-sans mb-2">Device Documentation</p>
            <div class="w-full h-48 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                 <img :src="`http://localhost:8000/storage/${detailData.issue.attachment}`" class="w-full h-full object-cover">
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Technician Diagnosis</h3>
        
        <div class="space-y-4">
          
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Device Issues</p>
            <p v-if="detailData.technician.status === 'On-progress'" class="text-sm text-gray-500 font-sans italic">
              (Waiting for technician check)
            </p>
            <p v-else class="text-sm font-semibold text-gray-900 font-sans">
              {{ detailData.technician.deviceIssues }}
            </p>
          </div>

          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Work Estimation</p>
            <p v-if="detailData.technician.status === 'On-progress'" class="text-sm text-gray-500 font-sans italic">
              (To be calculated)
            </p>
            <p v-else class="text-sm font-semibold text-gray-900 font-sans">
              {{ detailData.technician.workEstimation }}
            </p>
          </div>

          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Sparepart Fee</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">
              {{ detailData.technician.sparepartFee > 0 ? formatCurrency(detailData.technician.sparepartFee) : '-' }}
            </p>
          </div>

          <div class="pt-4 border-t border-gray-100">
            <div class="flex justify-between items-center mb-2">
               <p class="text-xs text-gray-400 font-sans">Total Estimated Cost</p>
               <p class="text-base font-bold text-gray-900 font-sans">{{ formatCurrency(detailData.technician.total) }}</p>
            </div>

            <p class="text-[10px] text-gray-400 font-sans leading-tight mb-4">
              **This price excludes repair service fees, delivery charges, E-Wallet or Virtual Account payments.
            </p>
            
            <button 
              :disabled="detailData.technician.status === 'On-progress'"
              :class="['w-full font-bold py-3 rounded-full text-sm font-sans transition-all', 
                detailData.technician.status === 'On-progress' 
                  ? 'bg-gray-100 text-gray-400 cursor-not-allowed' 
                  : 'bg-black text-white hover:bg-gray-800 shadow-md']"
            >
              Proceed Repairment
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const loading = ref(true);
const error = ref(null);
const rawId = ref(null);

// Struktur Data Default (Kosong)
const detailData = ref({
  orderId: '',
  customer: {
    name: '',
    phone: '',
    email: '',
    address: ''
  },
  service: {
    type: '',
    deliveryMethod: '',
    centerAddress: 'Jl. Malino, No. P45, Makassar' // Alamat toko default
  },
  device: {
    type: '',
    brand: '',
    model: '',
    serialNumber: ''
  },
  issue: {
    description: '',
    started: '',
    previousRepair: '',
    notes: '',
    attachment: null
  },
  technician: {
    status: 'On-progress',
    deviceIssues: '',
    workEstimation: '',
    sparepartFee: 0,
    total: 0
  }
});

const formatCurrency = (value) => {
  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
};

const copyToClipboard = (text) => {
  navigator.clipboard.writeText(text);
  alert('Copied to clipboard: ' + text);
};

onMounted(async () => {
    // Ambil ID dari URL (receipt/:id/details)
    const id = route.params.id; 
    rawId.value = id;

    if (!id) {
        error.value = "Missing Order ID";
        loading.value = false;
        return;
    }

    try {
        const response = await axios.get(`http://localhost:8000/api/orders/${id}`);
        const data = response.data;

        // --- MAP DATA DARI DB KE FRONTEND ---
        detailData.value = {
            orderId: `#ORD-${String(data.id).padStart(6, '0')}`,
            customer: {
                name: data.customer_name,
                phone: data.customer_phone,
                email: data.customer_email,
                address: data.pickup_address ? `${data.pickup_address}, ${data.pickup_city}` : '-'
            },
            service: {
                type: data.service_type,
                deliveryMethod: data.delivery_method,
                centerAddress: 'Jl. Malino, No. P45, Makassar'
            },
            device: {
                type: data.device_type,
                brand: data.device_brand,
                model: data.device_model,
                serialNumber: data.serial_number
            },
            issue: {
                description: data.problem_description,
                started: data.issue_started,
                previousRepair: data.previous_repair,
                notes: data.additional_notes,
                attachment: data.attachment_path
            },
            // Bagian Technician ini masih dummy karena butuh Input Admin nanti
            // Kita ambil 'total' dari estimated_cost dulu
            technician: {
                status: data.status === 'Diagnosed' ? 'Diagnosed' : 'On-progress', 
                deviceIssues: '-', 
                workEstimation: '-',
                sparepartFee: 0,
                total: Number(data.estimated_cost)
            }
        };

    } catch (err) {
        console.error("Error fetching detail:", err);
        error.value = "Failed to load details from server.";
    } finally {
        loading.value = false;
    }
});
</script>
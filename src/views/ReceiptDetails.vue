<template>
  <div class="bg-gray-50 min-h-screen pb-20">
    
    <!-- HEADER -->
    <div class="bg-white shadow-sm sticky top-0 z-30">
      <div class="container mx-auto px-4 h-16 flex items-center">
        <router-link to="/receipt" class="p-2 -ml-2 text-gray-700 hover:bg-gray-100 rounded-full">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </router-link>
        <h1 class="text-lg font-bold text-gray-900 ml-2 font-sans">
          Order Details
        </h1>
      </div>
    </div>

    <!-- CONTAINER UTAMA (1 KOLOM) -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl mt-6 space-y-6">
      
      <!-- 1. REPAIR ID & CUSTOMER INFO -->
      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <!-- Repairment ID -->
        <div class="mb-8">
          <p class="text-xs text-gray-500 font-sans mb-1">Repairment ID</p>
          <div class="flex items-center gap-2">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 font-sans">{{ detailData.orderId }}</h2>
            <button @click="copyToClipboard(detailData.orderId)" class="text-gray-400 hover:text-gray-600 cursor-pointer">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            </button>
          </div>
        </div>

        <!-- Customer Information -->
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
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Email</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.customer.email }}</p></div>
            </div>
            <div v-if="detailData.service.deliveryMethod === 'Home Pick-up'" class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Address</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.customer.address }}</p></div>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. SERVICE INFORMATION -->
      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Service Information</h3>
        <div class="space-y-4">
          <div><p class="text-xs text-gray-400 font-sans mb-1">Service Type</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.service.type }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Delivery Method</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.service.deliveryMethod }}</p></div>
          <div v-if="detailData.service.deliveryMethod === 'Drop-off Service'"><p class="text-xs text-gray-400 font-sans mb-1">Center Address</p><p class="text-sm font-semibold text-gray-900 font-sans leading-relaxed">{{ detailData.service.centerAddress }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Device Type</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.device.type }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Brand</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.device.brand }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Model / Series</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.device.model }}</p></div>
          <div><p class="text-xs text-gray-400 font-sans mb-1">Serial Number</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.device.serialNumber || '-' }}</p></div>
        </div>
      </div>

      <!-- 3. ISSUE DETAILS -->
      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Issue Details</h3>
        <div class="space-y-4">
          
          <!-- Problem Description -->
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Problem Description</p>
            <p class="text-sm font-semibold text-gray-900 font-sans leading-relaxed">
              {{ detailData.issue.description }}
            </p>
          </div>

          <!-- When it Started -->
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">When it Started?</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.issue.started }}</p>
          </div>

          <!-- Previous Repair -->
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Has been Repaired Before?</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.issue.previousRepair }}</p>
          </div>

          <!-- Additional Notes -->
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Additional Notes</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">{{ detailData.issue.notes || '-' }}</p>
          </div>

          <!-- Device Documentation -->
          <div>
            <p class="text-xs text-gray-400 font-sans mb-2">Device Documentation</p>
            <div class="flex gap-3 overflow-x-auto pb-2">
              <!-- Placeholder Images (Portrait sesuai gambar) -->
              <div class="w-24 h-32 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                <img src="https://placehold.co/300x400/png?text=Doc+1" class="w-full h-full object-cover">
              </div>
              <div class="w-24 h-32 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100 border border-gray-200">
                <img src="https://placehold.co/300x400/png?text=Doc+2" class="w-full h-full object-cover">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. TECHNICIAN DIAGNOSIS -->
      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Technician Diagnosis</h3>
        
        <div class="space-y-4">
          
          <!-- Device Issues -->
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Device Issues</p>
            <!-- Jika status on-progress (belum ada issues), tampilkan placeholder -->
            <p v-if="detailData.technician.status === 'On-progress'" class="text-sm text-gray-500 font-sans italic">
              (On-progress)
            </p>
            <!-- Jika sudah ada, tampilkan datanya -->
            <p v-else class="text-sm font-semibold text-gray-900 font-sans">
              {{ detailData.technician.deviceIssues }}
            </p>
          </div>

          <!-- Work Estimation -->
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Work Estimation</p>
            <p v-if="detailData.technician.status === 'On-progress'" class="text-sm text-gray-500 font-sans italic">
              (On-progress)
            </p>
            <p v-else class="text-sm font-semibold text-gray-900 font-sans">
              {{ detailData.technician.workEstimation }}
            </p>
          </div>

          <!-- Sparepart Fee -->
          <div>
            <p class="text-xs text-gray-400 font-sans mb-1">Sparepart Fee</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">
              {{ detailData.technician.sparepartFee > 0 ? 'Rp ' + formatPrice(detailData.technician.sparepartFee) : '-' }}
            </p>
          </div>

          <!-- Total & Button -->
          <div class="pt-4 border-t border-gray-100">
            <div class="flex justify-between items-center mb-2">
               <p class="text-xs text-gray-400 font-sans">Total</p>
               <p class="text-base font-bold text-gray-900 font-sans">Rp {{ formatPrice(detailData.technician.total) }}</p>
            </div>

            <p class="text-[10px] text-gray-400 font-sans leading-tight mb-4">
              **This price excludes repair service fees, delivery charges, E-Wallet or Virtual Account payments.
            </p>
            
            <!-- 
              TOMBOL PROCEED 
              Logic: Disabled jika status 'On-progress' atau Total masih 0 
            -->
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
      
      <!-- DEVELOPER TEST TOOLS (Untuk Demo) -->
      <div class="mt-8 text-center border-t pt-4 border-gray-200 bg-gray-100 p-4 rounded-xl">
        <p class="text-xs text-gray-500 font-bold mb-2 uppercase">--- Developer Test Mode ---</p>
        <div class="flex justify-center gap-2">
          <button @click="setDiagnosis(false)" class="text-xs bg-yellow-100 text-yellow-800 px-3 py-1 rounded hover:bg-yellow-200">Set On-Progress</button>
          <button @click="setDiagnosis(true)" class="text-xs bg-green-100 text-green-800 px-3 py-1 rounded hover:bg-green-200">Set Diagnosed (Ada Biaya)</button>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// [MOCK DATA]
const detailData = ref({
  orderId: '#RE01288765900015',
  customer: {
    name: 'Tama Setiawan',
    phone: '0851-7688-2175',
    email: 'mrahmatullahs@gmail.com',
    address: 'Jalan Antang Nusa Idaman, Blok C, No. 1'
  },
  service: {
    type: 'Reguler',
    deliveryMethod: 'Drop-off Service', 
    centerAddress: 'Jl. Malino, No. P45, Makassar, Sulawesi Selatan, Indonesia'
  },
  device: {
    type: 'Smartphone & Tablet',
    brand: 'Realme',
    model: 'Realme 5i',
    serialNumber: '-' 
  },
  issue: {
    description: 'Screen cracked and button is not functioning properly',
    started: '3 days ago',
    previousRepair: 'Yes',
    notes: '-'
  },
  technician: {
    status: 'On-progress', // 'On-progress' atau 'Diagnosed'
    deviceIssues: null,
    workEstimation: null,
    sparepartFee: 0,
    total: 0
  }
});

const copyToClipboard = (text) => {
  alert('Copied to clipboard: ' + text);
};

const formatPrice = (value) => {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

// Logic Testing
const setDiagnosis = (isDiagnosed) => {
  if (isDiagnosed) {
    detailData.value.technician = {
      status: 'Diagnosed',
      deviceIssues: 'LCD Panel Broken & Volume Flex Damage',
      workEstimation: '3 Days (Work-day)',
      sparepartFee: 450000,
      total: 450000
    };
  } else {
    detailData.value.technician = {
      status: 'On-progress',
      deviceIssues: null,
      workEstimation: null,
      sparepartFee: 0,
      total: 0
    };
  }
};
</script>
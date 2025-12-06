<template>
  <div class="bg-gray-50 min-h-screen pb-20">
    
    <!-- HEADER -->
    <div class="bg-white shadow-sm sticky top-0 z-30">
      <div class="container mx-auto px-4 h-16 flex items-center">
        <router-link to="/" class="p-2 -ml-2 text-gray-700 hover:bg-gray-100 rounded-full">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </router-link>
        <h1 class="text-lg font-bold text-gray-900 ml-2 font-sans">
          Receipt
        </h1>
      </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl mt-6 space-y-6">
      
      <!-- KARTU 1: RECEIPT DETAILS -->
      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        
        <!-- REPAIR ID & STATUS -->
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
          </div>
          <!-- Badge Status (Dinamis) -->
          <span :class="['text-[10px] uppercase tracking-wider font-bold px-3 py-1 rounded-full', statusBadgeClass]">
            {{ receiptData.status }}
          </span>
        </div>

        <!-- CUSTOMER INFO -->
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
            <div class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Email</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.customer.email }}</p></div>
            </div>
            <div v-if="receiptData.service.deliveryMethod === 'Home Pick-up'" class="flex items-start">
              <div class="w-6 flex-shrink-0 mt-0.5"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
              <div><p class="text-xs text-gray-400 font-sans mb-0.5">Address</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.service.pickupAddress }}, {{ receiptData.service.pickupCity }}</p></div>
            </div>
          </div>
        </div>

        <hr class="border-gray-100 my-6">

        <!-- SERVICE INFO -->
        <div class="mb-8">
          <h3 class="text-base font-bold text-gray-900 mb-4 font-sans">Service Information</h3>
          <div class="space-y-4">
            <div><p class="text-xs text-gray-400 font-sans mb-1">Service Type</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.service.type }}</p></div>
            <div><p class="text-xs text-gray-400 font-sans mb-1">Delivery Method</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.service.deliveryMethod }}</p></div>
            <div class="grid grid-cols-2 gap-4">
              <div><p class="text-xs text-gray-400 font-sans mb-1">Device Type</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.device.type }}</p></div>
              <div><p class="text-xs text-gray-400 font-sans mb-1">Brand</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.device.brand }}</p></div>
            </div>
            <div><p class="text-xs text-gray-400 font-sans mb-1">Model / Series</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.device.model }}</p></div>
            <div><p class="text-xs text-gray-400 font-sans mb-1">Problem Description</p><p class="text-sm font-semibold text-gray-900 font-sans leading-relaxed">{{ receiptData.device.problem }}</p></div>
            <div><p class="text-xs text-gray-400 font-sans mb-1">Technician Diagnosis</p><p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.technicianDiagnosis || '-' }}</p></div>
          </div>
        </div>

        <!-- TOMBOL AKSI -->
        <div class="flex gap-3 mt-8">
          <!-- Tombol Cancel hanya muncul jika Status MASIH On-Progress (Belum Cancelled/Completed) -->
          <button 
            v-if="receiptData.status === 'On-Progress'"
            @click="receiptData.status = 'Cancelled'"
            class="flex-1 bg-red-500 text-white font-bold py-3 rounded-full hover:bg-red-600 transition-colors text-sm font-sans shadow-md"
          >
            Cancel Order
          </button>
          <button 
          @click="$router.push('/receipt-details')"
          class="flex-1 bg-white border border-gray-300 text-gray-700 font-bold py-3 rounded-full hover:bg-gray-50 transition-colors text-sm font-sans shadow-sm">
            See Details
          </button>
        </div>
      </div>

      <!-- KARTU 2: PAYMENT STATUS -->
      <!-- 
        Logic Tampil:
        1. Jika status TIDAK Cancelled (Normal Flow).
        2. ATAU Jika status Cancelled TAPI Delivery Method = 'Home Pick-up' (Karena user harus bayar ongkir balik).
      -->
      <div 
        v-if="receiptData.status !== 'Cancelled' || (receiptData.status === 'Cancelled' && receiptData.service.deliveryMethod === 'Home Pick-up')" 
        class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100 animate-fade-in"
      >
        
        <div class="flex justify-between items-center mb-6">
          <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            <h3 class="text-base font-bold text-gray-900 font-sans">Payment Status</h3>
          </div>
          
          <!-- Badge Payment (Unpaid/Paid) -->
          <span :class="['text-[10px] uppercase tracking-wider font-bold px-3 py-1 rounded-full', paymentBadgeClass]">
            {{ receiptData.payment.status }}
          </span>
        </div>

        <div class="space-y-4">
          <div class="border-b border-gray-100 pb-4">
            <p class="text-xs text-gray-400 font-sans mb-1">Payment Method</p>
            <p class="text-sm font-semibold text-gray-900 font-sans">{{ receiptData.payment.method }}</p>
          </div>
          <div class="space-y-2 pt-2">
            <div class="flex justify-between text-sm"><span class="text-gray-500 font-sans">Service Fee</span><span class="font-semibold text-gray-900 font-sans">Rp {{ formatPrice(receiptData.payment.baseFee) }}</span></div>
            <div class="flex justify-between text-sm"><span class="text-gray-500 font-sans">Promo</span><span class="font-semibold text-red-500 font-sans">-Rp {{ formatPrice(receiptData.payment.discount) }}</span></div>
            <div class="border-t border-dashed border-gray-300 my-2"></div>
            <div class="flex justify-between items-center"><span class="text-base font-bold text-gray-900 font-sans">Total</span><span class="text-lg font-bold text-blue-600 font-sans">Rp {{ formatPrice(receiptData.payment.total) }}</span></div>
          </div>
          
          <!-- 
            TOMBOL CONFIRM PAYMENT 
            Logic: Hanya aktif jika Payment Unpaid DAN
                   (Status Completed ATAU (Status Cancelled dan Home Pick-up))
          -->
          <button 
            v-if="receiptData.payment.status === 'Unpaid'"
            @click="receiptData.payment.status = 'Paid'"
            :disabled="!(receiptData.status === 'Completed' || (receiptData.status === 'Cancelled' && receiptData.service.deliveryMethod === 'Home Pick-up'))"
            :class="['w-full mt-6 border font-bold py-3 rounded-full text-sm font-sans shadow-sm transition-all', 
              (receiptData.status === 'Completed' || (receiptData.status === 'Cancelled' && receiptData.service.deliveryMethod === 'Home Pick-up'))
                ? 'bg-black text-white hover:bg-gray-800 border-transparent cursor-pointer' 
                : 'bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed']"
          >
            Confirm Payment
          </button>

          <!-- Jika sudah Paid, tampilkan pesan sukses -->
          <div v-else class="w-full mt-6 bg-green-50 border border-green-200 text-green-700 font-bold py-3 rounded-full text-center text-sm font-sans flex justify-center items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Payment Successful
          </div>

        </div>
      </div>

      <!-- KARTU 3: TRACK PROGRESS (LOGIC LENGKAP + CANCELLED) -->
      <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-gray-100">
        
        <div class="flex items-center gap-2 mb-8">
          <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          <h3 class="text-base font-bold text-gray-900 font-sans">Track Progress</h3>
        </div>

        <div class="relative pl-2">
          <!-- Garis Vertikal -->
          <div class="absolute left-[9px] top-2 bottom-10 w-0.5 bg-gray-200"></div>

          <!-- STEP 1: Order Received (Selalu Hijau - Selesai) -->
          <div class="relative flex items-start mb-8">
            <div class="absolute left-0 w-5 h-5 rounded-full bg-green-100 border-2 border-green-500 flex items-center justify-center z-10"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
            <div class="ml-10 w-full"><h4 class="text-sm font-bold text-green-700 font-sans">Order Received</h4><p class="text-xs text-gray-500 mt-1 font-sans">We've received your repair request.</p></div>
          </div>

          <!-- STEP 2: Device Arrived (Selalu Hijau - Selesai) -->
          <div class="relative flex items-start mb-8">
            <div class="absolute left-0 w-5 h-5 rounded-full bg-green-100 border-2 border-green-500 flex items-center justify-center z-10"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
            <div class="ml-10 w-full"><h4 class="text-sm font-bold text-green-700 font-sans">Device Arrived</h4><p class="text-xs text-gray-500 mt-1 font-sans">Your device has arrived at our service center.</p></div>
          </div>

          <!-- STEP 3: Diagnostic Completed (Selalu Hijau - Selesai) -->
          <div class="relative flex items-start mb-8">
            <div class="absolute left-0 w-5 h-5 rounded-full bg-green-100 border-2 border-green-500 flex items-center justify-center z-10"><svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div>
            <div class="ml-10 w-full"><h4 class="text-sm font-bold text-green-700 font-sans">Diagnostic Completed</h4><p class="text-xs text-gray-500 mt-1 font-sans">We've finished checking your device.</p></div>
          </div>

          <!-- === LOGIKA CANCELLED === -->
          <template v-if="receiptData.status === 'Cancelled'">
            <!-- Step 4: Order Cancelled (Merah) -->
            <div class="relative flex items-start mb-8 animate-fade-in">
              <div class="absolute left-0 w-5 h-5 rounded-full bg-white border-2 border-red-500 flex items-center justify-center z-10"><svg class="w-3 h-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg></div>
              <div class="ml-10 w-full"><h4 class="text-sm font-bold text-red-600 font-sans">Order Cancelled</h4><p class="text-xs text-gray-500 mt-1 font-sans">Your repair request has been cancelled.</p></div>
            </div>
            <!-- Step 5: Cabang -->
            <template v-if="receiptData.service.deliveryMethod === 'Home Pick-up'">
               <div class="relative flex items-start mb-8">
                  <div :class="['absolute left-0 w-5 h-5 rounded-full flex items-center justify-center z-10 border-2', receiptData.payment.status === 'Paid' ? 'bg-green-100 border-green-500' : 'bg-white border-yellow-500']">
                    <svg v-if="receiptData.payment.status === 'Paid'" class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    <svg v-else class="w-3 h-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                  </div>
                  <div class="ml-10 w-full"><h4 :class="['text-sm font-bold font-sans', receiptData.payment.status === 'Paid' ? 'text-green-700' : 'text-yellow-600']">Awaiting Payment</h4><p class="text-xs text-gray-500 mt-1 font-sans">For return delivery.</p></div>
               </div>
               <div class="relative flex items-start" :class="receiptData.payment.status === 'Paid' ? '' : 'opacity-50'">
                  <div class="absolute left-0 w-5 h-5 rounded-full bg-white border-2 border-gray-300 z-10"></div>
                  <div class="ml-10 w-full"><h4 class="text-sm font-bold text-gray-500 font-sans">Courier Returning Device</h4></div>
               </div>
            </template>
            <template v-else>
               <div class="relative flex items-start animate-fade-in">
                  <div class="absolute left-0 w-5 h-5 rounded-full bg-white border-2 border-yellow-500 flex items-center justify-center z-10"><svg class="w-3 h-3 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>
                  <div class="ml-10 w-full"><h4 class="text-sm font-bold text-yellow-600 font-sans">Device Ready for Pickup</h4><p class="text-xs text-gray-500 mt-1 font-sans">You may now collect your device at our office.</p></div>
               </div>
            </template>
          </template>

          <!-- ========== LOGIC NORMAL (JIKA TIDAK CANCELLED) ========== -->
          <template v-else>
            <!-- Step 4: Awaiting Approval -->
            <div class="relative flex items-start mb-8">
               <div :class="['absolute left-0 w-5 h-5 rounded-full flex items-center justify-center z-10 border-2', receiptData.currentStep >= 3 ? 'bg-yellow-100 border-yellow-500' : 'bg-white border-gray-300']">
                  <svg v-if="receiptData.currentStep >= 3" class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
               </div>
               <div class="ml-10 w-full"><h4 :class="['text-sm font-bold font-sans', receiptData.currentStep >= 3 ? 'text-yellow-600' : 'text-gray-500']">Awaiting Approval</h4><p class="text-xs text-gray-500 mt-1 font-sans">Please approve the repair cost.</p></div>
            </div>

            <!-- Step 5: Awaiting Payment -->
            <div :class="['relative flex items-start mb-8', receiptData.currentStep >= 4 ? '' : 'opacity-50']">
               <div :class="['absolute left-0 w-5 h-5 rounded-full flex items-center justify-center z-10 border-2', receiptData.payment.status === 'Paid' ? 'bg-green-100 border-green-500' : (receiptData.currentStep >= 4 ? 'bg-yellow-100 border-yellow-500' : 'bg-white border-gray-300')]">
                  <svg v-if="receiptData.payment.status === 'Paid'" class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                  <svg v-else-if="receiptData.currentStep >= 4" class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
               </div>
               <div class="ml-10 w-full"><h4 :class="['text-sm font-bold font-sans', receiptData.payment.status === 'Paid' ? 'text-green-700' : (receiptData.currentStep >= 4 ? 'text-yellow-600' : 'text-gray-500')]">Awaiting Payment</h4></div>
            </div>

            <!-- Step 6: Repair Completed -->
            <div :class="['relative flex items-start', receiptData.currentStep >= 5 ? '' : 'opacity-50']">
               <div :class="['absolute left-0 w-5 h-5 rounded-full border-2 z-10', receiptData.currentStep >= 5 ? 'bg-green-100 border-green-500 flex items-center justify-center' : 'bg-white border-gray-300']">
                   <svg v-if="receiptData.currentStep >= 5" class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
               </div>
               <div class="ml-10 w-full"><h4 :class="['text-sm font-bold font-sans', receiptData.currentStep >= 5 ? 'text-green-700' : 'text-gray-500']">Repair Completed</h4></div>
            </div>
          </template>

        </div>
      </div>

      <!-- DEVELOPER TEST TOOLS -->
      <div class="mt-8 text-center border-t pt-4 border-gray-200 bg-gray-100 p-4 rounded-xl">
        <p class="text-xs text-gray-500 font-bold mb-3 uppercase tracking-widest">--- Developer Test Mode ---</p>
        <div class="flex justify-center gap-2 flex-wrap mb-2">
          <button @click="setStep(3)" class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Normal: Awaiting Approval</button>
          <button @click="setStep(4)" class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Normal: Awaiting Payment</button>
          <button @click="setStep(5)" class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Normal: Completed</button>
        </div>
        <div class="flex justify-center gap-2 flex-wrap">
           <button @click="setMode('cancel-pickup')" class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Cancel: Pick-up</button>
           <button @click="setMode('cancel-dropoff')" class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Cancel: Drop-off</button>
           <button @click="receiptData.payment.status = 'Paid'" class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Action: Pay</button>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const receiptData = ref({
  orderId: '#RE01288765900015',
  status: 'On-Progress', 
  currentStep: 3, // 3 = Diagnostic Completed (Default)
  customer: {
    name: 'Tama Setiawan',
    phone: '0851-7688-2175',
    email: 'mrahmatullahs@gmail.com'
  },
  service: {
    type: 'Regular',
    deliveryMethod: 'Home Pick-up', 
    pickupAddress: 'Jalan Antang Nusa Idaman, Blok C, No. 1',
    pickupCity: 'Makassar'
  },
  device: {
    type: 'Smartphone & Tablet',
    brand: 'Realme',
    model: 'Realme 5i',
    problem: 'Screen cracked and button is not functioning properly'
  },
  technicianDiagnosis: 'LCD Replacement Needed',
  payment: {
    method: 'QRIS',
    status: 'Unpaid',
    baseFee: 20000, 
    discount: 0, 
    total: 450000
  }
});

const statusBadgeClass = computed(() => {
  switch (receiptData.value.status) {
    case 'Cancelled': return 'bg-red-100 text-red-700';
    case 'Completed': return 'bg-green-100 text-green-700';
    case 'On-Progress': return 'bg-yellow-100 text-yellow-700';
    default: return 'bg-gray-100 text-gray-700';
  }
});

const paymentBadgeClass = computed(() => {
  return receiptData.value.payment.status === 'Paid' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-600';
});

const copyToClipboard = (text) => {
  alert('Order ID copied to clipboard: ' + text);
};

const formatPrice = (val) => val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

const confirmPayment = () => {
  receiptData.value.payment.status = 'Paid';
  if (receiptData.value.status !== 'Cancelled') {
     receiptData.value.currentStep = 5;
     receiptData.value.status = 'Completed';
  }
};

const setStep = (step) => {
  receiptData.value.currentStep = step;
  receiptData.value.status = 'On-Progress';
  receiptData.value.payment.status = 'Unpaid';
  if (step === 5) {
    receiptData.value.status = 'Completed';
    receiptData.value.payment.status = 'Paid';
  }
};

const setMode = (mode) => {
  if (mode === 'cancel-pickup') {
    receiptData.value.status = 'Cancelled';
    receiptData.value.service.deliveryMethod = 'Home Pick-up';
    receiptData.value.payment.status = 'Unpaid';
  } else if (mode === 'cancel-dropoff') {
    receiptData.value.status = 'Cancelled';
    receiptData.value.service.deliveryMethod = 'Drop-off';
  }
};
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.3s ease-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-5px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
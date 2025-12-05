<template>
  <div>
    
    <!-- HERO SECTION -->
    <section class="relative w-full">
      
      <img 
        :src="heroImage3" 
        alt="Hero Background" 
        class="w-full h-[300px] md:h-[600px] object-cover object-center block"
      />

      <div class="absolute inset-0 bg-black bg-opacity-30"></div>
      
      <!-- 
        KONTEN TENGAH
      -->
      <div class="absolute inset-0 z-10 flex flex-col items-center justify-center h-full text-white container mx-auto px-4">
        
        <!-- LOGO (Responsif) -->
        <div class="mb-2 sm:mb-4">
          <img 
            src="../components/assets/breevis-logo.png" 
            alt="Breevis" 
            class="h-5 sm:h-10 md:h-10 w-auto drop-shadow-lg"
          >
        </div>

        <!-- JUDUL (Responsif) -->
        <h1 class="font-sans font-bold text-2xl sm:text-4xl md:text-6xl mb-4 sm:mb-8 text-center leading-tight drop-shadow-lg">
          Stay Updated, Every <br />
          Step of The Way
        </h1>
        
        <!-- 
          TOMBOL REQUEST A REPAIR (LINK KE ORDER)
        -->
        <router-link 
          to="/order"
          class="font-sans bg-white text-black font-bold text-xs sm:text-base py-2 px-6 sm:py-3 sm:px-8 rounded-full hover:bg-gray-100 transition duration-300 shadow-xl inline-block"
        >
          Request a repair
        </router-link>

      </div>
    </section>

    <!-- 2. FORM CHECK STATUS -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
        
        <!-- CARD CONTAINER UTAMA -->
        <div class="bg-blue-50 rounded-[2.5rem] p-8 md:p-10 w-full max-w-md shadow-sm">
          
          <!-- Judul & Deskripsi -->
          <div class="text-left mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-3 font-sans">
              Check Repair Status
            </h2>
            <p class="text-gray-600 text-sm font-sans leading-relaxed">
              Enter your repairment ID and phone number to check the status of your repair
            </p>
          </div>

          <!-- FORMULIR -->
          <form @submit.prevent="handleCheckStatus" class="space-y-8">
            
            <!-- Input 1: Repairment ID -->
            <div class="relative">
              <div class="flex items-start">
                <!-- Angka 1 Besar Biru -->
                <span class="text-blue-500 font-bold text-4xl mr-4 leading-none mt-1">1</span>
                
                <div class="w-full">
                  
                  <input 
                    v-model="repairId"
                    type="text" 
                    id="repairId"
                    class="w-full bg-transparent border-b border-gray-300 py-2 px-0 focus:outline-none focus:border-blue-500 transition-colors font-sans text-gray-900 text-lg placeholder-gray-400"
                    placeholder="Enter repairment ID number"
                    required
                  >
                  <!-- Keterangan -->
                  <p class="text-[10px] text-gray-400 mt-1 font-sans leading-tight">
                    *Required. Repairment ID must be 16 characters, including letters.
                  </p>
                </div>
              </div>
            </div>

            <!-- Input 2: Phone Number -->
            <div class="relative">
              <div class="flex items-start">
                <!-- Angka 2 Besar Biru -->
                <span class="text-blue-500 font-bold text-4xl mr-4 leading-none mt-1">2</span>
                
                <div class="w-full">
                  <input 
                    v-model="phoneNumber"
                    type="tel" 
                    id="phone"
                    class="w-full bg-transparent border-b border-gray-300 py-2 px-0 focus:outline-none focus:border-blue-500 transition-colors font-sans text-gray-900 text-lg placeholder-gray-400"
                    placeholder="Enter phone number"
                    required
                  >
                  <!-- Keterangan -->
                  <p class="text-[10px] text-gray-400 mt-1 font-sans leading-tight">
                    *Required. Ex: 0800-0000-0000
                  </p>
                </div>
              </div>
            </div>

            <!-- Tombol Check Status -->
            <div class="pt-4 text-center">
              <button 
                type="submit"
                :disabled="!isFormValid"
                :class="[
                  'font-sans font-bold py-3 px-8 rounded-full transition duration-300 shadow-sm text-sm border',
                  isFormValid 
                    ? 'bg-white border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700 hover:border-gray-300' 
                    : 'bg-gray-200 border-transparent text-gray-400 cursor-not-allowed'
                ]"
              >
                Check Status
              </button>
            </div>

          </form>
        </div>

      </div>
    </section>

    <!-- 3. SECTION: FIND SERVICE CENTER (PERBAIKAN PETA & AUTO SEARCH) -->
    <section class="py-8 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-8">
          <h2 class="text-3xl md:text-4xl font-bold mb-4 font-sans text-gray-900">
            Find our Service Center
          </h2>
          <p class="text-gray-600 font-sans leading-relaxed">
            Locate our service center in your area to request in-person gadget repair and get free offline consultation.
          </p>
        </div>

        <div class="max-w-4xl mx-auto">
          <!-- Search Bar -->
          <div class="relative mb-6">
            <!-- 
              @input="handleAutoSearch": Fungsi ini dipanggil setiap kali user mengetik.
            -->
            <input 
              v-model="searchQuery"
              @input="handleAutoSearch" 
              type="text" 
              placeholder="Enter city or region... (min 3 chars)" 
              class="w-full border border-gray-300 rounded-xl py-3 px-5 pl-5 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-500 font-sans shadow-sm"
            >
            <button class="absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-gray-400 hover:text-blue-600 transition-colors">
              <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>

          <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 h-[400px] w-full bg-gray-100 relative">
            
            <iframe 
              width="100%" 
              height="100%" 
              style="border:0" 
              loading="lazy" 
              allowfullscreen
              :src="mapUrl">
            </iframe>

          </div>

        </div>

      </div>
    </section>

  </div>
</template>

<script setup>
// Menggunakan gambar hero yang sama untuk header
// Gunakan '@' seperti yang sudah kita perbaiki
import { ref, computed } from 'vue';
import heroImage3 from '../components/assets/hero-background3.jpg';

// --- Logic Peta Otomatis ---
const searchQuery = ref('');
// Default map URL (Menampilkan Indonesia atau Service Center umum)
const defaultMapUrl = "https://maps.google.com/maps?q=Service+Center+Elektronik&t=&z=10&ie=UTF8&iwloc=&output=embed";
const mapUrl = ref(defaultMapUrl);

let searchTimeout = null;

const handleAutoSearch = () => {
  // Hapus timer sebelumnya jika user masih mengetik (Debounce)
  if (searchTimeout) clearTimeout(searchTimeout);

  // Tunggu 1.5 detik setelah user berhenti mengetik
  searchTimeout = setTimeout(() => {
    const query = searchQuery.value.trim();
    
    if (query.length > 3) {
      // Jika lebih dari 3 huruf, cari lokasi spesifik
      // Contoh query: "Service Center Elektronik Makassar"
      const finalQuery = `Service Center Elektronik ${query}`;
      mapUrl.value = `https://maps.google.com/maps?q=${encodeURIComponent(finalQuery)}&t=&z=12&ie=UTF8&iwloc=&output=embed`;
    } else if (query.length === 0) {
      // Jika kosong, kembali ke default
      mapUrl.value = defaultMapUrl;
    }
  }, 1500); // Delay 1500ms (1.5 detik)
};

// State Form
const repairId = ref('');
const phoneNumber = ref('');

// Computed Property untuk Cek Validasi
// Tombol hanya aktif jika repairId DAN phoneNumber tidak kosong
const isFormValid = computed(() => {
  return repairId.value.trim() !== '' && phoneNumber.value.trim() !== '';
});

// Fungsi Submit
const handleCheckStatus = () => {
  if (!isFormValid.value) return;
  
  // Simulasi cek status
  alert(`Checking status for ID: ${repairId.value} & Phone: ${phoneNumber.value}`);
};
</script>
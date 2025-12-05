<template>
  <div>
    
    <!-- HERO SECTION -->
    <section class="relative w-full">
      
      <img 
        :src="heroImage4" 
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
        <!-- 
          - text-2xl (HP): Font tidak terlalu besar.
          - md:text-6xl (Desktop): Font besar.
        -->
        <h1 class="font-sans font-bold text-2xl sm:text-4xl md:text-6xl mb-4 sm:mb-8 text-center leading-tight drop-shadow-lg">
          Fast, Trusted, and <br />
          Built to Last
        </h1>
        
        <!-- 
          TOMBOL REQUEST A REPAIR (LINK KE ORDER)
          - Menggunakan <router-link> agar pindah ke halaman /order
        -->
        <router-link 
          to="/order"
          class="font-sans bg-white text-black font-bold text-xs sm:text-base py-2 px-6 sm:py-3 sm:px-8 rounded-full hover:bg-gray-100 transition duration-300 shadow-xl inline-block"
        >
          Request a repair
        </router-link>

      </div>
    </section>

     <!-- 2. SECTION: CUSTOMER REVIEWS & TESTIMONIES -->
    <section class="py-12 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        
        <!-- Judul Section -->
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-sans text-gray-900">
          Customer Reviews & <br class="md:hidden" /> Testimonies
        </h2>

        <!-- LIST REVIEW -->
        <div class="space-y-6">

          <!-- REVIEW CARD 1 -->
          <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <!-- Header: Avatar & Nama -->
            <div class="flex items-center mb-4">
              <!-- Avatar Placeholder -->
              <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mr-4 overflow-hidden">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
              </div>
              <div>
                <h3 class="font-bold text-gray-900 font-sans">Jane Doe</h3>
                <!-- Bintang (Star Rating) -->
                <div class="flex text-yellow-400 text-sm">
                  <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
              </div>
            </div>
            
            <!-- Isi Review -->
            <p class="text-gray-600 text-sm font-sans leading-relaxed mb-4">
              "I am extremely impressed with Breevis! My laptop was completely dead and I needed it fixed urgently for work. The technician arrived on time, diagnosed the issue accurately, and completed the repair on the very same day. Transparent pricing and highly professional service. Thank you, Breevis!"
            </p>

            <!-- Footer Review (Upvote & Waktu) -->
            <div class="flex items-center text-gray-400 text-xs font-sans space-x-4">
              <div class="flex items-center space-x-1 hover:text-gray-600 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                <span>1</span>
              </div>
              <div class="flex items-center space-x-1 hover:text-gray-600 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                <span>0</span>
              </div>
              <span>•</span>
              <span>5 min ago</span>
            </div>
          </div>

          <!-- REVIEW CARD 2 -->
          <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mr-4 overflow-hidden">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
              </div>
              <div>
                <h3 class="font-bold text-gray-900 font-sans">John Smith</h3>
                <div class="flex text-yellow-400 text-sm">
                  <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
              </div>
            </div>
            <p class="text-gray-600 text-sm font-sans leading-relaxed mb-4">
              Very fast service! My laptop screen was replaced in just 2 hours. The technician was very professional and polite. Highly recommended!
            </p>
            <div class="flex items-center text-gray-400 text-xs font-sans space-x-4">
              <div class="flex items-center space-x-1 text-green-600 font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                <span>695</span>
              </div>
              <div class="flex items-center space-x-1 hover:text-gray-600 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                <span>0</span>
              </div>
              <span>•</span>
              <span>6 hour ago</span>
            </div>
          </div>

          <!-- REVIEW CARD 3 -->
          <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center mb-4">
              <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 mr-4 overflow-hidden">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
              </div>
              <div>
                <h3 class="font-bold text-gray-900 font-sans">Sarah Lee</h3>
                <div class="flex text-yellow-400 text-sm">
                  <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
              </div>
            </div>
            <p class="text-gray-600 text-sm font-sans leading-relaxed mb-4">
              Excellent service center. I tracked my repair status online easily. The price was transparent and affordable.
            </p>
            <div class="flex items-center text-gray-400 text-xs font-sans space-x-4">
              <div class="flex items-center space-x-1 text-red-600 font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                <span>1.4k</span>
              </div>
              <div class="flex items-center space-x-1 text-red-600 font-bold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                <span>1</span>
              </div>
              <span>•</span>
              <span>1 day ago</span>
            </div>
          </div>

        </div>

        <!-- Tombol Load More -->
        <div class="mt-10 text-center">
          <button class="font-sans bg-gray-100 text-gray-600 font-bold py-3 px-12 rounded-full hover:bg-gray-200 transition duration-300 w-full md:w-auto">
            Load More
          </button>
        </div>

      </div>
    </section>

    <!-- 3. SECTION: REQUEST A REPAIR (VERSI CARD) -->
    <section class="py-8 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="relative rounded-[2.5rem] overflow-hidden w-full max-w-4xl mx-auto h-[500px] shadow-2xl">
          
          <!-- Gambar Background (Di dalam Card) -->
          <img 
            :src="repairImage" 
            alt="Repair Action Background" 
            class="absolute inset-0 w-full h-full object-cover object-center"
          />
          
          <!-- Overlay Gelap -->
          <div class="absolute inset-0 bg-black bg-opacity-60"></div>

          <!-- Konten -->
          <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6">
            
            <!-- Ikon Obeng & Kunci Pas Silang (Putih Besar) -->
            <div class="mb-6">
              <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.232 15.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
            </div>

            <h2 class="text-3xl md:text-4xl font-bold mb-4 font-sans">Request a Repair</h2>
            
            <p class="text-base md:text-lg max-w-lg mb-8 font-sans text-gray-200 leading-relaxed">
              Request a repair in just a few simple steps and enjoy a fast, 
              hassle-free service experience from start to finish.
            </p>

            <!-- Tombol "Let's Start" -->
            <router-link 
              to="/order"
              class="font-sans bg-white text-black font-bold py-3 px-10 rounded-full hover:bg-gray-200 transition duration-300 shadow-lg"
            >
              Let's Start
            </router-link>

          </div>
        </div>

      </div>
    </section>

    <!-- 4. SECTION: FIND SERVICE CENTER (PERBAIKAN PETA & AUTO SEARCH) -->
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

          <!-- 
            PETA EMBED (IFRAME) 
            - Ini akan memuat peta interaktif langsung di dalam web.
            - URL-nya dinamis (mapUrl) berubah sesuai ketikan.
          -->
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
import { ref } from 'vue';
import heroImage4 from '../components/assets/hero-background4.jpg';
import repairImage from '../components/assets/Request-a-repair.jpg';

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
</script>
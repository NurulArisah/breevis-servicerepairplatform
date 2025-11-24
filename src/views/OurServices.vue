<template>
  <div>
    
    <!-- HERO SECTION -->
    <section class="relative w-full">
      
      <img 
        :src="heroImage2" 
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

    <!-- 2. SECTION: OUR SERVICES LIST -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
        
        <!-- Header Section -->
        <div class="text-center mb-16">
          <h2 class="text-3xl md:text-4xl font-bold mb-4 font-sans text-gray-900">
            Our Services
          </h2>
          <p class="text-gray-600 font-sans max-w-2xl mx-auto leading-relaxed">
            We offer comprehensive electronic repair services, carried out by skilled technicians 
            equipped with the latest tools and technology.
          </p>
        </div>

        <!-- LIST KARTU LAYANAN -->
        <div class="space-y-6 md:space-y-8">

          <!-- SERVICE 1: Smartphone & Tablet -->
          <!-- 
            [PERBAIKAN]: 
            - flex-row: Selalu horizontal (Gambar Kiri, Teks Kanan).
            - md:min-h-[450px]: Tinggi minimal hanya untuk desktop.
          -->
          <div class="bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-row border border-gray-100 md:min-h-[450px]">
            
            <!-- Gambar (Kiri): w-1/3 di HP, w-1/2 di Desktop -->
            <div class="w-1/3 md:w-1/2 relative min-h-[200px] md:min-h-auto">
              <img 
                src="../components/assets/hp.png" 
                alt="Smartphone Repair" 
                class="absolute inset-0 w-full h-full object-cover"
              >
            </div>
            
            <!-- Konten (Kanan): w-2/3 di HP, w-1/2 di Desktop -->
            <!-- Padding: p-4 di HP, p-12 di Desktop -->
            <div class="w-2/3 md:w-1/2 p-4 md:p-12 flex flex-col justify-center">
              <h3 class="text-lg md:text-3xl font-bold text-gray-900 mb-2 md:mb-4 font-sans leading-tight">
                Smartphone & Tablet
              </h3>
              <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-6 font-sans leading-relaxed">
                Repairs for all brands with original parts and guaranteed quality.
              </p>
              <!-- List disembunyikan di layar sangat kecil jika perlu, atau font dikecilkan -->
              <ul class="list-disc list-inside text-gray-700 font-sans space-y-1 md:space-y-2 text-xs md:text-base">
                <li>Screen replacement</li>
                <li>Motherboard repair</li>
                <li>Software fix</li>
              </ul>
            </div>
          </div>

          <!-- SERVICE 2: Laptop & Computer -->
          <div class="bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-row border border-gray-100 md:min-h-[450px]">
            <div class="w-1/3 md:w-1/2 relative min-h-[200px] md:min-h-auto">
              <img 
                src="../components/assets/laptop.png" 
                alt="Laptop Repair" 
                class="absolute inset-0 w-full h-full object-cover"
              >
            </div>
            <div class="w-2/3 md:w-1/2 p-4 md:p-12 flex flex-col justify-center">
              <h3 class="text-lg md:text-3xl font-bold text-gray-900 mb-2 md:mb-4 font-sans leading-tight">
                Laptop & Computer
              </h3>
              <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-6 font-sans leading-relaxed">
                Professional hardware and software repairs for laptops and desktops.
              </p>
              <ul class="list-disc list-inside text-gray-700 font-sans space-y-1 md:space-y-2 text-xs md:text-base">
                <li>Hardware upgrade</li>
                <li>OS reinstallation</li>
                <li>Virus removal</li>
              </ul>
            </div>
          </div>

          <!-- SERVICE 3: Printer -->
          <div class="bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-row border border-gray-100 md:min-h-[450px]">
            <div class="w-1/3 md:w-1/2 relative min-h-[200px] md:min-h-auto">
              <img 
                src="../components/assets/printer.png" 
                alt="Printer Repair" 
                class="absolute inset-0 w-full h-full object-cover"
              >
            </div>
            <div class="w-2/3 md:w-1/2 p-4 md:p-12 flex flex-col justify-center">
              <h3 class="text-lg md:text-3xl font-bold text-gray-900 mb-2 md:mb-4 font-sans leading-tight">
                Printer
              </h3>
              <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-6 font-sans leading-relaxed">
                Reliable repairs for all printer types and brands.
              </p>
              <ul class="list-disc list-inside text-gray-700 font-sans space-y-1 md:space-y-2 text-xs md:text-base">
                <li>Ink system fix</li>
                <li>Driver troubleshooting</li>
                <li>Paper jam fix</li>
              </ul>
            </div>
          </div>

          <!-- SERVICE 4: Television -->
          <div class="bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-row border border-gray-100 md:min-h-[450px]">
            <div class="w-1/3 md:w-1/2 relative min-h-[200px] md:min-h-auto">
              <img 
                src="../components/assets/tv.png" 
                alt="Television Repair" 
                class="absolute inset-0 w-full h-full object-cover"
              >
            </div>
            <div class="w-2/3 md:w-1/2 p-4 md:p-12 flex flex-col justify-center">
              <h3 class="text-lg md:text-3xl font-bold text-gray-900 mb-2 md:mb-4 font-sans leading-tight">
                Television
              </h3>
              <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-6 font-sans leading-relaxed">
                Expert repair services for LED, LCD, OLED, and Smart TVs.
              </p>
              <ul class="list-disc list-inside text-gray-700 font-sans space-y-1 md:space-y-2 text-xs md:text-base">
                <li>Panel replacement</li>
                <li>Power supply repair</li>
                <li>Firmware issues</li>
              </ul>
            </div>
          </div>

          <!-- SERVICE 5: Speaker & Audio -->
          <div class="bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-row border border-gray-100 md:min-h-[450px]">
            <div class="w-1/3 md:w-1/2 relative min-h-[200px] md:min-h-auto">
              <img 
                src="../components/assets/speaker.png" 
                alt="Speaker Repair" 
                class="absolute inset-0 w-full h-full object-cover"
              >
            </div>
            <div class="w-2/3 md:w-1/2 p-4 md:p-12 flex flex-col justify-center">
              <h3 class="text-lg md:text-3xl font-bold text-gray-900 mb-2 md:mb-4 font-sans leading-tight">
                Speaker & Audio
              </h3>
              <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-6 font-sans leading-relaxed">
                Restore clear, powerful sound for any speaker brand.
              </p>
              <ul class="list-disc list-inside text-gray-700 font-sans space-y-1 md:space-y-2 text-xs md:text-base">
                <li>Sound distortion fix</li>
                <li>Component replacement</li>
                <li>Connectivity issues</li>
              </ul>
            </div>
          </div>

          <!-- SERVICE 6: Air Conditioner -->
          <div class="bg-gray-50 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-row border border-gray-100 md:min-h-[450px]">
            <div class="w-1/3 md:w-1/2 relative min-h-[200px] md:min-h-auto">
              <img 
                src="../components/assets/ac.png" 
                alt="AC Repair" 
                class="absolute inset-0 w-full h-full object-cover"
              >
            </div>
            <div class="w-2/3 md:w-1/2 p-4 md:p-12 flex flex-col justify-center">
              <h3 class="text-lg md:text-3xl font-bold text-gray-900 mb-2 md:mb-4 font-sans leading-tight">
                Air Conditioner
              </h3>
              <p class="text-xs md:text-base text-gray-600 mb-3 md:mb-6 font-sans leading-relaxed">
                Repair and maintenance for all AC brands and types.
              </p>
              <ul class="list-disc list-inside text-gray-700 font-sans space-y-1 md:space-y-2 text-xs md:text-base">
                <li>Freon refill</li>
                <li>Cleaning & maintenance</li>
                <li>Compressor repair</li>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- 
      3. SECTION: REQUEST A REPAIR (VERSI CARD)
      - Tidak memenuhi panjang layar (ada di dalam container)
      - Bentuk Card dengan rounded corners besar
    -->
    <section class="py-8 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- 
          CARD UTAMA 
          - rounded-[2.5rem]: Sudut sangat bulat sesuai Figma
          - overflow-hidden: Agar gambar tidak bocor keluar sudut
          - max-w-4xl mx-auto: Membatasi lebar agar tidak terlalu lebar
          - h-[500px]: Tinggi yang cukup untuk konten
        -->
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
import heroImage2 from '../components/assets/hero-background2.jpg';
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
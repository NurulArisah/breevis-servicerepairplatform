<template>
  <div>
    
    <!-- 1. HEADER SECTION (JUDUL SAJA) -->
    <section class="pt-12 pb-8 bg-white">
      <div class="container mx-auto px-4 text-center">
        <!-- Judul About Us Hitam -->
        <h1 class="font-sans font-bold text-4xl md:text-5xl text-gray-900 mb-2">
          About Us
        </h1>
        <!-- Garis atau elemen dekorasi kecil jika perlu (opsional) -->
      </div>
    </section>

    <!-- 2. MAIN CONTENT (GAMBAR & DESKRIPSI) -->
    <section class="pb-16 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        
        <!-- Gambar Teknisi (Di tengah) -->
        <div class="w-full mb-10 rounded-3xl overflow-hidden shadow-lg">
          <!-- 
            Menggunakan gambar hero sebagai placeholder teknisi.
            Nanti ganti dengan foto asli teknisi Anda.
          -->
          <img 
            :src="heroImage5" 
            alt="Technician Working" 
            class="w-full h-[300px] md:h-[500px] object-cover object-center"
          >
        </div>

        <!-- Teks Deskripsi -->
        <div class="space-y-6 text-gray-700 font-sans text-base md:text-lg leading-relaxed text-justify">
          <p>
            At Breevis, we are committed to providing reliable, high-quality repair services for all your electronic devices. From smartphones and laptops to TVs, printers, and household electronics, our team of skilled technicians is dedicated to bringing your devices back to optimal performance.
          </p>
          <p>
            With years of experience and modern diagnostic tools, we ensure every repair is done with precision, transparency, and care. We believe in honest service, fair pricing, and long-term solutions—not temporary fixes. That’s why we only use trusted, high-quality spare parts and provide warranty coverage for selected repairs.
          </p>
        </div>

      </div>
    </section>

    <!-- 3. SECTION: VISION & MISSION -->
    <section class="py-12 md:py-20 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
          
          <!-- Vision -->
          <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-900 mb-4 font-sans text-center">Our Vision</h3>
            <p class="text-gray-600 text-center font-sans leading-relaxed">
              To be the most trusted and accessible electronic repair service provider in Indonesia, known for our speed, quality, and customer satisfaction.
            </p>
          </div>

          <!-- Mission -->
          <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-gray-100">
            <h3 class="text-2xl font-bold text-gray-900 mb-4 font-sans text-center">Our Mission</h3>
            <p class="text-gray-600 text-center font-sans leading-relaxed">
              To deliver fast, professional, and affordable repair solutions while educating customers on how to maintain their devices for long-term use.
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- 4. SECTION: WHY CHOOSE US (LENGKAP 5 POIN) -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-sans text-gray-900">
          Why Choose Us
        </h2>

        <div class="space-y-4">
          
          <!-- Poin 1: Experienced & certified technicians -->
          <div class="flex items-center p-6 rounded-2xl border border-gray-200 bg-white hover:shadow-md transition-shadow">
            <div class="flex-shrink-0 mr-6">
              <!-- Ikon Centang dalam Lingkaran -->
              <div class="w-12 h-12 rounded-full border-2 border-green-600 flex items-center justify-center text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
              </div>
            </div>
            <div>
              <h4 class="text-lg md:text-xl font-bold text-gray-900 font-sans">Experienced & certified technicians</h4>
            </div>
          </div>

          <!-- Poin 2: High-quality spare parts and tools -->
          <div class="flex items-center p-6 rounded-2xl border border-gray-200 bg-white hover:shadow-md transition-shadow">
            <div class="flex-shrink-0 mr-6">
              <!-- Ikon Gear (Sparepart) -->
              <div class="w-12 h-12 rounded-full border-2 border-black flex items-center justify-center text-black">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
              </div>
            </div>
            <div>
              <h4 class="text-lg md:text-xl font-bold text-gray-900 font-sans">High-quality spare parts and tools</h4>
            </div>
          </div>

          <!-- Poin 3: Warranty on parts & service -->
          <div class="flex items-center p-6 rounded-2xl border border-gray-200 bg-white hover:shadow-md transition-shadow">
            <div class="flex-shrink-0 mr-6">
              <!-- Ikon Gembok (Warranty/Secure) -->
              <div class="w-12 h-12 rounded-full border-2 border-black flex items-center justify-center text-black">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
              </div>
            </div>
            <div>
              <h4 class="text-lg md:text-xl font-bold text-gray-900 font-sans">Warranty on parts & service</h4>
            </div>
          </div>

          <!-- Poin 4: Transparent pricing -->
          <div class="flex items-center p-6 rounded-2xl border border-gray-200 bg-white hover:shadow-md transition-shadow">
            <div class="flex-shrink-0 mr-6">
              <!-- Ikon Chat Bubble (Transparent) -->
              <div class="w-12 h-12 rounded-full border-2 border-black flex items-center justify-center text-black">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
              </div>
            </div>
            <div>
              <h4 class="text-lg md:text-xl font-bold text-gray-900 font-sans">Transparent pricing with no hidden fees</h4>
            </div>
          </div>

          <!-- Poin 5: Online repair tracking -->
          <div class="flex items-center p-6 rounded-2xl border border-gray-200 bg-white hover:shadow-md transition-shadow">
            <div class="flex-shrink-0 mr-6">
              <!-- Ikon List/Menu (Tracking options) -->
              <div class="w-12 h-12 rounded-full border-2 border-black flex items-center justify-center text-black">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
              </div>
            </div>
            <div>
              <h4 class="text-lg md:text-xl font-bold text-gray-900 font-sans">Online repair tracking & doorstep service options</h4>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- 5. SECTION BARU: WHAT WE REPAIR -->
    <section class="py-12 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl text-center">
        
        <!-- Judul -->
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 font-sans">
          What We Repair
        </h2>

        <!-- List Devices -->
        <p class="text-gray-600 font-sans text-lg md:text-xl mb-10 max-w-3xl mx-auto leading-relaxed">
          Smartphones & Tablets | Laptops & Computers | TVs | Printers | Speakers & Audio Systems | Air Conditioners (AC)
        </p>

        <!-- Tombol See Details -->
        <div class="mb-12">
          <router-link 
            to="/services"
            class="font-sans bg-gray-100 text-gray-900 font-bold py-3 px-12 rounded-full hover:bg-gray-200 transition duration-300 text-lg"
          >
            See Details
          </router-link>
        </div>

      </div>
    </section>

    <!-- 6. SECTION: REQUEST A REPAIR (VERSI CARD)   -->
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

    <!-- 7. SECTION: FIND SERVICE CENTER (PERBAIKAN PETA & AUTO SEARCH) -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-sans text-gray-900">
          Our Location
        </h2>

        <!-- KARTU KANTOR PUSAT -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-200 mb-12">
          <!-- Gambar Kantor -->
          <div class="h-[300px] w-full relative">
            <!-- 
              Gunakan foto kantor asli jika ada. 
              Sementara pakai placeholder/heroImage.
            -->
            <img 
              :src="heroImage6" 
              alt="Main Service Center Office" 
              class="absolute inset-0 w-full h-full object-cover"
            >
          </div>
          
          <!-- Detail Alamat -->
          <div class="p-8 md:p-10">
            <h3 class="text-2xl font-bold text-gray-900 mb-4 font-sans text-center">Main Service Center</h3>
            
            <div class="space-y-4 text-gray-600 font-sans text-base leading-relaxed">
              <p class="text-center">Our primary headquarters located at:</p>
              
              <div class="text-center">
                <p class="font-bold text-gray-900">[Full Address]</p>
                <p>Jl. Pahlawan No. 123, Jakarta Selatan</p>
                <p>Near: Lorem Ipsum Landmark</p>
                <p class="mt-2"><span class="font-semibold">Open Hours:</span> Sun - Sat, 08.00 - 18.00 WITA</p>
              </div>

              <hr class="my-6 border-gray-200">

              <p class="text-justify">
                This central hub supports all repair operations, customer care, spare-parts distribution, and advanced diagnostics. Whether you need a quick fix or a complex repair, our main center is equipped to handle it all with professional standards.
              </p>
            </div>
          </div>
        </div>

        <!-- PENCARIAN LOKASI LAIN -->
        <div class="text-center mb-8">
          <h3 class="text-2xl font-bold text-gray-900 mb-4 font-sans">Other Service Location</h3>
          <p class="text-gray-600 font-sans max-w-2xl mx-auto">
            We are expanding to serve you closer to home. To find the nearest service center, please enter your city or region below:
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

    <!-- 
      [PERBAIKAN]: 
      - Memastikan max-w-3xl agar teks tidak terlalu melebar.
      - Menambahkan padding vertikal yang cukup (py-16).
      - Memastikan teks center dan rapi.
    -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 font-sans">
          Why It Works This Way?
        </h2>
        <p class="text-gray-600 font-sans text-base md:text-lg leading-relaxed">
          Each branch is staffed with trained technicians and equipped to handle full diagnostics and
          repairs, while our main office ensures consistent service quality, inventory availability, and technical
          support.
        </p>
      </div>
    </section>

    <!-- 8. SECTION BARU: NEED ANY HELP -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl text-center">
        
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 font-sans">
          Need Any Help?
        </h2>
        
        <p class="text-gray-600 font-sans text-base md:text-lg leading-relaxed mb-8">
          If you're not sure which branch to choose, have questions about our services, or are experiencing
          any issues, our team is here to assist you:
        </p>

        <!-- Contact List -->
        <div class="flex flex-col items-center space-y-4 mb-10">
          <!-- Hotline -->
          <div class="flex items-center text-gray-700 font-sans text-base md:text-lg">
            <svg class="w-6 h-6 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span><strong>Customer Hotline:</strong> (021) 567-8890</span>
          </div>
          <!-- WhatsApp -->
          <a href="https://wa.me/628111000765" target="_blank" class="flex items-center text-gray-700 font-sans text-base md:text-lg hover:text-green-600 transition-colors">
            <svg class="w-6 h-6 mr-3 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            <span><strong>WhatsApp Support:</strong> +62 811-1000-765</span>
          </a>
          <!-- Email -->
          <div class="flex items-center text-gray-700 font-sans text-base md:text-lg">
            <svg class="w-6 h-6 mr-3 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span><strong>Email:</strong> breevisrepair@gmail.com</span>
          </div>
        </div>

        <p class="text-gray-600 font-sans text-base leading-relaxed mb-2">
          At Breevis, your device is in good hands. Whether it's a simple fix or a complex repair, we're here to
          help you get back to what matters—quickly and confidently.
        </p>

        <h3 class="text-2xl font-bold text-gray-900 font-sans mt-6">
          Your trusted repair partner.
        </h3>

      </div>
    </section>

  </div>
</template>

<script setup>
// Menggunakan gambar hero yang sama untuk header
// Gunakan '@' seperti yang sudah kita perbaiki
import { ref } from 'vue';
import heroImage5 from '../components/assets/hero-background5.jpg';
import heroImage6 from '../components/assets/hero-background6.jpg';
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
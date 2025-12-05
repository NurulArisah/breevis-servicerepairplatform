<template>
  <div> <!-- Wrapper Utama -->

    <!-- HERO SECTION -->
    <section class="relative w-full">
      
      <!-- 
        GAMBAR LATAR (IMG TAG)
        - w-full: Lebar full.
        - h-[300px]: (MOBILE) Tinggi dikunci di 300px. Tidak akan kepanjangan lagi.
        - md:h-[600px]: (DESKTOP) Tinggi dikunci di 600px agar pas di layar besar.
        - object-cover: KUNCI UTAMA. Gambar akan di-crop otomatis (fill) agar pas di kotak tanpa gepeng.
        - object-center: Fokus gambar di tengah.
      -->
      <img 
        :src="heroImage" 
        alt="Hero Background" 
        class="w-full h-[300px] md:h-[600px] object-cover object-center block"
      />

      <!-- 
        OVERLAY (Transparan Terang)
        - bg-opacity-30: Tidak terlalu gelap, gambar terlihat jelas.
      -->
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
          Top 1 Repair Service <br />
          in Indonesia
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

    <!-- SECTION: HOW CAN WE HELP? -->
    <section class="py-12 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Judul Section -->
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-sans text-gray-900">
          How can we help?
        </h2>
        
        <!-- 
          GRID KARTU MENU
          - grid-cols-1: 1 kolom di HP (vertikal sesuai gambar Figma).
          - md:grid-cols-2 lg:grid-cols-4: 2 atau 4 kolom di layar besar agar rapi.
          - gap-6: Jarak antar kartu.
        -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          
          <!-- KARTU 1: Schedule Pick-up -->
          <router-link to="/order" class="group bg-gray-50 rounded-2xl p-8 flex flex-col items-center text-center hover:shadow-lg transition-shadow cursor-pointer">
            <!-- Ikon Obeng & Tang -->
            <div class="mb-4">
              <svg class="w-12 h-12 text-black group-hover:text-blue-600 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 font-sans underline decoration-2 underline-offset-4 decoration-transparent group-hover:decoration-blue-600 transition-all">
              Schedule a Pick-up Repair Request
            </h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed">
              Request a repair and have your damaged item picked up from home.
            </p>
          </router-link>

          <!-- KARTU 2: Find Service Center -->
          <router-link to="/services" class="group bg-gray-50 rounded-2xl p-8 flex flex-col items-center text-center hover:shadow-lg transition-shadow cursor-pointer">
            <!-- Ikon Lokasi -->
            <div class="mb-4">
              <svg class="w-12 h-12 text-black group-hover:text-blue-600 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 font-sans underline decoration-2 underline-offset-4 decoration-transparent group-hover:decoration-blue-600 transition-all">
              Find our Service Center
            </h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed">
              Visit our service center to submit a repair request in person.
            </p>
          </router-link>

          <!-- KARTU 3: Check Repair Status -->
          <router-link to="/track" class="group bg-gray-50 rounded-2xl p-8 flex flex-col items-center text-center hover:shadow-lg transition-shadow cursor-pointer">
            <!-- Ikon Info (Lingkaran i) -->
            <div class="mb-4">
              <svg class="w-12 h-12 text-black group-hover:text-blue-600 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 font-sans underline decoration-2 underline-offset-4 decoration-transparent group-hover:decoration-blue-600 transition-all">
              Check Repair Status
            </h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed">
              Have an item under repair? Check and track your repair status.
            </p>
          </router-link>

          <!-- KARTU 4: Consult your Gadget -->
            <a href= "https://wa.me/6285657353670" 
            target="_blank" class="group bg-gray-50 rounded-2xl p-8 flex flex-col items-center text-center hover:shadow-lg transition-shadow cursor-pointer">
            <!-- Ikon Headset -->
            <div class="mb-4">
              <svg class="w-12 h-12 text-black group-hover:text-blue-600 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414" />
              </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2 font-sans underline decoration-2 underline-offset-4 decoration-transparent group-hover:decoration-blue-600 transition-all">
              Consult your Gadget
            </h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed">
              Get a free device online check-up for your phone or laptop before the repair.
            </p>
          </a>
        </div>
      </div>
    </section>

    <!-- 
      3. SECTION: BENEFITS
      (Sesuai Desain Figma Terbaru)
    -->
    <section class="py-4 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
        
        <!-- Judul Section -->
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-sans text-gray-900 leading-tight">
          Benefits When Choosing <br class="hidden md:block" />
          a Trusted Repair Partner
        </h2>

        <!-- Grid 2x2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          
          <!-- BENEFIT 1: Certified Technician -->
          <div class="bg-gray-50 rounded-3xl p-8 flex flex-col items-center text-center hover:shadow-md transition-shadow">
            <!-- Ikon Centang Hijau -->
            <div class="mb-6">
              <svg class="w-16 h-16 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 font-sans">Certified Technician</h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed px-4">
              Handled by trained and certified experts to ensure professional and reliable service.
            </p>
          </div>

          <!-- BENEFIT 2: Guaranteed Repairs -->
          <div class="bg-gray-50 rounded-3xl p-8 flex flex-col items-center text-center hover:shadow-md transition-shadow">
            <!-- Ikon Obeng & Kunci Pas (Silang) -->
            <div class="mb-6">
              <svg class="w-16 h-16 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 font-sans">Guaranteed Repairs</h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed px-4">
              Every repair is backed by warranty for your peace of mind and confidence.
            </p>
          </div>

          <!-- BENEFIT 3: Premium-Grade Spare Parts -->
          <div class="bg-gray-50 rounded-3xl p-8 flex flex-col items-center text-center hover:shadow-md transition-shadow">
            <!-- Ikon Gear -->
            <div class="mb-6">
              <svg class="w-16 h-16 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 font-sans">Premium-Grade Spare Parts</h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed px-4">
              We use high-quality components for long-lasting performance and optimal results.
            </p>
          </div>

          <!-- BENEFIT 4: Safe & Secure -->
          <div class="bg-gray-50 rounded-3xl p-8 flex flex-col items-center text-center hover:shadow-md transition-shadow">
            <!-- Ikon Gembok -->
            <div class="mb-6">
              <svg class="w-16 h-16 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-3 font-sans">Safe & Secure</h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed px-4">
              Your device and data are protected through strict security and handling standards.
            </p>
          </div>

        </div>
      </div>
    </section>

    <!--      4. SECTION: REQUEST A REPAIR (VERSI CARD)   -->
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

    <!-- 5. SECTION: FIND SERVICE CENTER (PERBAIKAN PETA & AUTO SEARCH) -->
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

    <!-- 6. SECTION BARU: CHECK & TRACK -->
    <section class="py-8 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- KARTU CHECK & TRACK (Mirip Section 4) -->
        <div class="relative rounded-[2.5rem] overflow-hidden w-full max-w-4xl mx-auto h-[500px] shadow-2xl">
          <!-- Background Image -->
          <img 
            :src="trackgridImage" 
            alt="Check Track Background" 
            class="absolute inset-0 w-full h-full object-cover object-center"
          />
          <!-- Overlay Gelap -->
          <div class="absolute inset-0 bg-black bg-opacity-60"></div>

          <!-- Konten Tengah -->
          <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6">
            
            <!-- Ikon Info (Lingkaran i) -->
            <div class="mb-6">
              <svg class="w-20 h-20 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>

            <h2 class="text-3xl md:text-4xl font-bold mb-4 font-sans">Check & Track</h2>
            
            <p class="text-base md:text-lg max-w-lg mb-8 font-sans text-gray-200 leading-relaxed">
              Easily check and track the status of your repair, and stay informed 
              with real-time updates throughout the entire service process.
            </p>

            <!-- Tombol "Check it Here" -->
            <router-link 
              to="/track"
              class="font-sans bg-white text-black font-bold py-3 px-10 rounded-full hover:bg-gray-200 transition duration-300 shadow-lg"
            >
              Check it Here
            </router-link>

          </div>
        </div>

      </div>
    </section>

    <!-- 7. SECTION: CONSULT YOUR GADGET -->
    <!-- 
      [PERUBAHAN]: 
      Container menggunakan 'max-w-4xl' agar sama persis dengan 
      lebar Section 6 (Check & Track) yang ada di atasnya.
    -->
    <section class="py-8 bg-white pb-20">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        
        <div class="text-center mb-10">
          <h2 class="text-3xl md:text-4xl font-bold mb-2 font-sans text-gray-900 leading-tight">
            Consult your Gadget <br /> before Repair
          </h2>
          <p class="text-gray-600 font-sans">
            Benefit of consulting your gadget before requesting a repair
          </p>
        </div>

        <div class="space-y-4 mb-10">
          
          <!-- Kartu 1 -->
          <div class="bg-gray-50 rounded-2xl p-6 flex items-start text-left hover:shadow-md transition-shadow border border-gray-100">
            <div class="flex-shrink-0 mr-4">
              <svg class="w-8 h-8 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-bold text-gray-900 font-sans">Accurate Issue Diagnosis</h3>
              <p class="text-sm text-gray-600 font-sans">Understand what's wrong before committing to a repair.</p>
            </div>
          </div>

          <!-- Kartu 2 -->
          <div class="bg-gray-50 rounded-2xl p-6 flex items-start text-left hover:shadow-md transition-shadow border border-gray-100">
            <div class="flex-shrink-0 mr-4">
              <svg class="w-8 h-8 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-bold text-gray-900 font-sans">Know Repair Options Upfront</h3>
              <p class="text-sm text-gray-600 font-sans">Compare solutions, pricing, and timelines before deciding.</p>
            </div>
          </div>

          <!-- Kartu 3 -->
          <div class="bg-gray-50 rounded-2xl p-6 flex items-start text-left hover:shadow-md transition-shadow border border-gray-100">
            <div class="flex-shrink-0 mr-4">
              <svg class="w-8 h-8 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-bold text-gray-900 font-sans">Better Preparation</h3>
              <p class="text-sm text-gray-600 font-sans">Backup data, secure your device, and understand potential impacts.</p>
            </div>
          </div>

          <!-- Kartu 4 -->
          <div class="bg-gray-50 rounded-2xl p-6 flex items-start text-left hover:shadow-md transition-shadow border border-gray-100">
            <div class="flex-shrink-0 mr-4">
              <svg class="w-8 h-8 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-bold text-gray-900 font-sans">Transparent Expectations</h3>
              <p class="text-sm text-gray-600 font-sans">Know what to expect during the repair process.</p>
            </div>
          </div>

        </div>

        <!-- Tombol Hijau -->
        <div class="text-center">
          <a 
            href="https://wa.me/6285657353670" 
            target="_blank"
            class="font-sans bg-green-600 text-white font-bold py-3 px-8 rounded-full hover:bg-green-700 transition duration-300 shadow-lg inline-flex items-center"
          >
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Get a Free Consult Now
          </a>
        </div>
      </div>
    </section>

    <!-- 8. SECTION: FAQ -->
    <section class="py-8 bg-white">
      <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 font-sans text-gray-900">
          FAQ
        </h2>
        <div class="space-y-6">
          
          <!-- FAQ 1 -->
          <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-2 font-sans">How long does the repair process take?</h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed">
              Repair time depends on the type of device and issue. Most repairs are completed within 1-3 days, while complex cases may take longer. We will notify you with progress updates.
            </p>
          </div>

          <!-- FAQ 2 -->
          <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-2 font-sans">Is there any warranty for the repairs?</h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed">
              Yes. We provide a warranty for both parts and service. The warranty period varies depending on the component and device type.
            </p>
          </div>

          <!-- FAQ 3 -->
          <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-2 font-sans">Are the replacement parts original?</h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed">
              We use original and high-quality parts whenever available. If alternatives are needed, we will inform you and discuss the options before proceeding.
            </p>
          </div>

          <!-- FAQ 4 -->
          <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-2 font-sans">Can I track the status of my repair?</h3>
            <p class="text-sm text-gray-600 font-sans leading-relaxed">
              Absolutely. You can track your repair progress online and receive updates throughout the process.
            </p>
          </div>

        </div>
      </div>
    </section>

  </div>
</template>

<script setup>
import { ref } from 'vue';
import heroImage from '../components/assets/hero-background1.jpg';
import repairImage from '../components/assets/Request-a-repair.jpg';
import trackgridImage from '../components/assets/check-trackgrid.jpg';

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
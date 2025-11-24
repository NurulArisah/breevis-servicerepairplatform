<template>
  <!-- Background Hitam sesuai Figma -->
  <footer class="bg-black text-white py-12 border-t border-gray-800">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl relative">
      
      <div class="flex flex-col md:flex-row justify-between">
        
        <!-- BAGIAN KIRI: Navigasi & Sosmed -->
        <div class="mb-10 md:mb-0">
          
          <!-- 
            NAVIGASI LINK
            - active-class: Class ini OTOMATIS muncul jika kita sedang di halaman tsb.
            - decoration-2 underline-offset-8: Mengatur tebal & jarak garis bawah.
          -->
          <nav class="flex flex-col space-y-6 mb-10">
            <router-link 
              to="/services" 
              class="font-sans text-xl font-bold hover:text-gray-300 w-fit transition-colors"
              active-class="underline decoration-2 underline-offset-8 decoration-white"
            >
              Our Service
            </router-link>
            
            <router-link 
              to="/track" 
              class="font-sans text-xl font-bold hover:text-gray-300 w-fit transition-colors"
              active-class="underline decoration-2 underline-offset-8 decoration-white"
            >
              Track Repair Status
            </router-link>
            
            <router-link 
              to="/reviews" 
              class="font-sans text-xl font-bold hover:text-gray-300 w-fit transition-colors"
              active-class="underline decoration-2 underline-offset-8 decoration-white"
            >
              Reviews
            </router-link>
            
            <router-link 
              to="/about" 
              class="font-sans text-xl font-bold hover:text-gray-300 w-fit transition-colors"
              active-class="underline decoration-2 underline-offset-8 decoration-white"
            >
              About Us
            </router-link>
          </nav>

          <!-- SOCIAL MEDIA ICONS -->
          <div class="flex space-x-6">
            <!-- Facebook -->
            <a href="#" class="hover:text-gray-300 transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
            <!-- Twitter -->
            <a href="#" class="hover:text-gray-300 transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
            </a>
            <!-- Youtube -->
            <a href="#" class="hover:text-gray-300 transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
            </a>
            <!-- LinkedIn -->
            <a href="#" class="hover:text-gray-300 transition-colors">
              <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
          </div>

        </div>

        <!-- BAGIAN KANAN: Logo Besar di Bawah -->
        <!-- Di layar mobile dia akan di bawah, di desktop dia di kanan bawah -->
      </div>

      <!-- Garis Pemisah -->
      <div class="border-t border-gray-800 my-8"></div>

      <!-- Bagian Bawah: Copyright & Logo -->
      <div class="flex flex-col md:flex-row justify-between items-end">
        
        <!-- Copyright Text -->
        <div class="w-full md:w-auto mb-6 md:mb-0">
          <p class="text-sm text-gray-400 mb-1 font-sans">@ 2023 Breevis.co</p>
          <p class="text-sm text-gray-400 font-sans">All Right Reserved</p>
        </div>

        <!-- Logo Putih Besar -->
        <div>
           <!-- Pastikan Anda punya file 'breevis-logo-white.png' di assets -->
           <img src="../components/assets/breevis-logo.png" alt="Breevis" class="h-10 md:h-12 w-auto">
        </div>

      </div>

    </div>
  </footer>
</template>

<script setup>
import { RouterLink } from 'vue-router';
</script>
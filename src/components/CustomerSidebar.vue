<template>
  <!-- 
    Wrapper Utama (fixed, z-50)
    Menutupi seluruh layar
  -->
  <div class="fixed inset-0 z-50">
    
    <!-- 
      1. Overlay (Background Redup)
      Class 'sidebar-overlay' akan ditargetkan oleh animasi di Layout.
      Saat diklik, panggil fungsi 'closeSidebar'.
    -->
    <div 
      class="sidebar-overlay absolute inset-0 bg-black bg-opacity-60"
      @click="closeSidebar"
    ></div>

    <!-- 
      2. Panel Konten (Menu Putih)
      
      [PERUBAHAN 1 - UKURAN SIDEBAR]:
      - Awal: w-4/5 max-w-sm
      - Ubah jadi: w-full md:w-80
      (Artinya: Full layar di HP, tapi ramping (320px) di Laptop)
    -->
    <div 
      class="sidebar-panel relative ml-auto flex flex-col w-full md:w-80 h-full bg-white shadow-xl p-6"
    >
      
      <!-- 2a. Tombol Close (X) -->
      <div class="flex justify-end mb-8">
        <button @click="closeSidebar" class="p-2 text-gray-700 hover:text-black">
          <!-- SVG untuk ikon 'X' (Close) -->
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!-- 2b. Link Navigasi -->
      <!-- 
        [PERUBAHAN 2 - FONT]:
        - Saya ubah 'text-3xl' menjadi 'text-xl' (lebih kecil)
      -->
      <nav class="flex flex-col space-y-6">
        <router-link 
          to="/" 
          @click="closeSidebar" 
          class="text-xl font-bold text-gray-900 hover:text-blue-600"
        >
          Home
        </router-link>
        <router-link 
          to="/services" 
          @click="closeSidebar" 
          class="text-xl font-bold text-gray-900 hover:text-blue-600"
        >
          Our Services
        </router-link>
        <router-link 
          to="/track" 
          @click="closeSidebar" 
          class="text-xl font-bold text-gray-900 hover:text-blue-600"
        >
          Track Repair Status
        </router-link>
        <router-link 
          to="/reviews" 
          @click="closeSidebar" 
          class="text-xl font-bold text-gray-900 hover:text-blue-600"
        >
          Review
        </router-link>
        <router-link 
          to="/about" 
          @click="closeSidebar" 
          class="text-xl font-bold text-gray-900 hover:text-blue-600"
        >
          About Us
        </router-link>
      </nav>

      <!-- 
        2c. Tombol "Request a repair"
        
        [PERUBAHAN 3 - POSISI TOMBOL]:
      -->
      <div class="mt-6">
        <router-link 
          to="/order" 
          @click="closeSidebar"
          class="block w-full bg-black text-white text-center font-semibold rounded-full py-3 px-6 hover:bg-gray-800"
        >
          Request a repair
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';

// Daftarkan 'sinyal' yang akan dikirim ke parent (CustomerLayout)
const emit = defineEmits(['toggle-sidebar']);

// Fungsi untuk mengirim sinyal 'close'
// Ini akan dipanggil saat klik 'X', background, atau link
const closeSidebar = () => {
  emit('toggle-sidebar');
};
</script>
<template>
  <nav class="bg-white shadow-sm w-full sticky top-0 z-40">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- 
        PERBAIKAN: 
        Menggunakan 'justify-between' agar Logo di Kiri dan Tombol di Kanan.
        Menghapus posisi 'absolute' yang membuat logo di tengah.
      -->
      <div class="flex justify-between items-center h-16">
        
        <!-- Bagian Kiri: Logo Breevis -->
        <div class="flex-shrink-0 flex items-center">
          <router-link to="/">
            <img class="h-8 w-auto" src="../components/assets/breevis-logohitam.png" alt="Breevis Logo">
          </router-link>
        </div>

        <!-- Bagian Kanan: Tombol "Garis 3" (Hamburger) -->
        <div>
          <button 
            @click="$emit('toggle-sidebar')" 
            class="p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500"
          >
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
        
      </div>
    </div>
  </nav>
</template>

<script setup>
import { RouterLink } from 'vue-router';
const emit = defineEmits(['toggle-sidebar']);
</script>
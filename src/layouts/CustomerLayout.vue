<!-- src/layouts/CustomerLayout.vue -->
<template>
  <!-- 
    'flex flex-col min-h-screen' adalah trik Tailwind
    untuk membuat footer "menempel" di bawah
    meskipun konten halamannya pendek.
  -->
  <div class="flex flex-col min-h-screen bg-gray-50">
    
    <!-- 1. Navbar -->
    <CustomerNavbar @toggle-sidebar="toggleSidebar" />

    <!-- 2. Sidebar Mobile (Menu "Garis 3") -->
    <Transition name="sidebar-transition">
      <CustomerSidebar 
        v-if="isSidebarOpen" 
        @toggle-sidebar="toggleSidebar" 
      />
    </Transition>

    <!-- 3. Konten Utama Halaman -->
    <main class="flex-grow">
      <!-- "Jendela" tempat Home.vue, OurServices.vue, dll. akan dimuat -->
      <router-view />
    </main>
    
    <!-- 4. Footer -->
    <CustomerFooter />
    
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { RouterView } from 'vue-router';
// Impor semua "potongan" layout
import CustomerNavbar from '@/components/CustomerNavbar.vue';
import CustomerSidebar from '@/components/CustomerSidebar.vue'; 
import CustomerFooter from '@/components/CustomerFooter.vue';

// "Otak" untuk sidebar
const isSidebarOpen = ref(false);

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};
</script>

<!-- CSS untuk Animasi Sidebar -->
<style>
.sidebar-transition-enter-active .sidebar-overlay,
.sidebar-transition-leave-active .sidebar-overlay {
  transition: opacity 0.3s ease;
}
.sidebar-transition-enter-from .sidebar-overlay,
.sidebar-transition-leave-to .sidebar-overlay {
  opacity: 0;
}
.sidebar-transition-enter-active .sidebar-panel,
.sidebar-transition-leave-active .sidebar-panel {
  transition: transform 0.3s ease-in-out;
}
.sidebar-transition-enter-from .sidebar-panel,
.sidebar-transition-leave-to .sidebar-panel {
  transform: translateX(100%);
}
</style>
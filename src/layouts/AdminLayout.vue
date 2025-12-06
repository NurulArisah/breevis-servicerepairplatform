<template>
  <div class="min-h-screen bg-gray-50 font-sans flex">
    
    <!-- 1. SIDEBAR (KIRI - FIXED) -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col fixed h-full z-30 top-0 left-0">
      
      <!-- Logo Area -->
      <div class="h-20 flex items-center px-8 border-b border-gray-100">
        <!-- Safety Check: Tampilkan Gambar jika ada, Teks jika tidak -->
        <img v-if="logoImage" :src="logoImage" alt="Breevis" class="h-8 w-auto" />
        <span v-else class="text-2xl font-bold text-indigo-600">Breevis</span>
      </div>

      <!-- Menu Items -->
      <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu</p>

        <!-- Dashboard -->
        <router-link 
          :to="{ name: 'AdminDashboard' }" 
          class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors"
          active-class="bg-indigo-600 text-white shadow-md"
          :class="$route.name !== 'AdminDashboard' ? 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' : ''"
        >
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
          Dashboard
        </router-link>

        <!-- Order Management -->
        <router-link 
          :to="{ name: 'OrderManagement' }" 
          class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors"
          active-class="bg-indigo-600 text-white shadow-md"
          :class="$route.name !== 'OrderManagement' ? 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' : ''"
        >
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
          Order Management
        </router-link>

        <!-- Staff Management -->
        <router-link 
          :to="{ name: 'StaffManagement' }" 
          class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors"
          active-class="bg-indigo-600 text-white shadow-md"
          :class="$route.name !== 'StaffManagement' ? 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' : ''"
        >
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
          Staff Management
        </router-link>

        <!-- Finance Report -->
        <router-link 
          :to="{ name: 'FinanceReport' }" 
          class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors"
          active-class="bg-indigo-600 text-white shadow-md"
          :class="$route.name !== 'FinanceReport' ? 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' : ''"
        >
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
          Finance Report
        </router-link>

        <!-- Log Activities -->
        <router-link 
          :to="{ name: 'LogActivities' }" 
          class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-colors"
          active-class="bg-indigo-600 text-white shadow-md"
          :class="$route.name !== 'LogActivities' ? 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' : ''"
        >
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
          Log Activities
        </router-link>
      </nav>

      <!-- Logout Area -->
      <div class="p-4 border-t border-gray-100 bg-white">
        <button 
          @click="handleLogout" 
          class="flex items-center w-full px-4 py-3 text-sm font-medium text-gray-500 rounded-xl hover:bg-red-50 hover:text-red-600 transition-colors"
        >
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
          Logout
        </button>
      </div>
    </aside>

    <!-- 2. MAIN CONTENT WRAPPER (KANAN) -->
    <!-- ml-64 Wajib ada agar tidak tertutup sidebar -->
    <div class="flex-1 ml-64 flex flex-col h-screen overflow-hidden bg-gray-50">
      
      <!-- NAVBAR / HEADER (ATAS - STICKY) -->
      <header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex justify-between items-center px-8 z-20 sticky top-0 w-full">
        
        <!-- Judul Halaman Dinamis -->
        <h1 class="text-2xl font-bold text-gray-800">{{ pageTitle }}</h1>

        <!-- Kanan: Notifikasi & Profil -->
        <div class="flex items-center gap-6">
          
          <!-- Icon Notifikasi -->
          <button class="relative p-2 text-gray-400 hover:text-indigo-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
          </button>

          <!-- Profil User (LINK KE SETTINGS) -->
          <router-link 
            :to="{ name: 'UserSettings' }"
            class="flex items-center gap-3 pl-6 border-l border-gray-100 group cursor-pointer"
          >
            <div class="text-right hidden sm:block">
              <p class="text-sm font-bold text-gray-700 group-hover:text-indigo-600 transition-colors">{{ adminName }}</p>
              <p class="text-xs text-gray-500">Admin</p>
            </div>
            
            <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold border-2 border-white shadow-sm group-hover:border-indigo-200 group-hover:shadow-md transition-all">
              {{ adminName.charAt(0) }}
            </div>
          </router-link>

        </div>
      </header>

      <!-- CONTENT AREA -->
      <main class="flex-1 overflow-y-auto bg-gray-50 p-8">
        <router-view></router-view>
      </main>

    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { useAuthStore } from '../stores/auth.js';

// --- IMPORT GAMBAR ---
// Perhatikan path ini baik-baik. Jika folder 'assets' ada di src/assets, gunakan '@/assets/...'
// Jika folder assets ada di src/components/assets, gunakan path relatif yang benar.
import logoImage from '../components/assets/breevis-logohitam.png'; 

const router = useRouter();
const route = useRoute();
const authStore = useAuthStore();

const handleLogout = () => {
  authStore.logout();
  router.push('/admin/login');
};

const adminName = computed(() => {
  return authStore.user ? authStore.user.name : 'Admin';
});

// Judul Halaman Dinamis
const pageTitle = computed(() => {
  switch (route.name) {
    case 'AdminDashboard': return 'Dashboard';
    case 'OrderManagement': return 'Order Management';
    case 'StaffManagement': return 'Staff Management';
    case 'FinanceReport': return 'Finance Report';
    case 'LogActivities': return 'Log Activities';
    case 'UserSettings': return 'User Settings';
    default: return 'Admin Panel';
  }
});
</script>

<style scoped>
/* Scrollbar Customization for Sidebar */
.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #e5e7eb; 
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #d1d5db; 
}
</style>
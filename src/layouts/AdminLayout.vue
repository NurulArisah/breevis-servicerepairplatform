<template>
  <div class="flex h-screen bg-gray-100">
    
    <aside class="w-64 bg-gray-800 text-white p-4">
      <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
      <nav>
        <ul>
          <li class="mb-2">
            <router-link to="/admin/dashboard" class="hover:bg-gray-700 p-2 rounded block">
              Dashboard
            </router-link>
          </li>
          <li class="mt-10">
            <button @click="handleLogout" class="bg-red-600 hover:bg-red-700 p-2 rounded block w-full text-left">
              Logout
            </button>
          </li>
        </ul>
      </nav>
    </aside>

    <main class="flex-1 p-8 overflow-auto">
      <router-view />
    </main>
    
  </div>
</template>

<script setup>
import { RouterView, RouterLink } from 'vue-router';
import { useAuthStore } from '@/stores/auth'; // Impor "Otak"

const authStore = useAuthStore();

const handleLogout = () => {
  if (confirm('Anda yakin ingin logout?')) {
    authStore.logout(); // Panggil fungsi logout dari "Otak"
  }
};
</script>
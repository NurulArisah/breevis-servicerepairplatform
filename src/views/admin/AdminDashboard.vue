<template>
  <div>
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>
    <p class="mb-4">Selamat datang kembali, {{ adminName }}!</p>

    <div class="bg-white p-6 rounded-lg shadow-md">
      <p>Nanti Card, Grafik, dan Tabel pesanan terbaru ada di sini.</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { useAuthStore } from '@/stores/auth'; // Impor "Otak"

const authStore = useAuthStore();

// Ambil nama admin dari "Otak" untuk ditampilkan
const adminName = computed(() => {
  return authStore.user ? authStore.user.name : 'Admin';
});
</script>
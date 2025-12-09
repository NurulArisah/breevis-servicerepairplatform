<template>
  <div class="w-full max-w-sm">
    
    <div class="mb-8 text-center">
      <img 
        :src="logoImage"  
        alt="Breevis" 
        class="h-12 w-auto inline-block"
      >
    </div>

    <div class="bg-white rounded-xl shadow-xl p-8">
      
      <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">
        Login to your Account
      </h1>
      
      <form @submit.prevent="handleLogin" class="space-y-5">
        
        <div v-if="errorMessage" class="bg-red-100 text-red-700 px-4 py-3 rounded text-sm">
          {{ errorMessage }}
        </div>

        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
            User ID
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
              </svg>
            </div>
            <input 
              v-model="username" 
              type="text" 
              id="username" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 pl-10" 
              required
            >
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
            Password
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
              </svg>
            </div>
            <input 
              v-model="password" 
              :type="showPassword ? 'text' : 'password'" 
              id="password" 
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 pl-10 pr-10" 
              required
            >
            <button 
              type="button" 
              @click="toggleShowPassword" 
              class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700"
            >
              <svg v-if="!showPassword" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
              </svg>
              <svg v-else class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                <path d="M2.036 10.022a10.014 10.014 0 0115.928 0 1 1 0 01-1.414 1.414 8.014 8.014 0 00-13.1 0 1 1 0 01-1.414-1.414z" />
              </svg>
            </button>
          </div>
        </div>

        <button 
          type="submit" 
          :disabled="isLoading"
          class="w-full bg-indigo-600 text-white font-semibold py-2 px-4 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-indigo-400 disabled:cursor-not-allowed transition-colors"
        >
          {{ isLoading ? 'Loading...' : 'Login' }}
        </button>

      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router'; 
import { useAuthStore } from '../../stores/auth.js'; // Pastikan path ini benar
import logoImage from '../../components/assets/breevis-logo.png';

const router = useRouter(); 
const authStore = useAuthStore();

// Ubah default value jadi kosong
const username = ref(''); 
const password = ref('');
const showPassword = ref(false);
const isLoading = ref(false);
const errorMessage = ref(null);

const toggleShowPassword = () => {
  showPassword.value = !showPassword.value;
};

const handleLogin = async () => {
  errorMessage.value = null;
  isLoading.value = true; // 1. Mulai Loading

  try {
    // 2. Panggil fungsi login di Store (kita buat di Langkah 2)
    // NOTE: Backend biasanya butuh 'email', jadi kita kirim sebagai object
    const success = await authStore.login({ 
        email: username.value, // Asumsi backend butuh field 'email'
        password: password.value 
    });

    if (success) {
      // 3. Jika sukses, redirect ke Dashboard
      router.push({ name: 'AdminDashboard' }); 
    }
  } catch (err) {
    // 4. Tangkap Error dari Backend
    console.error(err);
    if (err.response && err.response.status === 401) {
        errorMessage.value = 'Email atau Password salah!';
    } else {
        errorMessage.value = 'Gagal terhubung ke server.';
    }
  } finally {
    isLoading.value = false; // 5. Stop Loading
  }
};
</script>
// src/main.js
import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import axios from 'axios' // Pastikan sudah install: npm install axios

// Impor CSS utama Anda (yang berisi Tailwind)
import './components/assets/main.css'

// --- Setup Aplikasi ---
const app = createApp(App)
const pinia = createPinia()

// 1. WAJIB: Gunakan Pinia DULU
app.use(pinia)

// 2. WAJIB: Panggil checkAuth() SETELAH Pinia dipakai
// Ini agar "Satpam" router tahu kita sudah login atau belum
import { useAuthStore } from './stores/auth'
const authStore = useAuthStore()
authStore.checkAuth()
if (authStore.token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${authStore.token}`
}

// 3. Gunakan Router
app.use(router)

// 4. "Nyalakan" Aplikasi
app.mount('#app')
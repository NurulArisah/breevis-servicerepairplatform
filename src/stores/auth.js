// src/stores/auth.js
import { defineStore } from 'pinia';
import axios from 'axios';
import router from '@/router'; // Kita akan import router di sini

// Ganti URL ini dengan API dari backend developer Anda
const API_URL = 'https://api.websiteanda.com/api/admin'; 

export const useAuthStore = defineStore('auth', {
  // state = "Memori"
  state: () => ({
    isLoggedIn: false,
    token: localStorage.getItem('token') || null,
    user: JSON.parse(localStorage.getItem('user')) || null,
  }),

  // actions = "Fungsi/Pekerjaan"
  actions: {
    async login(username, password) {
      try {
        // 1. Tembak API Login
        const response = await axios.post(`${API_URL}/login`, {
          username: username,
          password: password,
        });

        // 2. Ambil data dari backend
        const { token, user } = response.data;

        // 3. Simpan di "Memori" (state)
        this.token = token;
        this.user = user;
        this.isLoggedIn = true;

        // 4. Simpan di localStorage (biar tidak hilang saat refresh)
        localStorage.setItem('token', token);
        localStorage.setItem('user', JSON.stringify(user));

        // 5. Atur header default Axios untuk request API selanjutnya
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        // 6. Pindahkan user ke Halaman Dashboard
        router.push({ name: 'AdminDashboard' });
        return true;

      } catch (error) {
        console.error('Login gagal:', error);
        return false;
      }
    },

    logout() {
      // 1. Hapus dari "Memori"
      this.token = null;
      this.user = null;
      this.isLoggedIn = false;

      // 2. Hapus dari localStorage
      localStorage.removeItem('token');
      localStorage.removeItem('user');

      // 3. Hapus header Axios
      delete axios.defaults.headers.common['Authorization'];

      // 4. Pindahkan user ke Halaman Login
      router.push({ name: 'AdminLogin' });
    },

    checkAuth() {
      // Fungsi ini dicek setiap kali web dibuka
      if (this.token) {
        this.isLoggedIn = true;
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      } else {
        this.isLoggedIn = false;
      }
    }
  }
});
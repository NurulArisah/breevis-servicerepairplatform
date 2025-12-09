// src/stores/auth.js
import { defineStore } from 'pinia';
import axios from 'axios';
import router from '@/router'; 

// 1. UBAH INI: Arahkan ke Localhost Laravel Anda
const BASE_URL = 'http://127.0.0.1:8000/api'; 

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isLoggedIn: false,
    token: localStorage.getItem('token') || null,
    user: JSON.parse(localStorage.getItem('user')) || null,
  }),

  actions: {
    // Terima parameter sebagai object (lebih rapi)
    async login({ email, password }) {
      try {
        // 2. TEMBAK API: Perhatikan payload pengiriman
        // Laravel default-nya butuh field 'email', bukan 'username'.
        // Jadi kita kirim input username kita sebagai 'email' ke backend.
        const response = await axios.post(`${BASE_URL}/admin/login`, {
        email,
        password,
    });


        // 3. AMBIL DATA: Sesuaikan dengan respon Laravel
        // Biasanya responnya: { token: "...", user: { ... } }
        const { token, user } = response.data; // atau response.data.data tergantung format backend

        // Simpan ke State
        this.token = token;
        this.user = user;
        this.isLoggedIn = true;

        // Simpan ke LocalStorage
        localStorage.setItem('token', token);
        localStorage.setItem('user', JSON.stringify(user));

        // Set Header Default untuk request selanjutnya
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        // Redirect
        router.push({ name: 'AdminDashboard' });
        return true;

      } catch (error) {
        console.error('Login gagal:', error.response?.data || error.message);
        // Lempar error agar bisa ditangkap di AdminLogin.vue untuk menampilkan pesan merah
        throw error.response?.data?.message || "Login gagal"; 
      }
    },

    logout() {
      // Panggil API logout di backend (Opsional tapi disarankan)
      if (this.token) {
        axios.post(`${BASE_URL}/admin/logout`, {}, {
            headers: { Authorization: `Bearer ${this.token}` }
        }).catch(err => console.log('Logout API error', err));
      }

      // Hapus data lokal
      this.token = null;
      this.user = null;
      this.isLoggedIn = false;

      localStorage.removeItem('token');
      localStorage.removeItem('user');
      delete axios.defaults.headers.common['Authorization'];

      router.push({ name: 'AdminLogin' });
    },

    checkAuth() {
      // Pastikan token tetap nempel di header saat halaman di-refresh
      if (this.token) {
        this.isLoggedIn = true;
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
      } else {
        this.isLoggedIn = false;
        delete axios.defaults.headers.common['Authorization'];
      }
    }
  }
});
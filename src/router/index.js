// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';

// KITA AKAN GUNAKAN '@' KARENA INI JALAN PINTAS KE 'src/'
// INI ADALAH CARA YANG BENAR
import { useAuthStore } from '../stores/auth'; 

// --- IMPORT LAYOUT (BUNGKUSAN) ---
import AdminLayout from '../layouts/AdminLayout.vue';
import LoginLayout from '../layouts/LoginLayout.vue';
import CustomerLayout from '../layouts/CustomerLayout.vue'; // <-- Pakai '@'

// --- IMPORT HALAMAN ADMIN ---
import AdminLogin from '../views/admin/AdminLogin.vue';
import AdminDashboard from '../views/admin/AdminDashboard.vue';

// --- IMPORT HALAMAN CUSTOMER ---
import Home from '../views/Home.vue';
import OurServices from '../views/OurServices.vue';
import TrackRepair from '../views/TrackRepair.vue';
import Review from '../views/Review.vue';
import AboutUs from '../views/AboutUs.vue';
import Order from '../views/Order.vue';
import Receipt from '../views/Receipt.vue';

const routes = [
  // ===================================
  // --- BLOK RUTE CUSTOMER ---
  // ===================================
  {
    path: '/',
    component: CustomerLayout,
    children: [
      { path: '', name: 'Home', component: Home },
      { path: 'services', name: 'OurServices', component: OurServices },
      { path: 'track', name: 'TrackRepair', component: TrackRepair },
      { path: 'reviews', name: 'Review', component: Review },
      { path: 'about', name: 'AboutUs', component: AboutUs },
      { path: 'order', name: 'Order', component: Order },
      { path: 'receipt', name: 'Receipt', component: Receipt }
    ]
  },

  // ===================================
  // --- BLOK RUTE ADMIN ---
  // ===================================
  {
    path: '/admin',
    component: AdminLayout,
    meta: { requiresAuth: true }, 
    children: [
      { path: 'dashboard', name: 'AdminDashboard', component: AdminDashboard },
    ]
  },
  {
    path: '/admin/login',
    component: LoginLayout,
    meta: { requiresGuest: true },
    children: [
      { path: '', name: 'AdminLogin', component: AdminLogin }
    ]
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// --- "SATPAM" ROUTER (TETAP SAMA) ---
router.beforeEach((to, from, next) => {
  // Pastikan store diinisialisasi di main.js SEBELUM router
  try {
    const authStore = useAuthStore();
    const requiresAuth = to.meta.requiresAuth;
    const requiresGuest = to.meta.requiresGuest;

    if (requiresAuth && !authStore.isLoggedIn) {
      next({ name: 'AdminLogin' });
    } else if (requiresGuest && authStore.isLoggedIn) {
      next({ name: 'AdminDashboard' });
    } else {
      next();
    }
  } catch (error) {
    // Ini terjadi jika main.js belum inisialisasi pinia
    // atau jika ada masalah impor
    console.error("Error di navigation guard:", error);
    // Jika auth store belum siap, mungkin lempar ke login
    if (to.meta.requiresAuth) {
      next({ name: 'AdminLogin' });
    } else {
      next();
    }
  }
});

export default router;
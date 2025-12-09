import { defineStore } from 'pinia';
import axios from 'axios';

const BASE_URL = 'http://127.0.0.1:8000/api/admin'; 

export const useStaffStore = defineStore('staff', {
  state: () => ({
    staffList: [],
    loading: false
  }),

  actions: {
    async fetchStaff() {
      this.loading = true;
      try {
        const response = await axios.get(`${BASE_URL}/technicians`);
        this.staffList = response.data.data;
      } catch (err) {
        console.error("Gagal ambil staff:", err);
      } finally {
        this.loading = false;
      }
    },

    async addStaff(newStaff) {
      try {
        await axios.post(`${BASE_URL}/technicians`, newStaff);
        this.fetchStaff(); // Refresh list setelah tambah
        return true;
      } catch (err) {
        alert("Gagal menambah staff");
        return false;
      }
    }
  }
});
import { defineStore } from 'pinia';
import axios from 'axios';

const BASE_URL = 'http://127.0.0.1:8000/api/admin'; 

export const useFinanceStore = defineStore('finance', {
  state: () => ({
    transactions: [],
    summary: { income: 0, expense: 0, revenue: 0 },
    loading: false
  }),

  getters: {
    // Filter otomatis untuk Tab Income & Expense
    incomeList: (state) => state.transactions.filter(t => t.type === 'income'),
    expenseList: (state) => state.transactions.filter(t => t.type === 'expense'),
  },

  actions: {
    async fetchFinance() {
      try {
        const token = localStorage.getItem('token');
        if (!token) return;

        // 1. Ambil Data dari Backend
        const response = await axios.get(`${BASE_URL}/transactions`, {
            headers: { Authorization: `Bearer ${token}` }
        });

        // Cek struktur respon backend di console
        console.log("Data dari Backend:", response.data); 

        // 2. Mapping Data (PENTING!)
        // Backend (snake_case) -> Frontend (camelCase sesuai template)
        const rawData = response.data; // Sesuaikan jika backend membungkus di response.data.data
        
        const mappedData = rawData.map(item => ({
        originalId: item.transaction_id,
        transId: `#TRX-${item.transaction_id}`,
        name: item.notes || 'General',

        // Fix kategori
        type: item.transaction_category,       // income/expense
        transType: item.transaction_category === 'income'
            ? 'Service Payment'
            : 'Cash Advance',                  // fallback aman

        paymentType: item.payment_method,
        amount: new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(item.amount),

        rawAmount: item.amount,

        date: item.transaction_date,
        time: new Date(item.created_at).toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        }),

        status: item.status
    }));


        // 3. Simpan ke State Utama
        this.transactions = mappedData;

        // 4. Hitung Ulang Summary (Opsional, agar kartu atas update)
        this.calculateSummary();

      } catch (error) {
        console.error("Gagal load finance:", error);
      }
    },

    calculateSummary() {
        const totalIncome = this.incomeList.reduce((acc, item) => acc + Number(item.rawAmount), 0);
        const totalExpense = this.expenseList.reduce((acc, item) => acc + Number(item.rawAmount), 0);
        
        this.summary.income = totalIncome;
        this.summary.expense = totalExpense;
        this.summary.revenue = totalIncome - totalExpense;
    },

    async updateStatus(id, newStatus) {
       // ... logika update status kamu yang lama ...
       // Pastikan setelah update sukses, panggil this.fetchFinance() lagi
    }
  }
});
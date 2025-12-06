<template>
  <div class="space-y-6 relative">
    
    <!-- 1. STATS CARDS ROW (Gradient) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Revenue -->
      <div class="bg-gradient-to-r from-[#4834d4] to-[#686de0] text-white p-5 rounded-xl relative overflow-hidden shadow-lg">
        <div class="relative z-10">
          <h3 class="text-4xl font-bold">Rp2,8K</h3>
          <p class="text-indigo-100 text-xs font-medium uppercase mt-1">Revenue</p>
          <div class="mt-4 flex items-center text-[10px] text-indigo-100">update: 13:12 wita</div>
        </div>
        <div class="absolute right-3 top-4 opacity-20">
          <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
      </div>
      <!-- Expense -->
      <div class="bg-gradient-to-r from-[#c0392b] to-[#e74c3c] text-white p-5 rounded-xl relative overflow-hidden shadow-lg">
        <div class="relative z-10">
          <h3 class="text-4xl font-bold">-Rp1,2K</h3>
          <p class="text-red-100 text-xs font-medium uppercase mt-1">Expense</p>
          <div class="mt-4 flex items-center text-[10px] text-red-100">update: 13:12 wita</div>
        </div>
        <div class="absolute right-3 top-4 opacity-20">
          <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
        </div>
      </div>
      <!-- Income -->
      <div class="bg-gradient-to-r from-[#27ae60] to-[#2ecc71] text-white p-5 rounded-xl relative overflow-hidden shadow-lg">
        <div class="relative z-10">
          <h3 class="text-4xl font-bold">Rp1,6K</h3>
          <p class="text-green-100 text-xs font-medium uppercase mt-1">Income</p>
          <div class="mt-4 flex items-center text-[10px] text-green-100">update: 13:12 wita</div>
        </div>
        <div class="absolute right-3 top-4 opacity-20">
           <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>
        </div>
      </div>
    </div>

    <!-- 2. TABS NAVIGATION -->
    <div class="border-b border-gray-200">
      <nav class="-mb-px flex space-x-8">
        <button 
          @click="activeTab = 'income_expense'"
          :class="activeTab === 'income_expense' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
          class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
        >
          Income & Expenses
        </button>
        <button 
          @click="activeTab = 'transaction_log'"
          :class="activeTab === 'transaction_log' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
          class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
        >
          Transaction Log
        </button>
      </nav>
    </div>

    <!-- TAB 1: INCOME & EXPENSES -->
    <div v-if="activeTab === 'income_expense'" class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-fade-in">
      <!-- Left Table -->
      <div class="bg-white rounded-xl shadow-sm p-6 flex flex-col h-full">
        <div class="flex justify-between items-center mb-4">
           <h3 class="text-lg font-bold text-gray-400">Income</h3>
           <select class="text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded border border-gray-200 focus:outline-none focus:border-indigo-500 cursor-pointer">
             <option>This Month</option>
           </select>
        </div>
        <div class="overflow-x-auto flex-1">
          <table class="w-full text-left">
            <thead>
              <tr class="text-[10px] font-bold text-gray-900 border-b border-gray-100">
                <th class="pb-3">Name</th>
                <th class="pb-3">Type</th>
                <th class="pb-3">Date</th>
                <th class="pb-3 text-right">Amount</th>
              </tr>
            </thead>
            <tbody class="text-[10px] text-gray-600">
              <tr v-for="(item, i) in incomeData" :key="i" class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                <td class="py-3 font-medium text-gray-800">{{ item.name }}</td>
                <td class="py-3">{{ item.type }}</td>
                <td class="py-3"><div>{{ item.date }}</div><div class="text-gray-400">{{ item.time }}</div></td>
                <td class="py-3 text-right font-bold text-green-500">{{ item.amount }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Right Table -->
      <div class="bg-white rounded-xl shadow-sm p-6 flex flex-col h-full">
        <div class="flex justify-between items-center mb-4">
           <h3 class="text-lg font-bold text-gray-400">Expense</h3>
           <select class="text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded border border-gray-200 focus:outline-none focus:border-indigo-500 cursor-pointer">
             <option>This Month</option>
           </select>
        </div>
        <div class="overflow-x-auto flex-1">
          <table class="w-full text-left">
            <thead>
              <tr class="text-[10px] font-bold text-gray-900 border-b border-gray-100">
                <th class="pb-3">Name</th>
                <th class="pb-3">Type</th>
                <th class="pb-3">Date</th>
                <th class="pb-3 text-right">Amount</th>
              </tr>
            </thead>
            <tbody class="text-[10px] text-gray-600">
              <tr v-for="(item, i) in expenseData" :key="i" class="border-b border-gray-50 last:border-0 hover:bg-gray-50">
                <td class="py-3 font-medium text-gray-800">{{ item.name }}</td>
                <td class="py-3">{{ item.type }}</td>
                <td class="py-3"><div>{{ item.date }}</div><div class="text-gray-400">{{ item.time }}</div></td>
                <td class="py-3 text-right font-bold text-red-500">{{ item.amount }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- TAB 2: TRANSACTION LOG -->
    <div v-if="activeTab === 'transaction_log'" class="bg-white rounded-xl shadow-sm p-6 animate-fade-in">
        
        <div class="mb-6">
           <h2 class="text-xl font-bold text-gray-700">Recent Transaction</h2>
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap gap-3 mb-6 items-center justify-between">
           <div class="flex gap-2 flex-wrap">
              <div class="relative">
                 <input type="date" class="pl-8 pr-3 py-1.5 border border-gray-200 rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-gray-50">
                 <svg class="w-4 h-4 text-gray-400 absolute left-2.5 top-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
              </div>
              <select class="px-3 py-1.5 border border-gray-200 rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-gray-50">
                 <option value="">Transaction Type</option>
                 <option value="Service Payment">Service Payment</option>
                 <option value="Cash Advance">Cash Advance</option>
              </select>
              <select class="px-3 py-1.5 border border-gray-200 rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-gray-50">
                 <option value="">Payment Type</option>
                 <option value="Cash on Delivery">Cash on Delivery</option>
                 <option value="Bank Transfer">Bank Transfer</option>
              </select>
              <select class="px-3 py-1.5 border border-gray-200 rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-gray-50">
                 <option value="">Payment Status</option>
                 <option value="Unpaid">Unpaid</option>
                 <option value="Completed">Completed</option>
              </select>
           </div>
           <div class="relative w-full sm:w-64">
              <input type="text" placeholder="Search" class="w-full pl-9 pr-4 py-1.5 border border-gray-200 rounded-lg text-sm bg-gray-50 focus:outline-none focus:border-indigo-500">
              <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
           </div>
        </div>

        <!-- Transaction Table -->
        <div class="overflow-x-auto custom-scrollbar pb-2">
           <table class="w-full text-left border-collapse">
              <thead>
                 <tr class="text-xs font-bold text-gray-900 border-b border-gray-100 whitespace-nowrap">
                    <th class="py-3 px-4">Transaction ID</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Transaction Type</th>
                    <th class="py-3 px-4">Payment Type</th>
                    <th class="py-3 px-4">Amount</th>
                    <th class="py-3 px-4">Date</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                 </tr>
              </thead>
              <tbody class="text-xs text-gray-600">
                 <tr v-for="(item, index) in transactionData" :key="index" class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                    <td class="py-4 px-4 font-medium text-gray-800">{{ item.transId }}</td>
                    <td class="py-4 px-4">
                       <div class="font-bold text-gray-900">{{ item.name }}</div>
                       <div v-if="item.subId" class="text-[10px] text-gray-400">{{ item.subId }}</div>
                    </td>
                    <td class="py-4 px-4">{{ item.transType }}</td>
                    <td class="py-4 px-4">{{ item.paymentType }}</td>
                    <td class="py-4 px-4 font-bold" :class="item.type === 'income' ? 'text-green-500' : 'text-red-500'">{{ item.amount }}</td>
                    <td class="py-4 px-4"><div>{{ item.date }}</div><div class="text-gray-400 text-[10px]">{{ item.time }}</div></td>
                    <td class="py-4 px-4 text-center">
                       <span :class="item.status === 'Unpaid' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600'" class="px-3 py-1 rounded-full text-[10px] font-bold uppercase inline-block min-w-[80px]">{{ item.status }}</span>
                    </td>
                    <td class="py-4 px-4">
                       <div class="flex items-center justify-center gap-2">
                          <!-- INFO BUTTON (TRIGGER DETAIL MODAL) -->
                          <button @click="openDetailModal(item)" class="p-1 text-gray-400 hover:text-indigo-600 border border-gray-200 rounded-full">
                             <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                          </button>
                          
                          <button v-if="item.status === 'Unpaid'" class="bg-green-500 text-white text-[10px] px-3 py-1 rounded-full hover:bg-green-600 transition-colors font-medium">Confirm</button>
                          <button v-else class="border border-gray-300 text-gray-400 text-[10px] px-3 py-1 rounded-full cursor-not-allowed font-medium">Confirm</button>
                          <button class="bg-red-500 text-white text-[10px] px-3 py-1 rounded-full hover:bg-red-600 transition-colors font-medium">Cancel</button>
                       </div>
                    </td>
                 </tr>
              </tbody>
           </table>
        </div>

        <!-- Footer: Pagination & Add Button -->
        <div class="flex justify-between items-center mt-4 pt-2 border-t border-gray-50">
           <div class="flex items-center gap-4">
              <span class="text-[10px] text-gray-400">Shows {{ transactionData.length }} results</span>
              <button @click="openAddModal" class="w-6 h-6 flex items-center justify-center rounded border border-gray-200 hover:bg-indigo-50 hover:text-indigo-600 text-gray-500 transition-colors" title="Add New Transaction">
                 <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
              </button>
              <button class="w-6 h-6 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50 hover:text-gray-700 text-gray-500 transition-colors">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
              </button>
              <button class="flex items-center gap-2 px-3 py-1 bg-white border border-gray-200 rounded-lg text-[10px] font-medium text-gray-600 hover:bg-gray-50">
                 <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                 Export as
              </button>
           </div>
           <div class="flex gap-1">
              <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500">&lt;</button>
              <button class="w-6 h-6 flex items-center justify-center rounded bg-black text-white font-bold text-xs">1</button>
              <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500">2</button>
              <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500">3</button>
              <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500">4</button>
              <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500">5</button>
              <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500">&gt;</button>
           </div>
        </div>
    </div>

    <!-- Pagination Footer for Income Tab -->
    <div v-if="activeTab === 'income_expense'" class="flex justify-end text-[10px] text-gray-400 gap-2">
       <span>Export as</span>
       <div class="flex gap-1">
          <span>&lt;</span> <span class="font-bold text-black">1</span> <span>2</span> <span>3</span> <span>4</span> <span>5</span> <span>&gt;</span>
       </div>
    </div>

    <!-- MODAL: ADD NEW TRANSACTION -->
    <div v-if="showAddModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4">
      <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative animate-fade-in">
        <div class="flex justify-between items-center mb-6">
           <h3 class="text-lg font-bold text-gray-900">Add New Transaction</h3>
           <button @click="closeAddModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
           </button>
        </div>
        <div class="space-y-4">
           <div>
              <label class="block text-xs font-bold text-gray-700 mb-1">Transaction Type</label>
              <select v-model="newTransForm.type" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                 <option value="" disabled selected>Select transaction type</option>
                 <option value="Cash Advance">Cash Advance</option>
                 <option value="Refund">Refund</option>
              </select>
           </div>
           <div v-if="newTransForm.type === 'Cash Advance'" class="space-y-4 animate-fade-in">
              <div>
                 <label class="block text-xs font-bold text-gray-700 mb-1">Technician Name</label>
                 <select class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>Find technician</option>
                    <option>Tama Setiawan</option>
                    <option>Budi Santoso</option>
                 </select>
              </div>
              <div>
                 <label class="block text-xs font-bold text-gray-700 mb-1">Bank Name</label>
                 <input type="text" placeholder="Enter bank name" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
              </div>
              <div>
                 <label class="block text-xs font-bold text-gray-700 mb-1">Account Number</label>
                 <input type="text" placeholder="Enter account number" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
              </div>
              <div>
                 <label class="block text-xs font-bold text-gray-700 mb-1">Amount</label>
                 <input type="text" placeholder="Enter amount number" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
              </div>
              <div>
                 <label class="block text-xs font-bold text-gray-700 mb-1">Notes</label>
                 <input type="text" placeholder="Add notes..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
              </div>
           </div>
           <div v-if="newTransForm.type === 'Refund'" class="space-y-4 animate-fade-in">
              <div>
                 <label class="block text-xs font-bold text-gray-700 mb-1">Order ID</label>
                 <input type="text" placeholder="Enter order ID" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
              </div>
              <div>
                 <label class="block text-xs font-bold text-gray-700 mb-1">Notes</label>
                 <input type="text" placeholder="Add notes..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
              </div>
           </div>
        </div>
        <div class="flex gap-3 mt-8">
           <button @click="closeAddModal" class="flex-1 py-2.5 bg-red-500 text-white text-xs font-bold rounded-xl hover:bg-red-600 transition-colors">Cancel</button>
           <button class="flex-1 py-2.5 border border-gray-300 bg-white text-gray-700 text-xs font-bold rounded-xl hover:bg-gray-50 transition-colors">Add</button>
        </div>
      </div>
    </div>

    <!-- MODAL: TRANSACTION DETAIL (NEW) -->
    <div v-if="showDetailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4">
      <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col overflow-hidden animate-fade-in">
        
        <!-- Header -->
        <div class="p-6 border-b border-gray-100 flex justify-between items-start">
           <div>
              <div class="flex items-center gap-3">
                 <h3 class="text-xl font-bold text-gray-900">Transaction <span class="text-gray-400">{{ selectedTransaction?.transId }}</span></h3>
                 <span class="px-3 py-1 rounded-full text-xs font-bold"
                       :class="selectedTransaction?.status === 'Unpaid' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600'">
                    {{ selectedTransaction?.status }}
                 </span>
              </div>
              <p class="text-xs text-gray-500 mt-1">Created on {{ selectedTransaction?.date }} at {{ selectedTransaction?.time }}</p>
           </div>
           <button @click="closeDetailModal" class="text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
           </button>
        </div>

        <!-- Body (Scrollable) -->
        <div class="p-8 overflow-y-auto custom-scrollbar flex-1">
           <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
              
              <!-- LEFT COLUMN -->
              <div class="space-y-6">
                 <!-- Customer Info -->
                 <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-3">Costumer Information</h4>
                    <div class="text-xs space-y-2 text-gray-600">
                       <div><p class="font-semibold text-gray-400">Name</p><p class="font-medium text-gray-900">{{ selectedTransaction?.name }}</p></div>
                       <div><p class="font-semibold text-gray-400">Phone Number</p><p class="font-medium text-gray-900">0851-7688-2175</p></div>
                       <div><p class="font-semibold text-gray-400">Email</p><p class="font-medium text-gray-900">mrahmatullahs@gmail.com</p></div>
                       <div><p class="font-semibold text-gray-400">Address</p><p class="font-medium text-gray-900">Jalan Antang Nusa Idaman, Blok C, No. 1</p></div>
                    </div>
                 </div>

                 <!-- Notes Section (Dynamic) -->
                 <div class="pt-4 border-t border-gray-100">
                    <div class="flex justify-between items-center mb-2">
                       <h4 class="text-sm font-bold text-gray-900">Notes</h4>
                       <!-- If no note and not editing, show Add Button -->
                       <button v-if="!selectedTransaction?.notes && !isEditingNote" @click="isEditingNote = true" class="text-gray-400 hover:text-indigo-600">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                       </button>
                       <!-- If note exists, show clear/edit (optional, keeping it simple as per request) -->
                       <button v-if="selectedTransaction?.notes" @click="selectedTransaction.notes = ''; isEditingNote = true" class="text-xs text-red-400 hover:text-red-600">x</button>
                    </div>

                    <!-- Condition 1: Input Mode -->
                    <div v-if="isEditingNote" class="animate-fade-in">
                       <textarea v-model="newNoteText" placeholder="Add notes..." class="w-full border border-gray-300 rounded-lg p-3 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 h-24 resize-none"></textarea>
                       <div class="flex gap-2 mt-2">
                          <button @click="saveNote" class="flex-1 bg-black text-white text-xs py-2 rounded-lg font-bold">Done</button>
                          <button @click="isEditingNote = false" class="flex-1 bg-red-500 text-white text-xs py-2 rounded-lg font-bold">Cancel</button>
                       </div>
                    </div>

                    <!-- Condition 2: Display Mode -->
                    <div v-else-if="selectedTransaction?.notes" class="text-xs text-gray-700 bg-gray-50 p-3 rounded-lg border border-gray-100">
                       {{ selectedTransaction.notes }}
                    </div>
                    
                    <!-- Condition 3: Empty State (Optional placeholder) -->
                    <div v-else class="text-xs text-gray-400 italic">No notes added.</div>
                 </div>
              </div>

              <!-- RIGHT COLUMN -->
              <div class="space-y-6">
                 <!-- Payment Info -->
                 <div>
                    <h4 class="text-sm font-bold text-gray-900 mb-3">Payment Information</h4>
                    <div class="text-xs space-y-2 text-gray-600">
                       <div class="flex justify-between"><span>Transaction Type</span><span class="font-medium text-gray-900">{{ selectedTransaction?.transType }}</span></div>
                       <div class="flex justify-between"><span>Payment Method</span><span class="font-medium text-gray-900">{{ selectedTransaction?.paymentType }}</span></div>
                       <div class="mt-4 pt-2 border-t border-gray-50 space-y-2">
                          <p class="font-bold text-gray-900 mb-1">Service Fee Breakdown:</p>
                          <div class="flex justify-between"><span>Home pick-up & delivery</span><span>Rp15.000</span></div>
                          <div class="flex justify-between"><span>Screen replacement</span><span>Rp1.200.000</span></div>
                          <div class="flex justify-between"><span>Button assembly replacement</span><span>Rp150.000</span></div>
                          <div class="flex justify-between"><span>Labor fee</span><span>Rp200.000</span></div>
                          <div class="flex justify-between font-bold text-gray-900 pt-2 border-t border-gray-100"><span>Total</span><span>{{ selectedTransaction?.amount }}</span></div>
                       </div>
                    </div>
                 </div>

                 <!-- Payment Proof Section (Dynamic) -->
                 <div class="pt-4 border-t border-gray-100">
                    <h4 class="text-sm font-bold text-gray-900 mb-3">Payment Proof</h4>
                    
                    <!-- Condition 1: Proof Exists (Show Image) -->
                    <div v-if="selectedTransaction?.proof" class="relative group">
                       <img :src="selectedTransaction.proof" alt="Receipt" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                       <!-- Hover to remove (Simulated) -->
                       <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100 cursor-pointer">
                          <span class="text-white text-xs font-bold bg-black px-2 py-1 rounded">View</span>
                       </div>
                    </div>

                    <!-- Condition 2: No Proof (Show Upload Box) -->
                    <div v-else @click="triggerFileInput" class="border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors cursor-pointer">
                       <!-- Hidden File Input -->
                       <input type="file" ref="fileInput" class="hidden" accept="image/png, image/jpeg, application/pdf" @change="handleFileSelect">
                       
                       <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                       <p class="text-xs font-bold text-gray-700">Select your file or drag and drop</p>
                       <p class="text-[10px] text-gray-400 mt-1">png, pdf, jpg, mov accepted</p>
                       <button class="mt-3 px-4 py-1.5 bg-white border border-gray-300 rounded-lg text-xs font-bold text-gray-700 hover:bg-gray-100">Browse File</button>
                    </div>
                 </div>
              </div>

           </div>
        </div>

        <!-- Footer Buttons -->
        <div class="p-6 border-t border-gray-100 bg-gray-50 flex gap-4">
           <button class="flex-1 py-3 bg-red-500 text-white text-xs font-bold rounded-xl hover:bg-red-600 transition-colors">
              Cancel Order
           </button>
           <button class="flex-1 py-3 border border-gray-300 bg-white text-gray-700 text-xs font-bold rounded-xl hover:bg-gray-50 transition-colors">
              Send Invoice
           </button>
           <button class="flex-1 py-3 bg-black text-white text-xs font-bold rounded-xl hover:bg-gray-800 transition-colors">
              Update Status
           </button>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue';

const activeTab = ref('income_expense'); 

// --- ADD MODAL LOGIC ---
const showAddModal = ref(false);
const newTransForm = ref({
  type: '', 
  technician: '',
  bank: '',
  account: '',
  amount: '',
  orderId: '',
  notes: ''
});

const openAddModal = () => {
  newTransForm.value.type = ''; 
  showAddModal.value = true;
};

const closeAddModal = () => {
  showAddModal.value = false;
};

// --- DETAIL MODAL LOGIC ---
const showDetailModal = ref(false);
const selectedTransaction = ref(null);
const isEditingNote = ref(false);
const newNoteText = ref('');
const fileInput = ref(null);

// Mock Images for Proof
const mockReceiptUrl = 'https://placehold.co/300x150/e2e8f0/475569?text=Receipt+Image';

const openDetailModal = (item) => {
  // Populate detail data (Mocking fetch details)
  selectedTransaction.value = {
    ...item,
    // Logic: If status completed -> show note & proof. Else -> empty.
    notes: item.status === 'Completed' ? 'Initial funds for Mr. Tama Setiawan' : '',
    proof: item.status === 'Completed' ? mockReceiptUrl : null 
  };
  isEditingNote.value = false;
  newNoteText.value = '';
  showDetailModal.value = true;
};

const closeDetailModal = () => {
  showDetailModal.value = false;
  selectedTransaction.value = null;
};

const saveNote = () => {
  if (selectedTransaction.value) {
    selectedTransaction.value.notes = newNoteText.value;
  }
  isEditingNote.value = false;
};

// --- FILE UPLOAD LOGIC ---
const triggerFileInput = () => {
  if (fileInput.value) {
    fileInput.value.click();
  }
};

const handleFileSelect = (event) => {
  const file = event.target.files[0];
  if (file && selectedTransaction.value) {
    // Create local URL for preview
    const imageUrl = URL.createObjectURL(file);
    selectedTransaction.value.proof = imageUrl;
  }
};

// Dummy Data
const incomeData = ref([
  { name: 'Tama Setiawan', type: 'Service Payment', date: '25/11/2025', time: '13.15 WITA', amount: '+Rp1.565.000' },
  { name: 'Tama Setiawan', type: 'Service Payment', date: '25/11/2025', time: '16.27 WITA', amount: '+Rp1.565.000' },
  { name: 'Tama Setiawan', type: 'Service Payment', date: '25/11/2025', time: '10.30 WITA', amount: '+Rp1.565.000' },
  { name: 'Tama Setiawan', type: 'Service Payment', date: '25/11/2025', time: '08.33 WITA', amount: '+Rp1.565.000' },
  { name: 'Tama Setiawan', type: 'Service Payment', date: '25/11/2025', time: '13.15 WITA', amount: '+Rp1.565.000' },
]);

const expenseData = ref([
  { name: 'Tama Setiawan', type: 'Service Payment', date: 'Nov 05, 2025', time: '13.15 WITA', amount: '-Rp1.565.000' },
  { name: 'Tama Setiawan', type: 'Service Payment', date: 'Nov 02, 2025', time: '16.27 WITA', amount: '-Rp1.565.000' },
  { name: 'Tama Setiawan', type: 'Service Payment', date: 'Nov 02, 2025', time: '10.30 WITA', amount: '-Rp1.565.000' },
  { name: 'Tama Setiawan', type: 'Service Payment', date: 'Nov 02, 2025', time: '08.33 WITA', amount: '-Rp1.565.000' },
  { name: 'Tama Setiawan', type: 'Service Payment', date: 'Oct 29, 2025', time: '13.15 WITA', amount: '-Rp1.565.000' },
]);

const transactionData = ref([
  { transId: '#P002328766628', name: 'Tama Setiawan', subId: '#RE11324935600012', transType: 'Service Payment', paymentType: 'Cash on Delivery', amount: '+Rp1.565.000', date: 'Nov 02, 2025', time: '16.27 WITA', status: 'Unpaid', type: 'income' },
  { transId: '#0030728276351', name: '-', subId: '', transType: 'Cash Advance', paymentType: 'Bank Transfer', amount: '-Rp1.565.000', date: 'Nov 02, 2025', time: '16.27 WITA', status: 'Completed', type: 'expense' },
  { transId: '#P002328766628', name: 'Tama Setiawan', subId: '#RE11324935600012', transType: 'Service Payment', paymentType: 'Cash on Delivery', amount: '+Rp1.565.000', date: 'Nov 02, 2025', time: '16.27 WITA', status: 'Unpaid', type: 'income' },
  { transId: '#0030728276351', name: '-', subId: '', transType: 'Cash Advance', paymentType: 'Bank Transfer', amount: '-Rp1.565.000', date: 'Nov 02, 2025', time: '16.27 WITA', status: 'Completed', type: 'expense' },
  { transId: '#P002328766628', name: 'Tama Setiawan', subId: '#RE11324935600012', transType: 'Service Payment', paymentType: 'Cash on Delivery', amount: '+Rp1.565.000', date: 'Nov 02, 2025', time: '16.27 WITA', status: 'Unpaid', type: 'income' },
]);

</script>

<style scoped>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
  animation: fadeIn 0.3s ease-out forwards;
}
.custom-scrollbar::-webkit-scrollbar {
  height: 6px;
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #e5e7eb; 
  border-radius: 10px;
}
</style>
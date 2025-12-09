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
               <button @click="openAddModal('Service Payment')" class="w-6 h-6 flex items-center justify-center rounded border border-gray-200 hover:bg-indigo-50 hover:text-indigo-600 text-gray-500 transition-colors" title="Add Income">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
             </button>
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
               <button @click="openAddModal('Cash Advance')" class="w-6 h-6 flex items-center justify-center rounded border border-gray-200 hover:bg-indigo-50 hover:text-indigo-600 text-gray-500 transition-colors" title="Add Expense">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
             </button>
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
                          <button 
                              v-if="item.status === 'Unpaid'" 
                              @click="handleUpdateStatus(item, 'Completed')" 
                              class="bg-green-500 text-white text-[10px] px-3 py-1 rounded-full hover:bg-green-600 transition-colors font-medium">
                              Confirm
                           </button>
                           <button 
                              v-else 
                              disabled
                              class="border border-gray-300 text-gray-400 text-[10px] px-3 py-1 rounded-full cursor-not-allowed font-medium">
                              {{ item.status === 'Completed' ? 'Done' : 'Void' }}
                           </button>

                           <button 
                              v-if="item.status !== 'Cancelled'"
                              @click="handleUpdateStatus(item, 'Cancelled')" 
                              class="bg-red-500 text-white text-[10px] px-3 py-1 rounded-full hover:bg-red-600 transition-colors font-medium">
                              Cancel
                           </button>
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
    <div class="relative" ref="exportDropdownRef">
  <button 
    @click="isExportOpen = !isExportOpen"
    class="flex items-center gap-2 px-3 py-1 bg-white border border-gray-200 rounded-lg text-[10px] font-medium text-gray-600 hover:bg-gray-50 transition-colors shadow-sm"
  >
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
    Export as
    <svg class="w-2.5 h-2.5 ml-1 transform transition-transform text-gray-400" :class="{'rotate-180': isExportOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
  </button>

  <div v-if="isExportOpen" class="absolute bottom-full right-0 mb-2 w-32 bg-white border border-gray-100 rounded-xl shadow-xl z-50 overflow-hidden animate-fade-in">
    <div class="py-1">
      <button @click="exportToCSV" class="w-full text-left px-4 py-2 text-[10px] text-gray-700 hover:bg-gray-50 hover:text-blue-600 flex items-center gap-2">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
        Export CSV
      </button>
      <button @click="exportToPDF" class="w-full text-left px-4 py-2 text-[10px] text-gray-700 hover:bg-gray-50 hover:text-red-600 flex items-center gap-2">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
        Save as PDF
      </button>
    </div>
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
               <option value="Service Payment">Service Payment</option>
               <option value="Cash Advance">Cash Advance</option>
               <option value="Refund">Refund</option>
            </select>
         </div>

         <div v-if="newTransForm.type === 'Service Payment'" class="space-y-4 animate-fade-in">
            <div>
               <label class="block text-xs font-bold text-gray-700 mb-1">Customer Name</label>
               <input v-model="newTransForm.name" type="text" placeholder="Enter customer name" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
               <label class="block text-xs font-bold text-gray-700 mb-1">Amount (Rp)</label>
               <input v-model="newTransForm.amount" type="number" placeholder="Example: 150000" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
               <label class="block text-xs font-bold text-gray-700 mb-1">Notes</label>
               <input v-model="newTransForm.notes" type="text" placeholder="Service details..." class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
         </div>

         <div v-if="newTransForm.type === 'Cash Advance'" class="space-y-4 animate-fade-in">
            <div>
               <label class="block text-xs font-bold text-gray-700 mb-1">Technician Name</label>
               <select v-model="newTransForm.name" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
                  <option>Tama Setiawan</option>
                  <option>Budi Santoso</option>
               </select>
            </div>
            <div>
               <label class="block text-xs font-bold text-gray-700 mb-1">Amount</label>
               <input v-model="newTransForm.amount" type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
               <label class="block text-xs font-bold text-gray-700 mb-1">Notes</label>
               <input v-model="newTransForm.notes" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
         </div>

         <div v-if="newTransForm.type === 'Refund'" class="space-y-4 animate-fade-in">
               <div>
               <label class="block text-xs font-bold text-gray-700 mb-1">Amount</label>
               <input v-model="newTransForm.amount" type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
         </div>
         </div>
        <div class="flex gap-3 mt-8">
           <button @click="closeAddModal" class="flex-1 py-2.5 bg-red-500 text-white text-xs font-bold rounded-xl hover:bg-red-600 transition-colors">Cancel</button>
           <button @click="saveNewTransaction" class="flex-1 py-2.5 border border-gray-300 bg-white text-gray-700 text-xs font-bold rounded-xl hover:bg-gray-50 transition-colors">Add</button>
        </div>
      </div>
    </div>

    <!-- MODAL: TRANSACTION DETAIL (NEW) -->
<div v-if="showDetailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col overflow-hidden animate-fade-in">
    
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
      
      <div class="flex gap-2">
        <button v-if="!isEditingDetail" @click="startEditDetail" class="text-gray-400 hover:text-indigo-600 transition-colors p-1" title="Edit Transaction">
           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </button>
        <button @click="closeDetailModal" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
           <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
      </div>
    </div>

    <div class="p-8 overflow-y-auto custom-scrollbar flex-1">
       <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
          
          <div class="space-y-6">
             <div>
                <h4 class="text-sm font-bold text-gray-900 mb-3">Customer Information</h4>
                <div class="text-xs space-y-2 text-gray-600">
                   <div><p class="font-semibold text-gray-400">Name</p><p class="font-medium text-gray-900">{{ selectedTransaction?.name }}</p></div>
                   </div>
             </div>

             <div class="pt-4 border-t border-gray-100">
                <h4 class="text-sm font-bold text-gray-900 mb-2">Notes</h4>
                
                <div v-if="isEditingDetail">
                   <textarea v-model="editForm.notes" class="w-full border border-gray-300 rounded-lg p-3 text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 h-24 resize-none" placeholder="Edit notes..."></textarea>
                </div>
                
                <div v-else>
                   <div v-if="selectedTransaction?.notes" class="text-xs text-gray-700 bg-gray-50 p-3 rounded-lg border border-gray-100">{{ selectedTransaction.notes }}</div>
                   <div v-else class="text-xs text-gray-400 italic">No notes added.</div>
                </div>
             </div>
          </div>

          <div class="space-y-6">
             <div>
                <h4 class="text-sm font-bold text-gray-900 mb-3">Payment Information</h4>
                <div class="text-xs space-y-3 text-gray-600">
                   
                   <div class="flex justify-between items-center h-8">
                      <span>Transaction Type</span>
                      <span v-if="!isEditingDetail" class="font-medium text-gray-900">{{ selectedTransaction?.transType }}</span>
                      <select v-else v-model="editForm.transType" class="border rounded px-2 py-1 text-xs focus:outline-none focus:border-indigo-500 w-1/2">
                         <option>Service Payment</option>
                         <option>Cash Advance</option>
                         <option>Refund</option>
                      </select>
                   </div>

                   <div class="flex justify-between items-center h-8">
                      <span>Payment Method</span>
                      <span v-if="!isEditingDetail" class="font-medium text-gray-900">{{ selectedTransaction?.paymentType }}</span>
                      <select v-else v-model="editForm.paymentType" class="border rounded px-2 py-1 text-xs focus:outline-none focus:border-indigo-500 w-1/2">
                         <option>Cash on Delivery</option>
                         <option>Bank Transfer</option>
                         <option>Gopay</option>
                         <option>Cash</option>
                      </select>
                   </div>

                   <div class="flex justify-between items-center h-8 font-bold text-gray-900 pt-2 border-t border-gray-100 mt-2">
                      <span>Total Amount</span>
                      <span v-if="!isEditingDetail">{{ selectedTransaction?.amount }}</span>
                      <input v-else v-model="editForm.amount" type="text" class="border rounded px-2 py-1 text-xs text-right focus:outline-none focus:border-indigo-500 w-1/2" placeholder="Rp...">
                   </div>
                </div>
             </div>

             <div class="pt-4 border-t border-gray-100">
                <div class="flex justify-between items-center mb-3">
                   <h4 class="text-sm font-bold text-gray-900">Payment Proof</h4>
                   <button v-if="isEditingDetail" @click="triggerFileInput" class="text-[10px] text-indigo-600 font-bold hover:underline">Change File</button>
                </div>

                <div v-if="selectedTransaction?.proof" class="relative group">
                   <img :src="isEditingDetail ? (editForm.proof || selectedTransaction.proof) : selectedTransaction.proof" alt="Receipt" class="w-full h-32 object-cover rounded-lg border border-gray-200">
                </div>
                <div v-else class="text-xs text-gray-400 italic bg-gray-50 p-4 rounded text-center border border-dashed">No proof uploaded.</div>
                
                <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="(e) => { 
                   const file = e.target.files[0]; 
                   if(file) editForm.proof = URL.createObjectURL(file); 
                }">
             </div>
          </div>

       </div>
    </div>

    <div class="p-6 border-t border-gray-100 bg-gray-50 flex gap-4">
       
       <template v-if="isEditingDetail">
          <button @click="cancelEditDetail" class="flex-1 py-3 bg-white border border-gray-300 text-gray-700 text-xs font-bold rounded-xl hover:bg-gray-50 transition-colors">
             Cancel Edit
          </button>
          <button @click="saveEditDetail" class="flex-1 py-3 bg-indigo-600 text-white text-xs font-bold rounded-xl hover:bg-indigo-700 transition-colors shadow-lg">
             Save Changes
          </button>
       </template>

       <template v-else>
          <button @click="handleUpdateStatus(selectedTransaction, 'Cancelled')" class="flex-1 py-3 bg-red-500 text-white text-xs font-bold rounded-xl hover:bg-red-600 transition-colors">
             Cancel Order
          </button>
          <button @click="alert('Invoice Sent!')" class="flex-1 py-3 border border-gray-300 bg-white text-gray-700 text-xs font-bold rounded-xl hover:bg-gray-50 transition-colors">
             Send Invoice
          </button>
          <button @click="handleUpdateStatus(selectedTransaction, 'Completed')" class="flex-1 py-3 bg-black text-white text-xs font-bold rounded-xl hover:bg-gray-800 transition-colors">
             Mark as Completed
          </button>
       </template>

    </div>

  </div>
</div>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { useFinanceStore } from '../../stores/finance'; // Import Store
import { storeToRefs } from 'pinia';
import axios from 'axios'; // Pastikan axios diimport untuk POST data

const BASE_URL = 'http://127.0.0.1:8000/api/admin'; 

// --- STORE SETUP ---
const financeStore = useFinanceStore();
// Ambil data reaktif dari store
const { transactions, incomeList, expenseList, summary } = storeToRefs(financeStore);

const activeTab = ref('income_expense'); 

// Fetch Data saat halaman dibuka
onMounted(() => {
  financeStore.fetchFinance();
  document.addEventListener('click', closeExportDropdown); // Listener click luar
});

onUnmounted(() => {
  document.removeEventListener('click', closeExportDropdown);
});

// Mapping Data Store ke Variabel Template
const transactionData = transactions; // Untuk Tab Transaction Log
const incomeData = incomeList;        // Untuk Tab Income
const expenseData = expenseList;      // Untuk Tab Expense

// Format Summary untuk Kartu Atas
const formatRp = (val) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(val);


// =======================================================================
// 1. MODAL ADD TRANSACTION (LOGIKA BARU UNTUK BUTTON +)
// =======================================================================
const showAddModal = ref(false);
const newTransForm = ref({ type: '', amount: '', notes: '', name: '' });

// Fungsi buka modal (bisa dipanggil dari tombol + di header tabel)
const openAddModal = (prefillType = '') => {
  newTransForm.value = { 
      type: prefillType, // Otomatis terisi jika klik tombol + Income/Expense
      amount: '', 
      notes: '',
      name: '' 
  };
  showAddModal.value = true;
};

const closeAddModal = () => showAddModal.value = false;

// Fungsi Simpan Data ke Database
const saveNewTransaction = async () => {
  // 1. Validasi
  if(!newTransForm.value.type || !newTransForm.value.amount) {
    alert("Mohon isi Tipe Transaksi dan Jumlah Uang!");
    return;
  }

  const token = localStorage.getItem('token'); // Sesuaikan nama key jika beda, misal 'auth_token'
  
  if (!token) {
      alert("Sesi habis. Silakan login ulang.");
      // Opsional: redirect ke login
      return;
  }

  // 2. Tentukan Income/Expense (sesuai kolom transaction_category di Model)
  let categoryDB = 'expense'; 
  if (['Service Payment', 'Income'].includes(newTransForm.value.type)) {
      categoryDB = 'income';
  }

  // 3. PERSIAPKAN PAYLOAD (KUNCI UTAMA)
  // Nama properti di sini (kiri) HARUS cocok dengan $request di Controller
  const payload = {
      // Data untuk logika backend (mencari transaction_type_id)
      type_name: newTransForm.value.type, // Kirim string "Service Payment", "Cash Advance", dll

      // Data untuk disimpan langsung ke tabel transactions
      transaction_category: categoryDB,     // 'income' atau 'expense'
      amount: parseFloat(newTransForm.value.amount),
      payment_method: 'Cash',               // Default
      notes: newTransForm.value.notes || '-', 
      transaction_date: new Date().toISOString().split('T')[0], // YYYY-MM-DD
      
      // Kirim nama customer/teknisi sebagai data tambahan (nanti dihandle controller)
      related_name: newTransForm.value.name 
  };

  console.log("Payload dikirim:", payload); // Cek di Console Browser

  try {
    const response = await axios.post(`${BASE_URL}/transactions`, payload);
    
    if(response.status === 200 || response.status === 201) {
        await financeStore.fetchFinance();
        closeAddModal();
        // Reset form
        newTransForm.value = { type: '', amount: '', notes: '', name: '' };
        alert("Transaksi berhasil disimpan!");
    }
  } catch (error) {
    console.error("Error Backend:", error.response);
    alert("Gagal menyimpan: " + (error.response?.data?.message || error.message));
  }
};


// =======================================================================
// 2. EXPORT LOGIC (CSV & PDF)
// =======================================================================
const isExportOpen = ref(false);
const exportDropdownRef = ref(null);

// Tutup dropdown saat klik di luar
const closeExportDropdown = (e) => {
  if (exportDropdownRef.value && !exportDropdownRef.value.contains(e.target)) {
    isExportOpen.value = false;
  }
};

// Fungsi Export CSV
const exportToCSV = () => {
  const headers = ['Transaction ID', 'Name', 'Type', 'Category', 'Payment Method', 'Amount', 'Date', 'Status'];
  
  const rows = transactionData.value.map(item => [
    item.transId,
    `"${item.name}"`, 
    item.type,
    item.transType,
    item.paymentType,
    `"${item.amount}"`,
    item.date,
    item.status
  ]);

  const csvContent = [
    headers.join(','), 
    ...rows.map(e => e.join(','))
  ].join('\n');

  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  const link = document.createElement('a');
  const url = URL.createObjectURL(blob);
  
  link.setAttribute('href', url);
  link.setAttribute('download', `Transaction_Report_${new Date().toISOString().slice(0,10)}.csv`);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  
  isExportOpen.value = false; 
};

// Fungsi Export PDF (Print)
const exportToPDF = () => {
  isExportOpen.value = false;
  window.print();
};


// =======================================================================
// 3. UPDATE STATUS LOGIC (CONFIRM / CANCEL)
// =======================================================================
const handleUpdateStatus = async (item, status) => {
  if (!item || !item.originalId) return;

  const confirmMsg = status === 'Cancelled' 
    ? 'Are you sure you want to CANCEL this transaction?' 
    : 'Mark this transaction as COMPLETED?';

  if (confirm(confirmMsg)) {
    const success = await financeStore.updateStatus(item.originalId, status);
    if (success) {
      if (showDetailModal.value) {
        closeDetailModal();
      }
    }
  }
};


// =======================================================================
// 4. DETAIL MODAL LOGIC (EDIT & VIEW)
// =======================================================================
const showDetailModal = ref(false);
const selectedTransaction = ref(null);
const isEditingDetail = ref(false); 
const editForm = ref({}); 
const fileInput = ref(null);
const mockReceiptUrl = 'https://placehold.co/300x150/e2e8f0/475569?text=Receipt+Image';

// Buka Modal
const openDetailModal = (item) => {
  selectedTransaction.value = { ...item };
  isEditingDetail.value = false; 
  showDetailModal.value = true;
};

// Tutup Modal
const closeDetailModal = () => {
  showDetailModal.value = false;
  selectedTransaction.value = null;
  isEditingDetail.value = false;
};

// Mulai Edit
const startEditDetail = () => {
  editForm.value = { ...selectedTransaction.value };
  isEditingDetail.value = true;
};

// Batal Edit
const cancelEditDetail = () => {
  isEditingDetail.value = false;
  editForm.value = {};
};

// Simpan Edit (Sementara Lokal)
const saveEditDetail = async () => {
  Object.assign(selectedTransaction.value, editForm.value);
  
  // Update di list utama agar reaktif
  const idx = transactionData.value.findIndex(t => t.transId === editForm.value.transId);
  if(idx !== -1) transactionData.value[idx] = { ...editForm.value };

  isEditingDetail.value = false;
  alert('Transaction updated locally!');
};

// File Upload Logic
const triggerFileInput = () => { if (fileInput.value) fileInput.value.click(); };
const handleFileSelect = (event) => {
  const file = event.target.files[0];
  if (file && isEditingDetail.value) {
     editForm.value.proof = URL.createObjectURL(file); 
  }
};
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

@media print {
  /* Sembunyikan elemen yang tidak perlu saat PDF */
  button, nav, .filters, .sidebar, header {
    display: none !important;
  }
  
  /* Pastikan Tabel terlihat jelas */
  table {
    width: 100%;
    border: 1px solid #ddd;
  }
  
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 10px;
  }

  /* Judul Laporan */
  body::before {
    content: "Breevis - Transaction Report";
    font-size: 18px;
    font-weight: bold;
    display: block;
    margin-bottom: 20px;
    text-align: center;
  }
}
</style>
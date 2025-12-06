<template>
  <div class="h-full flex flex-col bg-white rounded-2xl shadow-sm overflow-hidden relative">
    
    <!-- HEADER & TOOLBAR -->
    <div class="p-6 border-b border-gray-100 space-y-4">
      
      <!-- 1. Judul Bagian -->
      <div>
        <h3 class="text-lg font-bold text-gray-800">Recent Activities</h3>
      </div>
      
      <!-- 2. Toolbar (Filters Left, Search Right) -->
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        
        <!-- Left: Filters Group -->
        <div class="flex flex-wrap gap-2 items-center">
           
           <!-- Time Filter -->
           <button class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-medium hover:bg-blue-700 transition-colors shadow-sm">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
              Last 6 month
           </button>

           <!-- Role Filter -->
           <div class="relative">
              <select class="appearance-none pl-3 pr-8 py-2 bg-white border border-gray-200 rounded-lg text-xs font-medium text-gray-600 focus:outline-none focus:border-indigo-500 hover:bg-gray-50 transition-colors cursor-pointer shadow-sm">
                 <option>Role</option>
                 <option>Admin</option>
                 <option>Customer</option>
                 <option>System</option>
              </select>
              <svg class="w-3 h-3 text-gray-400 absolute right-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
           </div>

           <!-- Status Filter (Multi-select Dropdown) -->
           <div class="relative" ref="statusDropdownRef">
              <button 
                @click="isStatusOpen = !isStatusOpen"
                class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-xs font-medium hover:bg-blue-700 transition-colors shadow-sm"
              >
                 Status 
                 <span v-if="selectedStatuses.length > 0" class="bg-white text-blue-600 text-[10px] font-bold px-1.5 py-0.5 rounded-full ml-1">{{ selectedStatuses.length }}</span>
                 <svg class="w-3 h-3 ml-1 transform transition-transform" :class="{'rotate-180': isStatusOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
              </button>

              <!-- Dropdown Content -->
              <div v-if="isStatusOpen" class="absolute top-full left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 overflow-hidden animate-fade-in">
                 <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100 bg-gray-50">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Filter Status</span>
                    <button @click="selectedStatuses = []" class="text-[10px] text-red-500 hover:text-red-700 font-medium">Reset</button>
                 </div>
                 <div class="p-2 space-y-1 max-h-48 overflow-y-auto custom-scrollbar">
                    <label v-for="status in statusOptions" :key="status.value" class="flex items-center gap-2 px-3 py-2 hover:bg-gray-50 rounded-lg cursor-pointer group">
                       <input type="checkbox" :value="status.value" v-model="selectedStatuses" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 h-3.5 w-3.5 cursor-pointer">
                       <span class="text-xs text-gray-700 font-medium group-hover:text-blue-600 transition-colors">{{ status.label }}</span>
                    </label>
                 </div>
              </div>
           </div>

        </div>

        <!-- Right: Search -->
        <div class="relative w-full lg:w-64">
           <input type="text" placeholder="Search" class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-xs bg-white focus:outline-none focus:border-indigo-500 transition-all shadow-sm">
           <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>

      </div>
    </div>

    <!-- TABLE -->
    <div class="overflow-x-auto flex-1 custom-scrollbar">
      <table class="w-full text-left min-w-[1000px]">
        <thead class="bg-white sticky top-0 z-10 shadow-sm">
          <tr class="text-[11px] font-bold text-gray-900 border-b border-gray-200 bg-gray-50/50">
            <th class="py-4 px-6 whitespace-nowrap">Timestamp</th>
            <th class="py-4 px-4 whitespace-nowrap">Actor</th>
            <th class="py-4 px-4 whitespace-nowrap">Role</th>
            <th class="py-4 px-4 whitespace-nowrap">IP Address</th>
            <th class="py-4 px-4 whitespace-nowrap">Device Info</th>
            <th class="py-4 px-4 whitespace-nowrap">Action</th>
            <th class="py-4 px-4 whitespace-nowrap">Description</th>
            <th class="py-4 px-6 whitespace-nowrap text-right">Status</th>
          </tr>
        </thead>
        <tbody class="text-[11px] text-gray-600">
          <tr v-for="(log, index) in logs" :key="index" class="border-b border-gray-50 hover:bg-gray-50 transition-colors group">
            
            <td class="py-4 px-6 font-medium text-gray-500 whitespace-nowrap">{{ log.timestamp }}</td>
            <td class="py-4 px-4 font-bold text-gray-800 whitespace-nowrap">{{ log.actor }}</td>
            <td class="py-4 px-4 whitespace-nowrap">{{ log.role }}</td>
            <td class="py-4 px-4 font-mono text-gray-500 whitespace-nowrap">{{ log.ip }}</td>
            <td class="py-4 px-4 text-gray-500 whitespace-nowrap">{{ log.device || '-' }}</td>
            
            <td class="py-4 px-4 whitespace-nowrap">
               <div class="flex items-center gap-2 font-medium text-gray-700">
                  <span v-html="getActionIcon(log.actionType)" class="text-gray-400"></span>
                  {{ log.action }}
               </div>
            </td>
            
            <td class="py-4 px-4 min-w-[250px]">
               <p class="truncate w-full max-w-[300px]" :title="log.desc">{{ log.desc }}</p>
            </td>
            
            <td class="py-4 px-6 whitespace-nowrap text-right">
               <div class="flex items-center justify-end gap-2">
                  <span class="w-2 h-2 rounded-full" 
                        :class="{
                           'bg-green-500': log.status === 'Success',
                           'bg-gray-300': log.status === 'Info',
                           'bg-yellow-400': log.status === 'Warning',
                           'bg-red-500': log.status === 'Critical'
                        }"></span>
                  <span class="font-medium"
                        :class="{
                           'text-green-600': log.status === 'Success',
                           'text-gray-500': log.status === 'Info',
                           'text-yellow-600': log.status === 'Warning',
                           'text-red-600': log.status === 'Critical'
                        }">
                     {{ log.status }}
                  </span>
               </div>
            </td>

          </tr>
        </tbody>
      </table>
    </div>

    <!-- FOOTER -->
    <div class="p-4 border-t border-gray-100 flex justify-between items-center bg-white">
       
       <div class="flex items-center gap-4">
          <span class="text-[10px] text-gray-400">Shows {{ logs.length }} results of 150</span>
          
          <button class="flex items-center gap-2 px-3 py-1 bg-white border border-gray-200 rounded-lg text-[10px] font-medium text-gray-600 hover:bg-gray-50 transition-colors shadow-sm">
             <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
             Export as
          </button>
       </div>
       
       <div class="flex gap-1">
          <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500 transition-colors">&lt;</button>
          <button class="w-6 h-6 flex items-center justify-center rounded bg-black text-white font-bold text-xs shadow-sm">1</button>
          <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500 transition-colors">2</button>
          <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500 transition-colors">3</button>
          <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500 transition-colors">4</button>
          <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500 transition-colors">5</button>
          <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100 text-xs text-gray-500 transition-colors">&gt;</button>
       </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

// --- FILTER STATE ---
const isStatusOpen = ref(false);
const selectedStatuses = ref(['Success', 'Warning']); 
const statusOptions = [
  { label: 'Succeed', value: 'Success' },
  { label: 'Info', value: 'Info' },
  { label: 'Warning', value: 'Warning' },
  { label: 'Critical', value: 'Critical' },
];

// Click Outside to Close Dropdown
const statusDropdownRef = ref(null);
const closeDropdown = (e) => {
  if (statusDropdownRef.value && !statusDropdownRef.value.contains(e.target)) {
    isStatusOpen.value = false;
  }
};
onMounted(() => document.addEventListener('click', closeDropdown));
onUnmounted(() => document.removeEventListener('click', closeDropdown));

// --- DUMMY DATA ---
const logs = ref([
  { 
    timestamp: '2025-11-07 14:45:23', 
    actor: 'Risah', 
    role: 'Admin', 
    ip: '192.168.0.12', 
    device: 'Windows 11 / Chrome', 
    action: 'Download Report', 
    actionType: 'download',
    desc: 'Exported monthly report (October 2025)', 
    status: 'Success' 
  },
  { 
    timestamp: '2025-11-07 14:30:00', 
    actor: 'System', 
    role: '-', 
    ip: '-', 
    device: '-', 
    action: 'Auto Update', 
    actionType: 'refresh',
    desc: 'Automatically generated invoice for #RE11324935600012', 
    status: 'Info' 
  },
  { 
    timestamp: '2025-11-07 14:27:50', 
    actor: 'session_9a2c', 
    role: 'Customer', 
    ip: '36.72.85.110', 
    device: 'Android / Chrome', 
    action: 'Submit Order', 
    actionType: 'upload',
    desc: 'Submitted new repair request for Realme 5i - Screen & Button Issue', 
    status: 'Success' 
  },
  { 
    timestamp: '2025-11-07 14:24:50', 
    actor: 'session_9a2c', 
    role: 'Customer', 
    ip: '36.72.85.110', 
    device: 'Android / Chrome', 
    action: 'Upload File', 
    actionType: 'upload',
    desc: 'Uploaded photo my_phone_gw.jpg for order', 
    status: 'Info' 
  },
  { 
    timestamp: '2025-11-07 12:15:23', 
    actor: 'Risah', 
    role: 'Admin', 
    ip: '192.168.0.12', 
    device: 'Windows 11 / Chrome', 
    action: 'Delete Order', 
    actionType: 'delete',
    desc: 'Deleted order #RE4561123700015 (duplicate entry)', 
    status: 'Critical' 
  },
  { 
    timestamp: '2025-11-06 15:05:44', 
    actor: 'Risah', 
    role: 'Admin', 
    ip: '192.168.0.12', 
    device: 'Windows 11 / Chrome', 
    action: 'Edit Staff Wages', 
    actionType: 'edit',
    desc: 'Change #TC12889 wages: Rp800.000 -> Rp950.000', 
    status: 'Warning' 
  },
  { 
    timestamp: '2025-11-07 14:45:23', 
    actor: 'Risah', 
    role: 'Admin', 
    ip: '192.168.0.12', 
    device: 'Windows 11 / Chrome', 
    action: 'Download Report', 
    actionType: 'download',
    desc: 'Exported monthly report (October 2025)', 
    status: 'Success' 
  },
  { 
    timestamp: '2025-11-07 14:45:23', 
    actor: 'Risah', 
    role: 'Admin', 
    ip: '192.168.0.12', 
    device: 'Windows 11 / Chrome', 
    action: 'Download Report', 
    actionType: 'download',
    desc: 'Exported monthly report (October 2025)', 
    status: 'Success' 
  },
  { 
    timestamp: '2025-11-07 14:45:23', 
    actor: 'Risah', 
    role: 'Admin', 
    ip: '192.168.0.12', 
    device: 'Windows 11 / Chrome', 
    action: 'Download Report', 
    actionType: 'download',
    desc: 'Exported monthly report (October 2025)', 
    status: 'Success' 
  },
  { 
    timestamp: '2025-11-07 14:45:23', 
    actor: 'Risah', 
    role: 'Admin', 
    ip: '192.168.0.12', 
    device: 'Windows 11 / Chrome', 
    action: 'Download Report', 
    actionType: 'download',
    desc: 'Exported monthly report (October 2025)', 
    status: 'Success' 
  },
]);

// Helper for Icons (Returning SVG Strings)
const getActionIcon = (type) => {
  const icons = {
    download: `<svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>`,
    refresh: `<svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>`,
    upload: `<svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>`,
    delete: `<svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>`,
    edit: `<svg class="w-3.5 h-3.5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>`
  };
  return icons[type] || icons['download'];
};

</script>

<style scoped>
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
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(5px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
  animation: fadeIn 0.2s ease-out forwards;
}
</style>
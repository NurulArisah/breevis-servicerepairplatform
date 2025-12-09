<template>
  <div class="h-[calc(100vh-120px)] flex flex-col lg:flex-row gap-6">
    
    <div class="flex-1 bg-white rounded-2xl shadow-sm p-6 flex flex-col">
      
      <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">List Staff</h2>
        <div class="flex flex-wrap gap-3 justify-between">
          <div class="flex gap-2">
             <div class="relative">
                <input type="date" class="pl-8 pr-3 py-2 border border-gray-200 rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-gray-50">
                <svg class="w-4 h-4 text-gray-400 absolute left-2.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
             </div>
             <select class="px-3 py-2 border border-gray-200 rounded-lg text-xs text-gray-500 focus:outline-none focus:border-indigo-500 bg-gray-50">
               <option value="">Working Status</option>
               <option value="On Task">On Task</option>
               <option value="Off Task">Off Task</option>
             </select>
          </div>
          <div class="relative w-full sm:w-48">
             <input type="text" placeholder="Search" class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-xs bg-gray-50 focus:outline-none focus:border-indigo-500">
             <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
          </div>
        </div>
      </div>

      <div v-if="isLoading" class="flex-1 flex items-center justify-center">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
      </div>

      <div v-else class="overflow-y-auto flex-1 custom-scrollbar pr-2">
        <table class="w-full text-left border-collapse">
          <thead class="sticky top-0 bg-white z-10">
            <tr class="text-xs font-bold text-gray-900 border-b border-gray-100">
              <th class="py-3 pl-2">Name</th>
              <th class="py-3">Date</th>
              <th class="py-3 text-center">Working Status</th>
              <th class="py-3">Salary</th>
              <th class="py-3 text-center">Action</th>
            </tr>
          </thead>
          <tbody class="text-xs text-gray-600">
            <tr 
              v-for="staff in staffList" 
              :key="staff.id" 
              @click="selectStaff(staff)"
              class="border-b border-gray-50 hover:bg-gray-50 cursor-pointer transition-colors"
              :class="{'bg-indigo-50': selectedStaff && selectedStaff.id === staff.id && !isAdding}"
            >
              <td class="py-3 pl-2">
                 <span 
                   class="font-semibold px-3 py-1.5 rounded-md transition-colors block w-fit"
                   :class="selectedStaff && selectedStaff.id === staff.id && !isAdding ? 'bg-indigo-500 text-white shadow-md' : 'text-gray-800'"
                 >
                   {{ staff.name }}
                 </span>
              </td>
              <td class="py-3">{{ staff.date }}</td>
              <td class="py-3 text-center">
                 <span 
                   :class="staff.status === 'On Task' ? 'bg-yellow-400 text-white' : 'bg-gray-500 text-white'"
                   class="px-3 py-1 rounded-full text-[10px] font-bold uppercase inline-block min-w-[70px]"
                 >
                   {{ staff.status }}
                 </span>
              </td>
              <td class="py-3 font-semibold text-gray-900">{{ staff.salary }}</td>
              <td class="py-3">
                 <div class="flex items-center justify-center gap-2">
                    <button class="p-1 text-gray-400 hover:text-indigo-600 border border-gray-200 rounded-full">
                       <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                    <button @click.stop="startEdit(staff)" class="p-1 text-gray-400 hover:text-blue-600 border border-gray-200 rounded-full">
                       <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                    <button @click.stop="deleteStaff(staff.id)" class="bg-red-500 text-white text-[10px] px-3 py-1 rounded-full hover:bg-red-600 transition-colors font-medium">
                      Dismiss
                    </button>
                 </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-4 flex justify-between items-center text-xs text-gray-400 border-t border-gray-100 pt-3">
         
         <div class="flex items-center gap-4">
            <span>Shows {{ staffList.length }} results</span>
            
            <div class="flex gap-2">
               <button 
                  @click="startAdd"
                  class="w-6 h-6 flex items-center justify-center rounded border border-gray-200 hover:bg-indigo-50 hover:text-indigo-600 text-gray-500 transition-colors"
                  title="Add New Staff"
               >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
               </button>
               
               <button 
                  @click="refreshList"
                  class="w-6 h-6 flex items-center justify-center rounded border border-gray-200 hover:bg-gray-50 hover:text-gray-700 text-gray-500 transition-colors"
                  title="Refresh List"
                  :class="{'animate-spin': isLoading}"
               >
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
               </button>
            </div>
         </div>

         <div class="flex gap-2">
            <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100">&lt;</button>
            <button class="w-6 h-6 flex items-center justify-center rounded bg-indigo-600 text-white font-bold">1</button>
            <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100">2</button>
            <button class="w-6 h-6 flex items-center justify-center rounded hover:bg-gray-100">&gt;</button>
         </div>
      </div>
    </div>

    <div v-if="selectedStaff && !isEditing && !isAdding" class="w-full lg:w-[35%] bg-gray-100 rounded-2xl p-6 flex flex-col items-center justify-center relative shadow-inner">
       <button @click="startEdit(selectedStaff)" class="absolute top-6 right-6 p-2 bg-white rounded-lg shadow-sm hover:text-indigo-600 text-gray-600 transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
       </button>

       <div class="mb-4 text-center">
          <h3 class="text-xl font-bold text-gray-900">{{ selectedStaff.name }}</h3>
          <p class="text-xs text-gray-500 font-medium">{{ selectedStaff.role }}</p>
       </div>

       <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mb-8 border-4 border-white shadow-sm">
          <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
       </div>

       <div class="w-full space-y-4 mb-8 px-2">
          <div class="grid grid-cols-3 gap-2 text-xs">
             <span class="font-bold text-gray-800">Address:</span>
             <span class="col-span-2 text-right text-gray-600 font-medium">{{ selectedStaff.address }}</span>
          </div>
          <div class="grid grid-cols-3 gap-2 text-xs">
             <span class="font-bold text-gray-800">Email:</span>
             <span class="col-span-2 text-right text-gray-600 font-medium break-all">{{ selectedStaff.email }}</span>
          </div>
          <div class="grid grid-cols-3 gap-2 text-xs">
             <span class="font-bold text-gray-800">Phone Number:</span>
             <span class="col-span-2 text-right text-gray-600 font-medium">{{ selectedStaff.phone }}</span>
          </div>
          <div class="grid grid-cols-3 gap-2 text-xs">
             <span class="font-bold text-gray-800">Salary:</span>
             <span class="col-span-2 text-right text-gray-900 font-bold">{{ selectedStaff.salary }}</span>
          </div>
          <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <span class="font-bold text-gray-800">Working Status:</span>
             <div class="col-span-2 text-right">
                <span :class="selectedStaff.status === 'On Task' ? 'bg-yellow-400 text-white' : 'bg-gray-500 text-white'" class="px-3 py-0.5 rounded-full text-[10px] font-bold uppercase">
                   {{ selectedStaff.status }}
                </span>
             </div>
          </div>
       </div>

       <div class="w-full flex gap-3 px-2">
          <button class="flex-1 py-3 bg-black text-white text-xs font-bold rounded-xl hover:bg-gray-800 transition-colors shadow-lg">See Order</button>
          <button class="flex-1 py-3 bg-red-500 text-white text-xs font-bold rounded-xl hover:bg-red-600 transition-colors shadow-lg">Dismiss</button>
       </div>
    </div>

    <div v-else-if="isEditing" class="w-full lg:w-[35%] bg-gray-100 rounded-2xl p-6 flex flex-col items-center justify-center relative shadow-inner">
       <button @click="cancelEdit" class="absolute top-6 right-6 text-gray-800 hover:text-red-500 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
       </button>
       <div class="mb-4 text-center">
          <h3 class="text-xl font-bold text-gray-900">Edit Staff</h3>
       </div>
       <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mb-6 border-4 border-white shadow-sm">
          <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
       </div>
       <div class="w-full space-y-3 mb-8 px-2">
           <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Address:</label>
             <div class="col-span-2"><input v-model="editForm.address" type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:outline-none focus:border-indigo-500" /></div>
           </div>
           <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Email:</label>
             <div class="col-span-2"><input v-model="editForm.email" type="email" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:outline-none focus:border-indigo-500" /></div>
           </div>
           <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Phone:</label>
             <div class="col-span-2"><input v-model="editForm.phone" type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:outline-none focus:border-indigo-500" /></div>
           </div>
           <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Salary:</label>
             <div class="col-span-2"><input v-model="editForm.salary" type="text" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:outline-none focus:border-indigo-500" /></div>
           </div>
           <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Working Status:</label>
             <div class="col-span-2 text-right">
                <button 
                  @click="toggleEditStatus"
                  :class="editForm.status === 'On Task' ? 'bg-yellow-400 text-white' : 'bg-gray-500 text-white'" 
                  class="px-3 py-1 rounded-full text-[10px] font-bold uppercase transition-colors"
                >
                   {{ editForm.status }}
                </button>
             </div>
           </div>
       </div>
       <div class="w-full flex gap-3 px-2">
          <button @click="cancelEdit" class="flex-1 py-3 bg-red-500 text-white text-xs font-bold rounded-xl hover:bg-red-600 transition-colors shadow-lg">Cancel</button>
          <button @click="saveEdit" class="flex-1 py-3 bg-black text-white text-xs font-bold rounded-xl hover:bg-gray-800 transition-colors shadow-lg">Confirm</button>
       </div>
    </div>

    <div v-else-if="isAdding" class="w-full lg:w-[35%] bg-gray-100 rounded-2xl p-6 flex flex-col items-center justify-center relative shadow-inner">
       
       <div class="mb-4 text-center">
          <h3 class="text-xl font-bold text-gray-900">Add New Technician</h3>
       </div>

       <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mb-6 border-4 border-white shadow-sm relative cursor-pointer hover:bg-gray-50 transition">
          <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
          <div class="absolute bottom-1 right-1 bg-white rounded-full p-1 shadow-md border border-gray-100">
             <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
          </div>
       </div>

       <div class="w-full space-y-4 mb-8 px-2">
          <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Name:</label>
             <div class="col-span-2">
                <input v-model="newStaffForm.name" type="text" placeholder="Enter full name" class="w-full px-3 py-2 rounded-lg border border-transparent bg-white text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" />
             </div>
          </div>
          <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Address:</label>
             <div class="col-span-2">
                <input v-model="newStaffForm.address" type="text" placeholder="Enter address" class="w-full px-3 py-2 rounded-lg border border-transparent bg-white text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" />
             </div>
          </div>
          <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Email:</label>
             <div class="col-span-2">
                <input v-model="newStaffForm.email" type="email" placeholder="Enter email" class="w-full px-3 py-2 rounded-lg border border-transparent bg-white text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" />
             </div>
          </div>
          <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Phone Number:</label>
             <div class="col-span-2">
                <input v-model="newStaffForm.phone" type="text" placeholder="Enter phone number" class="w-full px-3 py-2 rounded-lg border border-transparent bg-white text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" />
             </div>
          </div>
          <div class="grid grid-cols-3 gap-2 text-xs items-center">
             <label class="font-bold text-gray-800">Salary:</label>
             <div class="col-span-2">
                <input v-model="newStaffForm.salary" type="text" placeholder="Enter salary" class="w-full px-3 py-2 rounded-lg border border-transparent bg-white text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 shadow-sm" />
             </div>
          </div>
       </div>

       <div class="w-full flex gap-3 px-2">
          <button @click="cancelAdd" class="flex-1 py-3 bg-red-500 text-white text-xs font-bold rounded-xl hover:bg-red-600 transition-colors shadow-lg">
             Cancel
          </button>
          <button @click="saveNewStaff" class="flex-1 py-3 border border-gray-300 bg-transparent text-gray-600 text-xs font-bold rounded-xl hover:bg-gray-200 transition-colors shadow-sm">
             Add
          </button>
       </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useStaffStore } from '../../stores/staff'; // Import Store
import { storeToRefs } from 'pinia';

const staffStore = useStaffStore();
const { staffList, loading } = storeToRefs(staffStore); // Ambil data reaktif

// --- STATES ---
const selectedStaff = ref(null);
const isEditing = ref(false);
const isAdding = ref(false);
const isLoading = ref(false); // Loading UI manual (jika perlu)

// Form Models
const editForm = ref({});
const newStaffForm = ref({
  name: '',
  address: '',
  email: '',
  phone: '',
  salary: '',
  role: 'Technician',
  status: 'Off Task',
  date_joined: new Date().toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' })
});

// FETCH DATA SAAT LOAD
onMounted(async () => {
    await staffStore.fetchStaff();
    if (staffList.value.length > 0) {
        selectedStaff.value = staffList.value[0];
    }
});

// --- FUNCTIONS ---

// 1. Select Staff
const selectStaff = (staff) => {
  if (isEditing.value || isAdding.value) return; 
  selectedStaff.value = staff;
};

// 2. Refresh List
const refreshList = () => {
  staffStore.fetchStaff();
};

// 3. Edit Mode Functions
const startEdit = (staff) => {
  isAdding.value = false;
  selectedStaff.value = staff;
  editForm.value = { ...staff }; 
  isEditing.value = true;
};

const cancelEdit = () => {
  isEditing.value = false;
  editForm.value = {}; 
};

const saveEdit = () => {
  // Logic update ke API bisa ditambahkan di sini nanti
  // Sementara update lokal dulu
  const index = staffList.value.findIndex(s => s.id === selectedStaff.value.id);
  if (index !== -1) {
    staffList.value[index] = { ...editForm.value };
  }
  selectedStaff.value = { ...editForm.value };
  isEditing.value = false;
};

const toggleEditStatus = () => {
  editForm.value.status = editForm.value.status === 'On Task' ? 'Off Task' : 'On Task';
};

// 4. ADD MODE FUNCTIONS
const startAdd = () => {
  isEditing.value = false;
  isAdding.value = true;
  selectedStaff.value = null;
  
  // Reset Form
  newStaffForm.value = {
    name: '',
    address: '',
    email: '',
    phone: '',
    salary: '',
    role: 'Technician',
    status: 'Off Task',
    date_joined: new Date().toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' })
  };
};

const cancelAdd = () => {
  isAdding.value = false;
  selectedStaff.value = staffList.value[0];
};

const saveNewStaff = async () => {
  if (!newStaffForm.value.name) {
    alert("Name is required!");
    return;
  }
  
  // Panggil Action Store untuk kirim ke API
  const success = await staffStore.addStaff(newStaffForm.value);
  
  if (success) {
      isAdding.value = false;
      // Auto select yang baru (logic sederhana, select pertama aja)
      if (staffList.value.length > 0) selectedStaff.value = staffList.value[staffList.value.length - 1];
  }
};

const deleteStaff = (id) => {
  if (confirm("Are you sure?")) {
     // Panggil API delete nanti di sini
     // staffStore.deleteStaff(id);
  }
};
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #e5e7eb; 
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #d1d5db; 
}
</style>
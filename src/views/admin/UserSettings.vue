<template>
  <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
    
    <!-- HEADER -->
    <div class="p-6 border-b border-gray-100">
      <h2 class="text-xl font-bold text-gray-800">User Settings</h2>
    </div>

    <div class="p-8">
      <div class="flex flex-col lg:flex-row gap-10">
        
        <!-- BAGIAN KIRI: PHOTO PROFILE (Abu-abu) -->
        <div class="w-full lg:w-1/3 bg-gray-100 rounded-2xl flex flex-col items-center justify-center p-10 min-h-[400px] relative">
           
           <!-- Avatar Circle -->
           <div class="relative group cursor-pointer">
              <!-- Avatar Image / Placeholder -->
              <div class="w-40 h-40 rounded-full bg-gradient-to-br from-[#4facfe] to-[#00f2fe] flex items-center justify-center border-4 border-white shadow-lg overflow-hidden">
                 <svg v-if="!profileImage" class="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                 <img v-else :src="profileImage" class="w-full h-full object-cover" alt="Profile">
              </div>

              <!-- Plus/Edit Button -->
              <button @click="triggerFileInput" class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-gray-50 text-gray-600 transition-colors">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
              </button>

              <!-- Hidden Input File -->
              <input type="file" ref="fileInput" class="hidden" accept="image/*" @change="handleFileChange">
           </div>

           <p class="mt-6 text-gray-500 text-sm font-medium">Allowed *.jpeg, *.jpg, *.png, *.gif</p>
           <p class="text-gray-400 text-xs">max size of 3 MB</p>

        </div>

        <!-- BAGIAN KANAN: FORMULIR -->
        <div class="w-full lg:w-2/3 space-y-8">
           
           <!-- USER INFORMATION -->
           <div class="space-y-4">
              <h3 class="text-lg font-bold text-gray-900">User Information</h3>
              
              <!-- Full Name -->
              <div>
                 <label class="block text-xs font-semibold text-gray-500 mb-1">Full Name</label>
                 <input v-model="form.fullName" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 focus:outline-none focus:border-black transition-colors" placeholder="Enter full name">
              </div>

              <!-- Nickname -->
              <div>
                 <label class="block text-xs font-semibold text-gray-500 mb-1">Nickname</label>
                 <input v-model="form.nickname" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 focus:outline-none focus:border-black transition-colors" placeholder="Enter nickname">
              </div>

              <!-- Phone Number -->
              <div>
                 <label class="block text-xs font-semibold text-gray-500 mb-1">Phone Number</label>
                 <input v-model="form.phone" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 focus:outline-none focus:border-black transition-colors" placeholder="Enter phone number">
              </div>

              <!-- Email -->
              <div>
                 <label class="block text-xs font-semibold text-gray-500 mb-1">Email</label>
                 <input v-model="form.email" type="email" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 focus:outline-none focus:border-black transition-colors" placeholder="Enter email address">
              </div>
           </div>

           <!-- ACCOUNT SETTING -->
           <div class="space-y-4 pt-4 border-t border-gray-100">
              <h3 class="text-lg font-bold text-gray-900">Account Setting</h3>

              <!-- Username -->
              <div>
                 <label class="block text-xs font-semibold text-gray-500 mb-1">Username</label>
                 <input v-model="form.username" type="text" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 focus:outline-none focus:border-black transition-colors" placeholder="Enter username">
              </div>

              <!-- Password -->
              <div class="relative">
                 <label class="block text-xs font-semibold text-gray-500 mb-1">Password</label>
                 <input :type="showPassword ? 'text' : 'password'" v-model="form.password" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 focus:outline-none focus:border-black transition-colors" placeholder="••••••••••">
                 <button @click="showPassword = !showPassword" class="absolute right-4 top-8 text-gray-400 hover:text-gray-600">
                    <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                 </button>
              </div>

              <!-- New Password -->
              <div class="relative">
                 <label class="block text-xs font-semibold text-gray-500 mb-1">New Password</label>
                 <input :type="showNewPassword ? 'text' : 'password'" v-model="form.newPassword" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-sm text-gray-800 focus:outline-none focus:border-black transition-colors" placeholder="Enter new password">
                 <button @click="showNewPassword = !showNewPassword" class="absolute right-4 top-8 text-gray-400 hover:text-gray-600">
                    <svg v-if="!showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                 </button>
              </div>
           </div>

           <!-- Button -->
           <div class="pt-4">
              <button @click="updateProfile" class="w-full bg-black text-white font-bold py-3 rounded-xl hover:bg-gray-800 transition-colors shadow-lg">
                 Update Profile
              </button>
           </div>

        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue';

// Form Data (Dummy Default)
const form = ref({
  fullName: 'Tama Setiawan',
  nickname: 'Tama',
  phone: '0851-7688-2175',
  email: 'mrahmatullahs@gmail.com',
  username: 'XlklUha98H',
  password: 'password123',
  newPassword: ''
});

// States
const showPassword = ref(false);
const showNewPassword = ref(false);
const profileImage = ref(null);
const fileInput = ref(null);

// Functions
const triggerFileInput = () => {
  fileInput.value.click();
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    profileImage.value = URL.createObjectURL(file);
  }
};

const updateProfile = () => {
  // Logic simpan ke backend / store
  alert("Profile Updated Successfully!");
};
</script>
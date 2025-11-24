<template>
  <div class="bg-gray-50 min-h-screen pb-20">
    
    <!-- HEADER -->
    <div class="bg-white shadow-sm sticky top-0 z-30">
      <div class="container mx-auto px-4 h-16 flex items-center">
        <button @click="goBack" class="p-2 -ml-2 text-gray-700 hover:bg-gray-100 rounded-full">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <h1 class="text-lg font-bold text-gray-900 ml-2 font-sans">
          Order Form
        </h1>
      </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl mt-8">
      
      <!-- FORM AREA -->
      <div>
        
        <!-- 1. CUSTOMER INFORMATION -->
        <section class="mb-10">
          <h2 class="text-2xl font-bold text-gray-900 mb-6 font-sans">Customer Information</h2>
          <div class="space-y-6">
            
            <!-- Full Name -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Full Name</label>
              <input 
                v-model="form.name" 
                type="text" 
                :class="['w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 font-sans', errors.name ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                placeholder="Enter your full name"
              >
              <p v-if="errors.name" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                This field is required.
              </p>
            </div>

            <!-- Phone Number -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Phone/WhatsApp Number</label>
              <input 
                v-model="form.phone" 
                type="tel" 
                :class="['w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 font-sans', errors.phone ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                placeholder="ex. 0800-0000-0000"
              >
              <p v-if="errors.phone" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                This field is required.
              </p>
            </div>

            <!-- Email -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">Email (Optional)</label>
              <input 
                v-model="form.email" 
                type="email" 
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 font-sans" 
                placeholder="ex. example@gmail.com"
              >
            </div>

          </div>
        </section>

        <hr class="border-gray-200 mb-10">

        <!-- 2. DEVICE INFORMATION -->
        <section class="mb-10">
          <h2 class="text-2xl font-bold text-gray-900 mb-6 font-sans">Device Information</h2>
          <div class="space-y-6">
            
            <!-- Device Type (Dropdown Native) -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Device Type</label>
              <div class="relative">
                <select 
                  v-model="form.deviceType" 
                  :class="['w-full border rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 font-sans bg-white appearance-none cursor-pointer', errors.deviceType ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                >
                  <option disabled value="">Select device type</option>
                  <option>Smartphone & Tablet</option>
                  <option>Laptop & Computer</option>
                  <option>Printer</option>
                  <option>Television</option>
                  <option>Speaker & Audio System</option>
                  <option>Air Conditioner</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
              <p v-if="errors.deviceType" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Please select a device type.
              </p>
            </div>

            <!-- Brand -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Brand</label>
              <input 
                v-model="form.brand" 
                type="text" 
                :class="['w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 font-sans', errors.brand ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                placeholder="Enter your device brand"
              >
              <p v-if="errors.brand" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                This field is required.
              </p>
            </div>

            <!-- Model -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Model/Series</label>
              <input 
                v-model="form.model" 
                type="text" 
                :class="['w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 font-sans', errors.model ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                placeholder="Enter your device model/series"
              >
              <p v-if="errors.model" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                This field is required.
              </p>
            </div>

            <!-- Serial Number -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">Serial Number (Optional)</label>
              <input v-model="form.serialNumber" type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 font-sans" placeholder="Enter your device serial number">
            </div>

          </div>
        </section>

        <hr class="border-gray-200 mb-10">

        <!-- 3. ISSUE DETAILS -->
        <section class="mb-10">
          <h2 class="text-2xl font-bold text-gray-900 mb-6 font-sans">Issue Details</h2>
          <div class="space-y-6">
            
            <!-- Problem Desc -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Problem Description</label>
              <textarea 
                v-model="form.problemDesc" 
                rows="4" 
                :class="['w-full border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 font-sans', errors.problemDesc ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                placeholder="Describe the problem in detail"
              ></textarea>
              <p v-if="errors.problemDesc" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                This field is required.
              </p>
            </div>
            
            <!-- Issue Start -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">When the Issue Started (optional)</label>
              <input v-model="form.issueStart" type="text" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 font-sans" placeholder="Ex: 2 days ago / After update">
            </div>

            <!-- PREVIOUS REPAIR (DROPDOWN BARU) -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Previous Repair</label>
              <div class="relative">
                <select 
                  v-model="form.previousRepair" 
                  :class="['w-full border rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 font-sans bg-white appearance-none cursor-pointer', errors.previousRepair ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                >
                  <option disabled value="">Has this device been repaired before?</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
              <p v-if="errors.previousRepair" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Please select an option.
              </p>
            </div>

            <!-- Additional Notes -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">Additional Notes (Optional)</label>
              <textarea v-model="form.notes" rows="3" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 font-sans" placeholder="Add notes..."></textarea>
            </div>

            <!-- Upload Photo -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">Upload Photo/Video (Optional)</label>
              <div class="mt-1 flex flex-col items-center justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-2xl bg-white relative hover:bg-gray-50 transition-colors">
                <div class="mb-3">
                  <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                </div>
                <div class="text-sm text-gray-600 text-center font-sans mb-4">
                  <span class="font-semibold">Select your file</span> or drag and drop<br>
                  <span class="text-xs text-gray-400">png, pdf, jpg, mp4, mov accepted</span>
                </div>
                <label for="file-upload" class="cursor-pointer bg-black text-white py-2 px-6 rounded-full text-sm font-bold hover:bg-gray-800 transition-colors">
                  Browse File
                  <input id="file-upload" name="file-upload" type="file" class="sr-only" @change="handleFileUpload">
                </label>
              </div>
              <div v-if="fileName" class="mt-3 p-3 bg-blue-50 border border-blue-100 rounded-lg flex items-center text-sm text-blue-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Selected: {{ fileName }}
              </div>
            </div>

          </div>
        </section>

        <hr class="border-gray-200 mb-10">

        <!-- 4. SERVICE PREFERENCE -->
        <section class="mb-10">
          <h2 class="text-2xl font-bold text-gray-900 mb-6 font-sans">Service Preference</h2>
          <div class="space-y-6">
            
            <!-- Service Type (Dropdown) -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Service Type</label>
              <div class="relative">
                <select 
                  v-model="form.serviceType" 
                  :class="['w-full border rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 font-sans bg-white appearance-none cursor-pointer', errors.serviceType ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                >
                  <option disabled value="">Select service type</option>
                  <option>Regular Repair</option>
                  <option>Urgent Repair (+Fee)</option>
                  <option>Diagnostic Only</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
              <p v-if="errors.serviceType" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                This field is required.
              </p>
            </div>

            <!-- Delivery Method (Dropdown & Dynamic Content) -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Delivery Method</label>
              <div class="relative">
                <select 
                  v-model="form.delivery" 
                  :class="['w-full border rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 font-sans bg-white appearance-none cursor-pointer', errors.delivery ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                >
                  <option disabled value="">Select delivery method</option>
                  <option>Home Pick-up</option>
                  <option>Drop off at Center</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
              <p v-if="errors.delivery" class="text-xs text-red-500 mt-1 font-sans flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                This field is required.
              </p>

              <!-- KONTEN DINAMIS: HOME PICK-UP -->
              <div v-if="form.delivery === 'Home Pick-up'" class="mt-6 space-y-4 bg-blue-50 p-4 rounded-xl border border-blue-100 animate-fade-in">
                <label class="block text-sm font-bold text-gray-800 mb-2 font-sans">Pin Your Maps Location</label>
                
                <!-- Map (Google Maps Embed) -->
                <div class="rounded-xl overflow-hidden shadow-md h-48 w-full relative">
                  <iframe 
                    width="100%" 
                    height="100%" 
                    style="border:0" 
                    loading="lazy" 
                    allowfullscreen
                    src="https://maps.google.com/maps?q=Makassar&t=&z=13&ie=UTF8&iwloc=&output=embed">
                  </iframe>
                </div>
                
                <!-- Input Alamat -->
                <div>
                  <label class="block text-xs font-medium text-gray-600 mb-1 font-sans">*Full Address</label>
                  <input 
                    v-model="form.pickupAddress" 
                    type="text" 
                    :class="['w-full border rounded-lg px-3 py-2 text-sm font-sans', errors.pickupAddress ? 'border-red-500 bg-red-50' : 'border-gray-300']" 
                    placeholder="Street name, house number, etc."
                  >
                </div>
                <div>
                  <label class="block text-xs font-medium text-gray-600 mb-1 font-sans">*City / Region</label>
                  <input 
                    v-model="form.pickupCity" 
                    type="text" 
                    :class="['w-full border rounded-lg px-3 py-2 text-sm font-sans', errors.pickupCity ? 'border-red-500 bg-red-50' : 'border-gray-300']" 
                    placeholder="e.g. Makassar"
                  >
                </div>
              </div>

              <!-- KONTEN DINAMIS: DROP OFF -->
              <div v-if="form.delivery === 'Drop off at Center'" class="mt-6 space-y-4 animate-fade-in">
                <label class="block text-sm font-bold text-gray-800 mb-2 font-sans">Find Our Closest Branch</label>
                <!-- Map (Lokasi Service Center) -->
                <div class="rounded-xl overflow-hidden shadow-md h-48 w-full relative">
                  <iframe 
                    width="100%" 
                    height="100%" 
                    style="border:0" 
                    loading="lazy" 
                    allowfullscreen
                    src="https://maps.google.com/maps?q=Service+Center+Elektronik+Terdekat&t=&z=12&ie=UTF8&iwloc=&output=embed">
                  </iframe>
                </div>
                <p class="text-xs text-gray-500 italic text-center">Please visit the nearest branch shown on the map.</p>
              </div>

            </div>

            <!-- Payment Method -->
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2 font-sans">*Payment Method</label>
              <div class="relative">
                <select 
                  v-model="form.payment" 
                  :class="['w-full border rounded-xl px-4 py-3 pr-10 focus:outline-none focus:ring-2 font-sans bg-white appearance-none cursor-pointer', errors.payment ? 'border-red-500 focus:ring-red-500 bg-red-50' : 'border-gray-300 focus:ring-blue-500']"
                >
                  <option disabled value="">Select payment method</option>
                  <option>DANA</option>
                  <option>Gopay</option>
                  <option>OVO</option>
                  <option>QRIS</option>
                  <option>COD (Home Pick-up only)</option>
                  <option>Cash (Drop off only)</option>
                  <option>Virtual Account</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
              <p v-if="errors.payment" class="text-xs text-red-500 mt-1 font-sans">This field is required.</p>
            </div>
          </div>
        </section>

        <!-- 5. TERMS & CONSENT (CHECKBOX KOTAK) -->
        <section class="mb-10">
          <h2 class="text-2xl font-bold text-gray-900 mb-6 font-sans text-center">Terms & Consent</h2>
          <div class="space-y-4 max-w-lg mx-auto">
            
            <!-- 
              PERBAIKAN CHECKBOX:
              - rounded-md (Kotak sudut tumpul)
              - w-5 h-5 (Sedikit lebih kecil dari w-6 h-6 agar proporsional)
            -->
            
            <!-- Term 1 -->
            <div @click="form.terms.diagnostic = !form.terms.diagnostic" class="flex items-center cursor-pointer group">
              <div :class="['w-5 h-5 rounded-md border-2 flex items-center justify-center mr-3 transition-colors', form.terms.diagnostic ? 'bg-blue-500 border-blue-500' : 'border-gray-300 group-hover:border-blue-400']">
                <svg v-if="form.terms.diagnostic" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
              </div>
              <span class="text-sm text-gray-600 font-sans">I agree to initial diagnostic inspection</span>
            </div>

            <!-- Term 2 -->
            <div @click="form.terms.contact = !form.terms.contact" class="flex items-center cursor-pointer group">
              <div :class="['w-5 h-5 rounded-md border-2 flex items-center justify-center mr-3 transition-colors', form.terms.contact ? 'bg-blue-500 border-blue-500' : 'border-gray-300 group-hover:border-blue-400']">
                <svg v-if="form.terms.contact" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
              </div>
              <span class="text-sm text-gray-600 font-sans">I agree to be contacted for approval before repair costs are applied</span>
            </div>

            <!-- Term 3 -->
            <div @click="form.terms.data = !form.terms.data" class="flex items-center cursor-pointer group">
              <div :class="['w-5 h-5 rounded-md border-2 flex items-center justify-center mr-3 transition-colors', form.terms.data ? 'bg-blue-500 border-blue-500' : 'border-gray-300 group-hover:border-blue-400']">
                <svg v-if="form.terms.data" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
              </div>
              <span class="text-sm text-gray-600 font-sans">I understand my data and device will be handled securely and responsibly</span>
            </div>

            <!-- Term 4 -->
            <div @click="form.terms.backup = !form.terms.backup" class="flex items-center cursor-pointer group">
              <div :class="['w-5 h-5 rounded-md border-2 flex items-center justify-center mr-3 transition-colors', form.terms.backup ? 'bg-blue-500 border-blue-500' : 'border-gray-300 group-hover:border-blue-400']">
                <svg v-if="form.terms.backup" class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
              </div>
              <span class="text-sm text-gray-600 font-sans">I have backed up my data / accept data risks</span>
            </div>

            <p class="text-xs text-gray-400 mt-4 italic">*Required. You must agree to continue.</p>
            <p v-if="errors.terms" class="text-xs text-red-500 font-sans">Please accept all required terms.</p>
          </div>
        </section>

        <!-- TOMBOL ACTION (DIPERKECIL) -->
        <!-- py-3 (bukan py-4) agar lebih kecil -->
        <div class="pt-4 pb-12 flex gap-4">
          <button 
            @click="clearForm"
            class="flex-1 bg-white border border-gray-300 text-gray-900 font-bold py-3 rounded-full hover:bg-gray-50 transition duration-300 text-base shadow-sm"
          >
            Clear Form
          </button>
          <button 
            @click="validateAndSubmit"
            class="flex-1 bg-black text-white font-bold py-3 rounded-full hover:bg-gray-800 transition duration-300 text-base shadow-lg"
          >
            Next
          </button>
        </div>

      </div>

    </div>

    <!-- INVOICE & PAYMENT REMINDER MODAL -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center px-4">
      <div class="bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-2xl transform transition-all scale-100">
        
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
          <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        
        <h3 class="text-xl font-bold text-gray-900 mb-3 font-sans">
          Invoice & Payment Reminder
        </h3>
        
        <p class="text-gray-500 mb-8 text-sm font-sans leading-relaxed">
          We will send the payment instructions once the diagnostic process is completed and cost estimate is approved.
        </p>
        
        <div class="flex gap-3">
          <button 
            @click="showModal = false"
            class="flex-1 bg-white border border-gray-300 text-gray-700 font-bold py-3 rounded-full hover:bg-gray-50 text-sm"
          >
            Cancel
          </button>
          <button 
            @click="finishOrder"
            class="flex-1 bg-black text-white font-bold py-3 rounded-full hover:bg-gray-800 text-sm"
          >
            I understand
          </button>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const showModal = ref(false);
const fileName = ref('');

const form = reactive({
  name: '',
  phone: '',
  email: '',
  deviceType: '',
  brand: '',
  model: '',
  serialNumber: '',
  problemDesc: '',
  issueStart: '',
  previousRepair: '', 
  notes: '',
  serviceType: '',
  delivery: '', 
  pickupAddress: '', 
  pickupCity: '',    
  payment: '',
  terms: {
    diagnostic: false,
    contact: false,
    data: false,
    backup: false
  }
});

const errors = reactive({
  name: false,
  phone: false,
  deviceType: false,
  brand: false,
  model: false,
  problemDesc: false,
  previousRepair: false,
  serviceType: false,
  delivery: false,
  pickupAddress: false, 
  pickupCity: false,    
  payment: false,
  terms: false
});

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (file) fileName.value = file.name;
};

const clearForm = () => {
  Object.keys(form).forEach(key => {
    if (key === 'terms') {
      form.terms = { diagnostic: false, contact: false, data: false, backup: false };
    } else {
      form[key] = '';
    }
  });
  fileName.value = '';
  Object.keys(errors).forEach(key => errors[key] = false);
  window.scrollTo(0, 0);
};

const goBack = () => {
  router.push('/');
};

const validateAndSubmit = () => {
  // Reset Errors
  Object.keys(errors).forEach(key => errors[key] = false);
  let isValid = true;

  // Cek Field Wajib
  if (!form.name) { errors.name = true; isValid = false; }
  if (!form.phone) { errors.phone = true; isValid = false; }
  if (!form.deviceType) { errors.deviceType = true; isValid = false; }
  if (!form.brand) { errors.brand = true; isValid = false; }
  if (!form.model) { errors.model = true; isValid = false; }
  if (!form.problemDesc) { errors.problemDesc = true; isValid = false; }
  if (!form.previousRepair) { errors.previousRepair = true; isValid = false; }
  if (!form.serviceType) { errors.serviceType = true; isValid = false; }
  if (!form.delivery) { errors.delivery = true; isValid = false; }
  if (!form.payment) { errors.payment = true; isValid = false; }

  if (form.delivery === 'Home Pick-up') {
    if (!form.pickupAddress) { errors.pickupAddress = true; isValid = false; }
    if (!form.pickupCity) { errors.pickupCity = true; isValid = false; }
  }
  
  // Validasi Terms (Semua harus dicentang untuk lanjut, atau minimal yang krusial)
  // Sesuai teks "*Required", biasanya semua wajib.
  if (!form.terms.diagnostic || !form.terms.contact || !form.terms.data || !form.terms.backup) {
    errors.terms = true;
    isValid = false;
  }

  if (!isValid) {
    window.scrollTo(0, 0); 
    return;
  }

  showModal.value = true;
};

const finishOrder = () => {
  showModal.value = false;
  router.push('/receipt'); // Redirect ke halaman RECEIPT
};
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
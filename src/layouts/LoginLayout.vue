<template>
  <div 
    class="flex items-center justify-center min-h-screen" 
    :style="{ 
      background: 'linear-gradient(to bottom right, #4D83F0, #425E93)' 
    }"
  >
    <div>
      <router-view />
    </div>

  </div>
</template>

<script setup>
import { RouterView } from 'vue-router';
</script>
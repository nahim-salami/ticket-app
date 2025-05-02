<template>
    <div class="flex">
      <Sidebar />
      <main class="flex-1 p-6 bg-gray-100 min-h-screen">
        <RouterView />
      </main>
    </div>
  </template>
  
  <script setup>
  import Sidebar from '../../components/Sidebar.vue'
  import { RouterView } from 'vue-router'
  </script>
  
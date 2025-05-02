<template>
    <aside class="w-64 bg-gray-800 text-white h-screen p-4">
      <h2 class="text-xl font-bold mb-6">Admin</h2>
      <nav class="flex flex-col space-y-2">
        <RouterLink to="/admin/events" class="hover:bg-gray-700 p-2 rounded">Événements</RouterLink>
        <RouterLink to="/admin/stats" class="hover:bg-gray-700 p-2 rounded">Statistiques</RouterLink>
      </nav>
    </aside>
  </template>
  
  <script setup>
  import { RouterLink } from 'vue-router'
  </script>
  
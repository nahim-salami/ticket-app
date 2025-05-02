<template>
    <div class="p-6">
      <h1 class="text-3xl font-bold mb-4">Liste des événements</h1>
      <div v-for="event in events" :key="event.id" class="bg-white p-4 mb-3 shadow rounded">
        <h2 class="text-xl font-semibold">{{ event.title }}</h2>
        <p class="text-gray-600">{{ event.description }}</p>
        <router-link :to="`/participate/${event.id}`" class="text-blue-500 underline">Participer</router-link>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  
  const events = ref([])
  
  onMounted(async () => {
    const res = await axios.get('http://localhost:8000/api/events')
    events.value = res.data
  })
  </script>
  
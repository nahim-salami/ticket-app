<template>
    <div class="border rounded-lg p-4 shadow hover:shadow-lg transition duration-300">
      <h3 class="text-xl font-semibold mb-2">{{ event.title }}</h3>
      <p class="text-sm text-gray-600 mb-3">{{ event.description }}</p>
      <p class="text-sm text-gray-500">
        Du <strong>{{ formatDate(event.start_date) }}</strong> au <strong>{{ formatDate(event.end_date) }}</strong>
      </p>
      <router-link
        :to="`/event/${event.id}`"
        class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      >
        Participer
      </router-link>
    </div>
  </template>
  
  <script setup>
  defineProps(['event'])
  
  function formatDate(dateStr) {
    return new Date(dateStr).toLocaleDateString()
  }
  </script>
  
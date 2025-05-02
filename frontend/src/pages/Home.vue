<template>
    <div class="container mx-auto py-8">
      <h1 class="text-3xl font-bold mb-6 text-center">Événements disponibles</h1>
  
      <div v-if="loading" class="text-center text-gray-600">Chargement des événements...</div>
      <div v-else-if="events.length === 0" class="text-center text-gray-500">
        Aucun événement disponible pour le moment.
      </div>
      <div v-else class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
        <EventCard
          v-for="event in events"
          :key="event.id"
          :event="event"
        />
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import { getEvents } from '../services/api'
  import EventCard from '../components/EventCard.vue'
  
  const events = ref([])
  const loading = ref(true)
  
  onMounted(async () => {
    try {
      const res = await getEvents()
      // Affiche seulement les événements actifs
      events.value = res.data.filter(e => e.status === 'actif')
    } catch (err) {
      console.error('Erreur lors du chargement des événements', err)
    } finally {
      loading.value = false
    }
  })
  </script>
  
<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Statistiques de participation</h1>

    <select v-model="selectedEventId" @change="fetchParticipants" class="input mb-4">
      <option disabled value="">-- Sélectionnez un événement --</option>
      <option v-for="event in events" :key="event.id" :value="event.id">
        {{ event.title }} ({{ event.participant_count }} participants)
      </option>
    </select>

    <div v-if="participants.length > 0">
      <h2 class="text-xl font-semibold mb-2">Participants ({{ participants.length }})</h2>
      <button @click="downloadCSV" class="btn mb-4">📥 Exporter en CSV</button>
      <table class="w-full table-auto bg-white shadow rounded">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2">Nom</th>
            <th class="px-4 py-2">Prénom</th>
            <th class="px-4 py-2">Email</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="p in participants" :key="p.id" class="border-t">
            <td class="px-4 py-2">{{ p.last_name }}</td>
            <td class="px-4 py-2">{{ p.first_name }}</td>
            <td class="px-4 py-2">{{ p.email }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else-if="selectedEventId" class="text-gray-500">Aucun participant pour cet événement.</div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const events = ref([])
const participants = ref([])
const selectedEventId = ref('')

// Charger tous les événements avec compteur
const fetchEvents = async () => {
  const res = await axios.get('http://localhost:8000/api/events')
  events.value = res.data.map(e => ({
    ...e,
    participant_count: e.participants_count || 0
  }))
}
onMounted(fetchEvents)

const fetchParticipants = async () => {
  if (!selectedEventId.value) return
  const res = await axios.get(`http://localhost:8000/api/events/${selectedEventId.value}/participants`)
  participants.value = res.data
}

const downloadCSV = () => {
  const csv = [
    ['Nom', 'Prénom', 'Email'],
    ...participants.value.map(p => [p.last_name, p.first_name, p.email])
  ]
    .map(row => row.join(','))
    .join('\n')

  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' })
  const link = document.createElement('a')
  link.href = URL.createObjectURL(blob)
  link.download = 'participants.csv'
  link.click()
}
</script>

<style scoped>
.input {
  @apply p-2 border border-gray-300 rounded w-full;
}
.btn {
  @apply bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded;
}
</style>

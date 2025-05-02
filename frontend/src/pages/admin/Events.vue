<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Gestion des Événements</h1>

    <form @submit.prevent="submitEvent" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 bg-white p-4 rounded shadow">
      <input v-model="form.title" type="text" placeholder="Titre de l'événement" class="input" required />
      <input v-model="form.description" type="text" placeholder="Description" class="input" required />
      <input v-model="form.start_date" type="date" class="input" required />
      <input v-model="form.end_date" type="date" class="input" required />
      <input v-model="form.max_participants" type="number" placeholder="Max participants" class="input" required />

      <button type="submit" class="btn col-span-full">
        {{ form.id ? 'Modifier' : 'Créer' }} l'événement
      </button>
    </form>

    <table class="w-full table-auto bg-white shadow rounded">
      <thead class="bg-gray-100">
        <tr>
          <th class="px-4 py-2">Titre</th>
          <th>Description</th>
          <th>Dates</th>
          <th>Statut</th>
          <th>Max</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="event in events" :key="event.id" class="border-t">
          <td class="px-4 py-2">{{ event.title }}</td>
          <td>{{ event.description }}</td>
          <td>{{ event.start_date }} → {{ event.end_date }}</td>
          <td>{{ event.status }}</td>
          <td class="text-center">{{ event.max_participants }}</td>
          <td class="flex gap-2">
            <button @click="editEvent(event)" class="btn-sm bg-yellow-500">✏️</button>
            <button @click="deleteEvent(event.id)" class="btn-sm bg-red-500">🗑</button>
            <router-link :to="`/admin/stats?event=${event.id}`" class="btn-sm bg-blue-600 text-white">👥</router-link>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const events = ref([])
const form = ref({
  id: null,
  title: '',
  description: '',
  start_date: '',
  end_date: '',
  max_participants: ''
})

const fetchEvents = async () => {
  const res = await axios.get('http://localhost:8000/api/events')
  events.value = res.data
}
onMounted(fetchEvents)

const submitEvent = async () => {
  try {
    if (form.value.id) {
      await axios.put(`http://localhost:8000/api/events/${form.value.id}`, form.value)
    } else {
      await axios.post(`http://localhost:8000/api/events`, form.value)
    }
    resetForm()
    fetchEvents()
  } catch (err) {
    alert('Erreur lors de l\'enregistrement')
  }
}

const editEvent = (event) => {
  form.value = { ...event }
}

const deleteEvent = async (id) => {
  if (confirm('Désactiver cet événement ?')) {
    await axios.delete(`http://localhost:8000/api/events/${id}`)
    fetchEvents()
  }
}

const resetForm = () => {
  form.value = {
    id: null,
    title: '',
    description: '',
    start_date: '',
    end_date: '',
    max_participants: ''
  }
}
</script>

<style scoped>
.input {
  @apply p-2 border border-gray-300 rounded w-full;
}
.btn {
  @apply bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded;
}
.btn-sm {
  @apply text-sm px-2 py-1 rounded;
}
</style>

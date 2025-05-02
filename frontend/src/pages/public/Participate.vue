<template>
  <div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4 text-center">Participation à l'événement</h1>

    <div v-if="event" class="mb-6 p-4 border rounded shadow bg-gray-50">
      <h2 class="text-xl font-semibold">{{ event.title }}</h2>
      <p class="text-sm text-gray-600">{{ event.description }}</p>
      <p class="mt-2 text-sm">📅 Du {{ formatDate(event.start_date) }} au {{ formatDate(event.end_date) }}</p>
      <p class="mt-1 text-sm">🎟️ Maximum : {{ event.max_participants }} participants</p>
    </div>

    <form @submit.prevent="submitParticipation" class="space-y-4">
      <div>
        <label>Nom</label>
        <input v-model="form.last_name" type="text" required class="input" />
      </div>
      <div>
        <label>Prénom</label>
        <input v-model="form.first_name" type="text" required class="input" />
      </div>
      <div>
        <label>Email</label>
        <input v-model="form.email" type="email" required class="input" />
      </div>

      <button :disabled="submitting" type="submit" class="btn">
        {{ submitting ? 'Envoi en cours...' : 'Participer' }}
      </button>

      <p v-if="success" class="text-green-600 mt-2">✅ Participation réussie ! Vérifiez votre email.</p>
      <p v-if="error" class="text-red-600 mt-2">{{ error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router'

const route = useRoute()
const eventId = route.params.eventId

const event = ref(null)
const form = ref({ first_name: '', last_name: '', email: '' })
const submitting = ref(false)
const success = ref(false)
const error = ref(null)

const formatDate = (dateStr) => new Date(dateStr).toLocaleDateString('fr-FR')

// Charger les détails de l’événement
const fetchEvent = async () => {
  try {
    const res = await axios.get(`http://localhost:8000/api/events/${eventId}`)
    event.value = res.data
  } catch (err) {
    error.value = "Événement introuvable."
  }
}

onMounted(fetchEvent)

// Soumettre la participation
const submitParticipation = async () => {
  submitting.value = true
  success.value = false
  error.value = null

  try {
    const res = await axios.post(`http://localhost:8000/api/events/${eventId}/participate`, form.value)
    success.value = true
    form.value = { first_name: '', last_name: '', email: '' }
  } catch (err) {
    if (err.response?.status === 409) {
      error.value = "Vous êtes déjà inscrit à cet événement."
    } else if (err.response?.status === 400) {
      error.value = "L'événement est complet."
    } else {
      error.value = "Une erreur est survenue. Veuillez réessayer."
    }
  } finally {
    submitting.value = false
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
</style>

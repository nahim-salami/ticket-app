<template>
    <div class="max-w-md mx-auto mt-10">
      <h1 class="text-2xl font-bold mb-4">Participation à l'événement</h1>
      <form @submit.prevent="submit">
        <input v-model="form.firstname" placeholder="Prénom" class="w-full mb-2 p-2 border" />
        <input v-model="form.lastname" placeholder="Nom" class="w-full mb-2 p-2 border" />
        <input v-model="form.email" type="email" placeholder="Email" class="w-full mb-2 p-2 border" />
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Valider</button>
      </form>
      <p v-if="message" class="mt-4 text-green-600">{{ message }}</p>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { useRoute } from 'vue-router'
  import axios from 'axios'
  
  const route = useRoute()
  const form = ref({
    firstname: '',
    lastname: '',
    email: '',
  })
  const message = ref('')
  
  const submit = async () => {
    const res = await axios.post(`http://localhost:8000/api/participate/${route.params.eventId}`, form.value)
    message.value = res.data.message || 'Inscription réussie'
  }
  </script>
  
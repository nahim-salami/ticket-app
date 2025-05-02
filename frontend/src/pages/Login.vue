<template>
  <div class="max-w-md mx-auto mt-20 p-6 border rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Connexion Administrateur</h2>
    <form @submit.prevent="handleLogin">
      <input v-model="email" type="email" placeholder="Email" class="input" required />
      <input v-model="password" type="password" placeholder="Mot de passe" class="input mt-2" required />
      <button type="submit" class="btn mt-4 w-full">Se connecter</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const email = ref('')
const password = ref('')

const handleLogin = async () => {
  try {
    await axios.post('http://localhost:8000/api/login', { email: email.value, password: password.value })
    router.push('/admin/events')
  } catch (err) {
    alert('Échec de connexion')
  }
}
</script>

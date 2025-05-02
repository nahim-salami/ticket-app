<template>
    <div class="max-w-sm mx-auto mt-20">
      <h1 class="text-xl mb-4">Connexion Admin</h1>
      <form @submit.prevent="login">
        <input v-model="email" type="email" placeholder="Email" class="w-full mb-2 p-2 border" />
        <input v-model="password" type="password" placeholder="Mot de passe" class="w-full mb-2 p-2 border" />
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Connexion</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  
  const email = ref('')
  const password = ref('')
  
  const login = async () => {
    const res = await axios.post('http://localhost:8000/api/login', {
      email: email.value,
      password: password.value
    })
    localStorage.setItem('token', res.data.access_token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${res.data.access_token}`
  }
  </script>
  
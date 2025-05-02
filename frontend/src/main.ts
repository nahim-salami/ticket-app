import { createApp } from 'vue'
import './style.css'
import AppHome from './App.vue'
import router from './router'

const app = createApp(AppHome)
app.use(router)
app.mount('#app')
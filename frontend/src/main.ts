import { createApp } from 'vue'
import './style.css'
import App from './pages/Login.vue'
import router from './router'

const apps = createApp(App)
apps.use(router)
apps.mount('#app')
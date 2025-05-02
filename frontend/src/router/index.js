import { createRouter, createWebHistory } from 'vue-router'

import Events from '../pages/public/Events.vue'
import Participate from '../pages/public/Participate.vue'
import Login from '../pages/Login.vue'
import Dashboard from '../pages/admin/Dashboard.vue'
import AdminEvents from '../pages/admin/Events.vue'
import Stats from '../pages/admin/Stats.vue'

const routes = [
  { path: '/', name: 'Events', component: Events },
  { path: '/participate/:eventId', name: 'Participate', component: Participate },
  { path: '/login', name: 'Login', component: Login },
  {
    path: '/admin',
    component: Dashboard,
    children: [
      { path: 'events', name: 'AdminEvents', component: AdminEvents },
      { path: 'stats', name: 'Stats', component: Stats },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router

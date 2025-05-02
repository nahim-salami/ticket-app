import axios from 'axios'

const api = axios.create({
  baseURL: 'http://localhost:8000', 
  withCredentials: true, 
})

export const getCsrfToken = () => api.get('/sanctum/csrf-cookie')

export const login = async (data) => {
  await getCsrfToken()
  return api.post('/api/login', data)
}

export const logout = () => api.post('/api/logout')

// Events (publics)
export const getEvents = () => api.get('/api/events')
export const getEvent = (id) => api.get(`/api/events/${id}`)
export const participate = (id, data) => api.post(`/api/events/${id}/participate`, data)

// Events (admin)
export const createEvent = (data) => api.post('/api/events', data)
export const updateEvent = (id, data) => api.put(`/api/events/${id}`, data)
export const deleteEvent = (id) => api.delete(`/api/events/${id}`)
export const getParticipants = (id) => api.get(`/api/events/${id}/participants`)

export default api

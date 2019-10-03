import axios from 'axios'

const oauth = JSON.parse(localStorage.getItem('oauth'))

const token = oauth === null ? '' : oauth.access_token

const client = axios.create({
  baseURL: '/api',
  headers: {
    'Authorization': `bearer ${token}`,
  }
})

export default {
  create(data) {
    return client.post('/tasks', data)
  },
  all() {
    return client.get('/tasks')
  },
  find(id) {
    return client.get(`/tasks/${id}`)
  },
  update(id, data) {
    return client.patch(`/tasks/${id}`, data)
  },
  delete(id, data) {
    return client.delete(`/tasks/${id}`)
  },
  complete(id) {
    return client.patch(`/tasks/${id}/complete`)
  },
  uncomplete(id) {
    return client.patch(`/tasks/${id}/uncomplete`)
  },
}
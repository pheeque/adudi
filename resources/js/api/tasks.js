import axios from 'axios'

export default {
  create(data) {
    return axios.post('/api/tasks', data)
  },
  all() {
    return axios.get('/api/tasks')
  },
  find(id) {
    return axios.get(`/api/tasks/${id}`)
  },
  update(id, data) {
    return axios.patch(`/api/tasks/${id}`, data)
  },
  delete(id, data) {
    return axios.delete(`/api/tasks/${id}`)
  },
  complete(id) {
    return axios.patch(`/api/tasks/${id}/complete`)
  },
  uncomplete(id) {
    return axios.patch(`/api/tasks/${id}/uncomplete`)
  },
}
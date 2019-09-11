export default {
  create(data) {
    return axios.post('/api/users', data)
  },
  all() {
    return axios.get('/api/users')
  },
  find(id) {
    return axios.get(`/api/users/${id}`)
  },
  update(id, data) {
    return axios.patch(`/api/users/${id}`, data)
  },
  delete(id, data) {
    return axios.delete(`/api/users/${id}`)
  },
}
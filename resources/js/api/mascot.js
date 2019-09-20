import axios from 'axios'

export default {
  find(id) {
    return axios.get(`/api/mascots/${id}`)
  },
  update(id, data) {
    return axios.patch(`/api/mascots/${id}`, data)
  },
}
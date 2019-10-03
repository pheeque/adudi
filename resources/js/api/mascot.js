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
  find(id) {
    return client.get(`/mascots/${id}`)
  },
  update(id, data) {
    return client.patch(`/mascots/${id}`, data)
  },
}
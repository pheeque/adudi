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
  tasksOfMonth(month) {
    return client.get(`/tasks/month/${month}`)
  },
  tasksOfDay(day) {
    return client.get(`/tasks/day/${day}`)
  },
}
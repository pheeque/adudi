import axios from 'axios'

const oauth = JSON.parse(localStorage.getItem('oauth'))

const token = oauth === null ? '' : oauth.access_token

const client = axios.create({
  baseURL: '/api',
  headers: {
    'Authorization': `Bearer ${token}`,
  }
})

export default client
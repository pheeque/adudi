import client from './client'

const path = '/mascots'

export default {
  find(id) {
    return client.get(`${path}/${id}`)
  },
  update(id, data) {
    return client.patch(`${path}/${id}`, data)
  },
}
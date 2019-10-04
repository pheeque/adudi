import client from './client'

const path = '/tasks'

export default {
  create(data) {
    return client.post(`${path}`, data)
  },
  all() {
    return client.get(`${path}`)
  },
  find(id) {
    return client.get(`${path}/${id}`)
  },
  update(id, data) {
    return client.patch(`${path}/${id}`, data)
  },
  delete(id, data) {
    return client.delete(`${path}/${id}`)
  },
  complete(id) {
    return client.patch(`${path}/${id}/complete`)
  },
  uncomplete(id) {
    return client.patch(`${path}/${id}/uncomplete`)
  },
}
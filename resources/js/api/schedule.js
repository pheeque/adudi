import client from './client'

const path = '/tasks'

export default {
  tasksOfMonth(month) {
    return client.get(`${path}/month/${month}`)
  },
  tasksOfDay(day) {
    return client.get(`${path}/day/${day}`)
  },
}
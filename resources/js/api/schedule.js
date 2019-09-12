import axios from 'axios'

export default {
  tasksOfMonth(month) {
    return axios.get(`/api/tasks/month/${month}`)
  },
  tasksOfDay(day) {
    return axios.get(`/api/tasks/day/${day}`)
  },
}
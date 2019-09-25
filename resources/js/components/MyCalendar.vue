<template>
  <div>
    <calendar-header />
    <div class="date-grid" v-if="tasks">
      <day v-for="day in daysInMonth" :start-day="firstDayOfMonth" :day="day" :tasks="tasks" :key="day"/>
    </div>
  </div>
</template>

<script>
  import Day from './Day'
  import CalendarHeader from './CalendarHeader'
  import api from '../api/schedule'

  export default {
    components: {
      Day,
      CalendarHeader,
    },
    props: ['month', 'year'],
    computed: {
      daysInMonth() {
        return new Date(this.year, this.month, 0).getDate()
      },
      firstDayOfMonth() {
        let date = new Date()
        return new Date(this.year, this.month - 1, 1).getDay()
      },
    },
    created() {
      this.getTasksOfMonth()
    },
    data() {
      return {
        tasks: null
      }
    },
    methods: {
      getTasksOfMonth() {
        api.tasksOfMonth(this.month)
          .then(response => {
            this.tasks = Object.assign([], response.data.data)
          })
      }
    }
  }
</script>
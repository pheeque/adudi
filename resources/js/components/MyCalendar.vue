<template>
  <div class="flex flex-row flex-wrap">
    <day :day="day" v-for="day in daysOfMonth" :tasks="tasks" :key="day"/>
  </div>
</template>

<script>
  import Day from './Day'
  import api from '../api/schedule'
  import { forEach } from 'lodash'

  export default {
    components: {
      Day,
    },
    props: ['month', 'year'],
    computed: {
      daysOfMonth() {
        return new Date(this.year, this.month, 0).getDate()
      }
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
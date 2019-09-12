<template>
  <div class="flex flex-row flex-wrap">
    <day :day="day" v-for="day in daysOfMonth" :key="day"/>
  </div>
</template>

<script>
  import Day from './Day'

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
    data() {
      return {
        
      }
    },

    methods: {
      //
    },
  }
</script>
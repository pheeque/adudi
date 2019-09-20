<template>
  <div class="flex">
    <div class="w-3/4">
      <div class="flex items-center justify-between">
        <h2 class="text-2xl uppercase">My Schedule</h2>
        <div class="flex items-center">
          <h3 class="text-xl uppercase">September</h3>
          <p class="ml-4 text-lg uppercase text-gray-500">2019</p>
        </div>
      </div>
      <div class="mt-4">
        <my-calendar :month="9" :year="2019" />
      </div>
    </div>
    <div class="w-1/4">
      <mascot id="1" />
    </div>
  </div>
</template>

<script>
  import MyCalendar from '../components/MyCalendar'
  import Mascot from '../components/mascot/Mascot'

  export default {
    components: {
      MyCalendar,
      Mascot,
    },
    data() {
      return {
        
      }
    },

    methods: {
      
    },
  }
</script>
<template>
  <div class="day-of-week border-b pb-4">
    <div class="" v-for="day in days">{{ day }}</div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
      }
    },
  }
</script>